<?php

App::uses('AppController', 'Controller');

class ContactController extends AppController
{

	public $components = array(
		/*'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email', 'password' => 'password'),
				)
			)
		)*/
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$allowArr = array("index");
		$this->Auth->allow($allowArr);
	}
	
	public function index(){ 
		$this->set('title_for_layout', 'Contact Us');
		$this->loadModel('Contact');
		$this->loadModel('User');

		if (($this->request->is('post') || $this->request->is('put'))  )
		{
				$this->request->data['Contact']['contact_created'] = date('Y-m-d H:i:s');
				$data = $this->request->data;
				
				$admin_detail = $this->User->find('first',array('conditions'=>array('user_type=0')));
				//$adminmail = $admin_detail['User']['username'];
				$adminmail = "sunilkalwani@cgt.co.in";
				if ($this->Contact->save($data))
				{
					$Email = new CakeEmail();
					$Email->from(array($data['Contact']['contact_email'] => 'Contact Request'))
					->to($adminmail)
					->subject($data['Contact']['contact_subject'])
					->send($data['Contact']['contact_message']);

					$this->Session->setFlash(__('Request Sent successfully'), 'flash_success');
					$this->redirect(array("action" => "index"));
				}
		}
		/*$services = $this->Service->find('all', array(
    		'conditions' => array('Service.service_status' => '0'),
    		//'fields'     => array('Service.id', 'Service.service_name')
		));*/
		//$this->set('services',$services);	
	}

}
