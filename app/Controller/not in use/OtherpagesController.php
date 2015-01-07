<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'PayPal/curlClass');

class OtherpagesController extends AppController
{

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('get_premium', '');
	}

	public function get_premium()
	{
		$this->set('title_for_layout', __("Get Premium"));
		$request = $this->request;
prd($_SESSION);
		$this->loadModel("Setting");
		$data = $this->Setting->find("list", array(
			"conditions" => array("status" => 1, "OR" => array(array("unique_name" => "PREMIUM_PRICE"), array("unique_name" => "PROFESSIONAL_PRICE"))),
			"fields" => array("unique_name", "value")
		));

		$this->set("data", $data);
	}

	public function event()
	{
		
	}

	public function payment($type = null)
	{
		$request = $this->request;
		$this->set('title_for_layout', __("Payment"));
		$typeArr = array('1', '2');
		$user_id = $this->_getCurrentUserId();
		
		if (!empty($type) && in_array($type, $typeArr) && !empty($user_id))
		{
			$type_name = ($type == 1) ? 'PREMIUM' : 'PROFESSIONAL';
			$unq_name = $type_name . '_PRICE';
			$user_type = $this->Auth->User('user_type');
			
			if (($user_type==3) || ($user_type==2 && $type==1)) {
				$userTypeArr = array('1' => 'Free', '2' => 'Premium', '3' => 'Professional');
				$this->Session->setFlash(__('You are already a '.$userTypeArr[$user_type].' user'), 'flash_error');
				$this->redirect(array('action'=>'get_premium'));
			}
			
			$this->loadModel('Setting');
			$priceData = $this->Setting->find("first", array(
				"conditions" => array("status" => 1, "unique_name" => $unq_name),
				"fields" => array("unique_name", "value")
			));

			$CountriesList = Hash::combine(Configure::read("CountriesList"), '{n}.country_code', '{n}.country_name');
			$MonthsList = Configure::read("MonthsList");
			$YearsList = range(2014, 2050);
			
			if (($request->is('post') || $request->is('put')) && !empty($request->data))
			{
				$data = $request->data;
				
				$this->loadModel('Payment');
				$this->Payment->set($data);
				if ($this->Payment->validates()) //validates
				{
					$this->loadModel("User");
					$userData = $this->User->findById($user_id);
					
					$data['Payment']['first_name'] = $userData['User']['first_name'];
					$data['Payment']['last_name'] = $userData['User']['last_name'];
					
					$data['Payment']['amt'] = $priceData['Setting']['value'];
					$data['Payment']['pay_month'] = str_pad($data['Payment']['month'], 2, '0', STR_PAD_LEFT);
					$data['Payment']['pay_year'] = $YearsList[$data['Payment']['year']];
					
					$response = $this->_processPayment($data);
					prd($response);
					if ($response['ACK'] === 'Success') {
						$this->_saveTransaction($user_id, $type_name, $response);
						
						//Update User Data
						//$this
						$this->Session->setFlash(__('Payment Successfull'), 'flash_success');
						$this->redirect(array('controller'=>'index', 'action'=>'index'));
					} else {
						$msg = $response['L_LONGMESSAGE0'];
						$this->Session->setFlash(__($msg), 'flash_error');
					}
				}
			}

			$this->set(compact('CountriesList', 'MonthsList', 'YearsList', 'type_name'));
			$this->set('price', $priceData['Setting']['value']);
		}
		else
		{
			$this->redirect(array("action" => "get_premium"));
		}
	}

	protected function _processPayment($data)
	{
		$PayPalInfo['METHOD'] = 'DoDirectPayment'; // Do not Edit
		$PayPalInfo['PAYMENTACTION'] = 'Sale'; // Do not Edit

		$PayPalInfo['AMT'] = $data['Payment']['amt'];
		$PayPalInfo['CREDITCARDTYPE'] = $data['Payment']['cctype']; //'Visa';
		$PayPalInfo['ACCT'] = $data['Payment']['cardno']; //'4417119669820331';// Card No.
		//$PayPalInfo['EXPDATE'] = $data['Payment']['pay_month'] . $data['Payment']['pay_year']; // '112019';//MMYYYY
		$PayPalInfo['CVV2'] = $data['Payment']['cvv']; //'012';
		$PayPalInfo['FIRSTNAME'] = $data['Payment']['first_name']; //'Rohit';
		$PayPalInfo['LASTNAME'] = $data['Payment']['last_name']; //'Awasthi';
		$PayPalInfo['STREET'] = $data['Payment']['street']; //'JDP';
		$PayPalInfo['CITY'] = $data['Payment']['city']; //'San Joes';
		$PayPalInfo['STATE'] = $data['Payment']['state']; //'CA';
		$PayPalInfo['ZIP'] = $data['Payment']['zip']; //'95131';
		$PayPalInfo['COUNTRYCODE'] = $data['Payment']['country'];
		
		$curl = new curlClass();
		$postfields = $curl->prepareCurlData($PayPalInfo);
		$result = $curl->curlCall($postfields);
		$returnedData = array();
		parse_str($result, $returnedData);

		return $returnedData;
	}
	
	protected function _saveTransaction($user_id, $plan_type, $data)
	{
		$save = array();
		$save['Transaction']['user_id'] = $user_id;
		$save['Transaction']['plan_type'] = $plan_type;
		$save['Transaction']['transaction_id'] = $data['TRANSACTIONID'];
		$save['Transaction']['amount'] = $data['AMT'];
		$save['Transaction']['currency_type'] = $data['CURRENCYCODE'];
		$save['Transaction']['description'] = json_encode($data);
		
		$this->loadModel("Transaction");
		if ( $this->Transaction->save($save) ) {
			return true;
		}
		return false;
	}
}
