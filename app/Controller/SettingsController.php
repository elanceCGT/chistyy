<?php
App::uses('AppController', 'Controller');

class SettingsController extends AppController {

	public function beforeFilter() {
	
		parent::beforeFilter();
		$this->Auth->allow('');
		
	}

	/**
	 * Setting Index
	*/	
	public function admin_index(){ 
		$this->set('title_for_layout',"Settings");
        array_push($this->AdminListings, array('controller' => 'settings', 'action' => 'admin_index', 'heading' => 'Settings'));
		$this->set('Listings', $this->AdminListings);
		
		$request = $this->request;
		
		$record = $this->Setting->find('all');
		
		if($request->isPost() && !empty($request->data)){
			$data = array();
			$data				=	$request->data;
			
			$this->Setting->set($data);
			
			if ($this->Setting->validates()) 
			{
				$i=0;
				while(isset($record[$i]))
				{
					$Userdata = array();
					$Userdata['Setting']['value'] = $data["Setting"][$record[$i]['Setting']['unique_name']];
					$this->Setting->id=$record[$i]['Setting']['id'];
					$this->Setting->save($Userdata);
					$i++;
				}
				$this->Session->setFlash(__('Settings updated successfully.'),'flash_success');
				$this->redirect(array('action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__("Invalid Data Filling."),'flash_error');
			}
			
		}
		$this->set('record',$record);
	}
	
}