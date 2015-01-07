<?php
class CustomersController extends AppController{
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('register');
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
				//prd($this->request->data);
				$this->User->id = $userType;
				$this->Customer->user_id = $userType;
				if(empty($this->request->data['User']['password'])){
					unset($this->request->data['User']['password']);
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
        //$this->request->data['Customer'] = $Service[0]['Customer'];
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