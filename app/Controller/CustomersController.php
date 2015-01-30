<?php
class CustomersController extends AppController{
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('register');
	}

	public function index(){
		$this->layout = 'innerpages';	
		$this->set('title_for_layout', 'Dashboard');
	}

	public function profile(){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Customer Profile');
		$this->loadModel('User');
		
		$user_id = $this->Session->read('Auth.User.id');
		if(!$user_id) {
        	throw new NotFoundException(__('Invalid User'));
    	}
		
		$Service = $this->User->find("all",array(
			//'fields' => $fields,
			'recursive' => 0,
			'conditions' => array('User.id' => $user_id)
			)
		);



		if (!$Service) {
        	throw new NotFoundException(__('Invalid User'));
    	}

	    if ($this->request->is(array('post', 'put'))) {  
			$this->request->data['User']['id'] = $user_id;
			//prd($this->request->data);
			
			if(empty($this->request->data['User']['password'])){	
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);
			}
			//prd($this->request->data);
			if(isset($this->request->data['Customer']['customer_dateofbirth']) && !empty($this->request->data['Customer']['customer_dateofbirth'])){
				$this->request->data['Customer']['customer_dateofbirth'] = date('Y-m-d', strtotime($this->request->data['Customer']['customer_dateofbirth']));
			}

			if(!isset($this->request->data['Customer']['customer_promotion_by_web']))
			$this->request->data['Customer']['customer_promotion_by_web'] = 0;
			
			if(!isset($this->request->data['Customer']['customer_promotion_by_email']))
			$this->request->data['Customer']['customer_promotion_by_email'] = 0;

			if($this->User->saveAssociated($this->request->data)) {
	            $this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'customers', 'action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
	    }

		if (!$this->request->data) {
			//$Service[0]['Cleaner']['cleaner_dateofbirth'] = date('m/d/Y', strtotime($Service[0]['Cleaner']['cleaner_dateofbirth']));
	        $this->request->data = $Service[0];
	    }
		
	    /*$ServiceProvider = $this->User->ServiceProvider->find('all', array(
			'fields' => array('ServiceProvider.user_id', 'ServiceProvider.full_busnes_na1'),
			'conditions' => array('User.user_status <> 2')
		));*/

		/*$Service = $this->Category->Service->find('all', array(
			'fields' => array('Service.id', 'Service.service_name', 'Service.category_id'),
			'conditions' => array('Service.service_status <> 2', 'Category.category_status <> 2'),
			'order' => array('Service.category_id')
		));*/

		//$this->set("ServiceProvider", $this->createlist($ServiceProvider, "user_id", "full_busnes_na1"));
		//$this->set("Service", $this->createlist($Service, "id", "service_name"));
		//$this->set("category_service_link", json_encode($this->createlist($Service, "id", "category_id")));
		//$this->set("user_id", $user_id);
	}

	public function createbooking(){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Booking History');

		$this->loadModel('Booking');
		$this->loadModel('Customer');

		$CustomerId = $this->Session->read('Auth.User.id');
		$conditions = array("Booking.customer_id"=>$CustomerId);
		//$this->loadModel('Category');
		//$this->loadModel('Service');		
		//$this->loadModel('ServiceProviderService');

		$fields = array('Booking.*','ServiceProvider.*','Cleaner.*','Service.*');
		$Booking = $this->Booking->find("all",array(
			'fields' => $fields,
			'joins'=>array(
				/*array(
					'table' => 'booking_customers',
					'alias' => 'Customer',
					'type' => 'LEFT',
					'conditions' => array('Booking.customer_id = Customer.user_id')
				),*/
				array(
					'table' => 'booking_service_providers',
					'alias' => 'ServiceProvider',
					'type' => 'LEFT',
					'conditions' => array('Booking.provider_id = ServiceProvider.user_id')
				),
				array(
					'table' => 'booking_cleaners',
					'alias' => 'Cleaner',
					'type' => 'LEFT',
					'conditions' => array('Booking.cleaner_id = Cleaner.user_id')
				),
				array(
					'table' => 'booking_services',
					'alias' => 'Service',
					'type' => 'LEFT',
					'conditions' => array('Booking.service_id = Service.id')
				),

			),
			'conditions' => $conditions
			)
		);
		//prd($Booking);
		$this->set('Booking', $Booking);
		//$this->set('title_for_layout', 'Service Provider\'s Services');



		/*if (!$Service) {
        	throw new NotFoundException(__('Invalid User'));
    	}

	    if ($this->request->is(array('post', 'put'))) {  */
			/*$this->request->data['User']['id'] = $user_id;
			if(empty($this->request->data['User']['password'])){	
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);
			}
			

			if(isset($this->request->data['Customer']['customer_dateofbirth']) && !empty($this->request->data['Customer']['customer_dateofbirth'])){
				$this->request->data['Customer']['customer_dateofbirth'] = date('Y-m-d', strtotime($this->request->data['Customer']['customer_dateofbirth']));
			}
			
			if($this->User->saveAssociated($this->request->data)) {
	            $this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'customer', 'action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');*/
	    //}

		/*if (!$this->request->data) {
			$this->request->data = $Service[0];
	    }*/
	}

	public function addbooking(){ 
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Book cleaning');
		
		$this->loadModel('Service');
		$this->loadModel('Customer');
		$this->set(compact('settings'));
		$this->loadModel('Booking');
		//prd($this->Session->read('datasession'));

		if ($this->request->is(array('post', 'put'))) {  
			//prd($this->request->data);
			
			$service_data = $this->Service->find('all', array(
    			'conditions' => array('Service.id' => $this->request->data['Booking']['service_id']),
    			'fields'     => array('Service.id', 'Service.category_id' , 'Service.sub_category_id')
			));
			if(empty($service_data)){
				$this->Session->setFlash(__('Service you select not exist'), 'flash_error');
				return $this->redirect(array('controller' => 'customers', 'action' => 'createbooking'));
			}

			if(isset($this->request->data['Booking']['booking_date']) && !empty($this->request->data['Booking']['booking_date'])){
				$this->request->data['Booking']['booking_date'] = date('Y-m-d', strtotime($this->request->data['Booking']['booking_date']));
			}

			$this->request->data['Booking']['customer_id'] = $this->Session->read('Auth.User.id');
			//$this->request->data['Booking']['provider_id'] = '';
			$this->request->data['Booking']['category_id'] = $service_data[0]['Service']['category_id'];
			$this->request->data['Booking']['sub_category_id'] = $service_data[0]['Service']['sub_category_id'];
			$data = $this->request->data; 

			
			
			//if($this->Booking->save($data,false)){
				/**/
				$this->Session->write('datasession',$data);
				$my_app = Router::url('/', true);
				$return_url = $my_app.'customers/success';
				$return_cancel_url = $my_app.'customers/cancel';
				echo '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="margin: 0px; padding: 0px; text-align:center" id="form1" name="form1">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="kamlesh-facilitator@cgt.co.in">
				<input type="hidden" name="amount" value="1">
				<input type="hidden" name="cbt" value="CLICK HERE">
				<input type="hidden" name="return" value="'.$return_url.'">
				<input type="hidden" name="cancel_return" value="'.$return_cancel_url.'">
				</form>
				<script language="javascript">window.onload = function(){ alert("Click OK and wait while You redirected to Paypal");document.form1.submit();}</script>';
				exit;
				/**/
				//$this->Session->setFlash(__('Your Booking hase been saved'), 'flash_success');
				//return $this->redirect(array('controller' => 'customers', 'action' => 'createbooking'));
			//}
		}

		$customer_data = $this->Customer->find("first",array(
			//'fields' => $fields,
			'recursive' => 0,
			'conditions' => array('Customer.user_id' => $this->Session->read('Auth.User.id'))
			)
		);
		//prd($customer_data);

		$services = $this->Service->find('list', array(
    		'conditions' => array('Service.service_status' => '0'),
    		'fields'     => array('Service.id', 'Service.service_name')
		));
		$this->set('services',$services);	
		$this->set('customer_data',$customer_data);
	}

	// Thanks page after payment success
	


	public function success(){
		//http://192.168.1.192/chistyy/customers/sucess?tx=2HM48733TR002203F&st=Completed&amt=1%2e00&cc=USD&cm=&item_number=
		//prd($_REQUEST);
		$this->loadModel('Booking');
		$data = $this->Session->read('datasession');
		if( !empty($data) && $this->Booking->save($data,false)){
			$this->loadModel('Tranjection');
			$this->loadModel('TranjectionDetail');
			$tranjection = '';
			$tranjectionDetail = '';

			$tranjection['Tranjection']['cust_id'] = $this->Session->read('Auth.User.id');
			$this->Tranjection->save($tranjection,false);
			$lastid = $this->Tranjection->getLastInsertId();

			$tranjectionDetail['TranjectionDetail']['cust_id'] = $this->Session->read('Auth.User.id');
			$tranjectionDetail['TranjectionDetail']['trans_id'] = $lastid;
			// Response From Paypal
			$tranjectionDetail['TranjectionDetail']['pay_id'] = $_REQUEST['tx'];//= '2HM48733TR002203F';
			$tranjectionDetail['TranjectionDetail']['pay_status'] = $_REQUEST['st'];// = 'Completed';
			$tranjectionDetail['TranjectionDetail']['pay_amt'] = $_REQUEST['amt'];// = '1.0';
			$tranjectionDetail['TranjectionDetail']['pay_currency'] = $_REQUEST['cc'];// = 'USD';
			$tranjectionDetail['TranjectionDetail']['pay_cm'] = $_REQUEST['cm'];// = '';
			$tranjectionDetail['TranjectionDetail']['pay_item'] = $_REQUEST['item_number'];// = '';
			$this->TranjectionDetail->save($tranjectionDetail,false);

			
			$this->Session->delete('datasession');
			$this->Session->setFlash(__('Your Booking hase been saved'), 'flash_success');
			return $this->redirect(array('controller' => 'customers', 'action' => 'createbooking'));
		}else{
			$this->Session->setFlash(__('Sorry, Please Fill booking detail first'), 'flash_error');
			return $this->redirect(array('controller' => 'customers', 'action' => 'createbooking'));
		}		
	}

	public function cancel(){
		$this->Session->setFlash(__('Your Booking payment was cancelled'), 'flash_error');
		return $this->redirect(array('controller' => 'customers', 'action' => 'createbooking'));
	}	
	
	public function createlist($arr, $arrid, $arrvalue){
		$returnarr = array();
		foreach($arr as $key => $value){
			foreach($value as $valuekey => $innervalue){
				$returnarr[$innervalue[$arrid]] = $innervalue[$arrvalue];
			}
		}
		return $returnarr;
	}


	public function register(){

		$this->set('title_for_layout', 'Add Customer');

		$this->loadModel('User');
		$this->loadModel('Customer');

		if($this->request->is('post')){
			$this->request->data['User']['user_type'] = '3';
			$this->request->data['Customer']['customer_dateofbirth'] = date('Y-m-d', strtotime(str_replace("/", "-", $this->request->data['Customer']['customer_dateofbirth'])));

			if($this->User->saveAssociated($this->request->data)){
				$this->Session->setFlash(__('Your Customer has been added.'), 'flash_success');
				return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        	}
        	$this->Session->setFlash(__('Unable to add your Customer.'), 'flash_error');
        	$this->redirect(array('controller' => 'users', 'action' => 'signup'));
		}
	}

	public function admin_index(){
		$this->set('title_for_layout', 'Customer(s)');
	}
	
	public function admin_add(){

		$this->set('title_for_layout', 'Add Customer');

		$this->loadModel('User');
		$this->loadModel('Customer');

		if($this->request->is('post')){
			$this->request->data['User']['user_type'] = '3';
			$this->request->data['Customer']['customer_dateofbirth'] = date('Y-m-d', strtotime(str_replace("/", "-", $this->request->data['Customer']['customer_dateofbirth'])));

			if($this->User->saveAssociated($this->request->data)){
				$this->Session->setFlash(__('Your Customer has been added.'), 'flash_success');
				return $this->redirect(array('controller' => 'customers', 'action' => 'admin_index'));
        	}
        	$this->Session->setFlash(__('Unable to add your Customer.'), 'flash_error');
		}
	}
	
	public function admin_edit($userType = NULL){
		$this->set('title_for_layout', 'Edit Customer');
		$this->loadModel('User');
		if (!$userType) {
        throw new NotFoundException(__('Invalid User'));
    }

		$fields = array('User.id', 'User.username', 'User.user_type', 'User.user_status', 'User.user_created', 'User.user_modified', 'Customer.id', 'Customer.customer_name', 'Customer.customer_gender', 'Customer.customer_dateofbirth', 'Customer.customer_number', 'Customer.customer_address', 'Customer.customer_city', 'Customer.customer_state', 'Customer.customer_zip_code', 'Customer.customer_lat', 'Customer.customer_lng, Customer.customer_created', 'Customer.customer_modified');
		
    $Service = $this->User->find('all',array(
				'fields' => $fields,
				'recursive' => 0,
				'conditions' => array('User.id' => $userType)
				)
			);
			
		//prd($Service[0]);
    if (!$Service) {
        throw new NotFoundException(__('Invalid User'));
    }

    if ($this->request->is(array('post', 'put'))) {
        
				
				$this->request->data['User']['id'] = $userType;
				$this->request->data['Customer']['id'] = $Service[0]['Customer']['id'];
				$this->request->data['User']['user_modified'] = date('Y-m-d H:i:s', strtotime('now'));
				$this->request->data['Customer']['customer_dateofbirth'] = date('Y-m-d', strtotime(str_replace("", "", $this->request->data['Customer']['customer_dateofbirth'])));
				$this->User->id = $userType;
				$this->Customer->user_id = $userType;
				if(empty($this->request->data['User']['password'])){	//this for remove validation if password feild not change.
					unset($this->request->data['User']['password']);
					unset($this->request->data['User']['confirm_password']);
				}
        if ($this->User->saveAssociated($this->request->data)) {
            $this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
            return $this->redirect(array('controller' => 'customers', 'action' => 'admin_index'));
        }
        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
    }

		
    if (!$this->request->data) {
							$Service[0]['Customer']['customer_dateofbirth'] = date('m/d/Y', strtotime($Service[0]['Customer']['customer_dateofbirth']));
        $this->request->data = $Service[0];
    }
		$this->set("userType", '3');
	}
	
	public function admin_delete($id = NULL){
		if($this->request->is('post')){
			$this->loadModel('User');
			$data = $this->request->data;
			$this->User->updateAll(
				array('User.user_status' => 2),
				array('User.id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
	
	public function admin_changestatus(){
		if($this->request->is('post')){
			$this->loadModel('User');
			$data = $this->request->data;
			$this->User->updateAll(
				array('User.user_status' => $data['status']),
				array('User.id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
	
	public function admin_customerlist(){

		$this->loadModel('User');
		
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		$conditions = array("User.user_type"=>"3", "User.user_status <> 2");

		$count = $this->User->find('count', array(
			'recursive' => -1,
			'conditions' => $conditions,
			)
		);
		//prd($count);
		if ($count > 0)
		{
			$total_pages = ceil($count / $limit);
		}
		else
		{
			$total_pages = 0;
		}

		if ($page > $total_pages)
		{
			$page = $total_pages;
		}

		$start = $limit * $page - $limit;

		$fields = array('User.id', 'User.username', 'User.user_type', 'User.user_status', 'User.user_created', 'User.user_modified', 'Customer.customer_name', 'Customer.customer_gender', 'Customer.customer_dateofbirth', 'Customer.customer_number', 'Customer.customer_address', 'Customer.customer_city', 'Customer.customer_state', 'Customer.customer_zip_code', 'Customer.customer_lat', 'Customer.customer_lng, Customer.customer_created', 'Customer.customer_modified');

		$UserList = $this->User->find("all",array(
			'fields' => $fields,
			'recursive' => 0,
			'conditions' => $conditions,
			'order' => $order_by,
			'limit' => $limit,
			'offset' => $start
			)
		);
		//prd($UserList);
		$temp = array();

		$responce = new stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;

		$i = 0;
		if (is_array($UserList))
		{
			$temp = array();
			foreach ($UserList as $Users): {

					$gender = '';
					
					$username = $Users['User']['username'];
					$customername = $Users['Customer']['customer_name'];
					if($Users['Customer']['customer_gender'] == '0'){
						$gender = 'Male';
					} 
					if($Users['Customer']['customer_gender'] == '1'){
						$gender = 'Female';
					}
					
					$dob = $Users['Customer']['customer_dateofbirth'];
					$contactno = $Users['Customer']['customer_number'];
					
					$action = '';
					$edit = '';
					$delete = '';
					
					if ($Users['User']['user_status'] == 1)
					{
						$action .= '<i class="fa fa-circle fa-lg clrDisable" onclick="changeUserStatus(' . $Users['User']['id'] . ',0)" title="Change Status"></i>';
					}
					else if ($Users['User']['user_status'] == 0)
					{
						$action .= '<i class="fa fa-circle fa-lg clrEmable" onclick="changeUserStatus(' . $Users['User']['id'] . ',1)" title="Change Status"></i>';
					}

					$edit .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/customers/edit/' . $Users['User']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
					
					$delete .= '<center><i class="fa fa-trash fa-lg" onclick="userdelete(' . $Users['User']['id'] . ')" title="Delete Content"></i></center>'; 

					$responce->rows[$i]['id'] = $Users['User']['id'];
					$responce->rows[$i]['cell'] = array($i+1, $username, $customername, $gender, $dob, $contactno, $action, $edit, $delete);
					$i++;
				}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	
	}
}