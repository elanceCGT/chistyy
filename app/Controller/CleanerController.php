<?php
class CleanerController extends AppController{

	public function admin_index(){
		$this->set('title_for_layout', 'Cleaner(s)');
	}
	
	public function admin_add($userType = NULL){

		$this->set('title_for_layout', 'Add Cleaner');
		$this->loadModel('User');
		$this->loadModel('ServiceProvider');
		$this->loadModel('Service');
		$this->loadModel('Category');
		$this->loadModel('Cleaner');

		if($this->request->is('post')){
			$post_data = $this->request->data;

			if(empty($post_data['Cleaner']['category_id'])) {
				unset($post_data['Cleaner']['category_id']);
			}

			if(!empty($post_data['Cleaner']['cleaner_dateofbirth'])) {
				$post_data['Cleaner']['cleaner_dateofbirth'] = date('Y-m-d', strtotime($post_data['Cleaner']['cleaner_dateofbirth']));
			}

			//prd($post_data);
			if($this->User->saveAssociated($post_data)){
			 	$this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'cleaner', 'action' => 'admin_index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
		}

		$ServiceProvider = $this->User->ServiceProvider->find('all', array(
			'fields' => array('ServiceProvider.user_id', 'ServiceProvider.provider_name'),
			'conditions' => array('User.user_status <> 2')
		));

		$Service = $this->Category->Service->find('all', array(
			'fields' => array('Service.id', 'Service.service_name', 'Service.category_id'),
			'conditions' => array('Service.service_status <> 2', 'Category.category_status <> 2'),
			'order' => array('Service.category_id')
		));

		$this->set("ServiceProvider", $this->createlist($ServiceProvider, "user_id", "provider_name"));
		$this->set("Service", $this->createlist($Service, "id", "service_name"));
		$this->set("category_service_link", json_encode($this->createlist($Service, "id", "category_id")));
		$this->set("userType", $userType);
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

	public function admin_edit($user_id = NULL){

		$this->set('title_for_layout', 'Edit Cleaner');

		$this->loadModel('User');
		$this->loadModel('ServiceProvider');
		$this->loadModel('Service');
		$this->loadModel('Category');
		$this->loadModel('Cleaner');
		
		if (!$user_id) {
        	throw new NotFoundException(__('Invalid User'));
    	}

		$fields = array('User.id', 'User.username', 'Cleaner.id', 'Cleaner.cleaner_name, Cleaner.cleaner_gender, Cleaner.cleaner_dateofbirth, Cleaner.cleaner_caontact_number, Cleaner.cleaner_address, Cleaner.cleaner_city, Cleaner.cleaner_state, Cleaner.cleaner_zip_code', 'Cleaner.cleaner_lng', 'Cleaner.cleaner_lat','Cleaner.service_provider_id');

		$Service = $this->User->find("all",array(
			'fields' => $fields,
			'recursive' => 0,
			'conditions' => array('User.id' => $user_id)
			
			)
		);
			
		//prd($Service[0]);

    	if (!$Service) {
        	throw new NotFoundException(__('Invalid User'));
    	}

	    if ($this->request->is(array('post', 'put'))) {
			
			$this->request->data['User']['id'] = $user_id;
			$this->request->data['ServiceProvider']['id'] = $Service[0]['Cleaner']['service_provider_id'];
			$this->request->data['User']['user_modified'] = date('Y-m-d H:i:s', strtotime('now'));
			
			if(empty($this->request->data['User']['password'])){
				unset($this->request->data['User']['password']);
			}

			if(isset($this->request->data['Cleaner']['cleaner_dateofbirth']) && !empty($this->request->data['Cleaner']['cleaner_dateofbirth'])){
				$this->request->data['Cleaner']['cleaner_dateofbirth'] = date('Y-m-d', strtotime($this->request->data['Cleaner']['cleaner_dateofbirth']));
			}
			//prd($this->request->data);

	        if ($this->User->saveAssociated($this->request->data)) {
	            $this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'cleaner', 'action' => 'admin_index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
	    }

		if (!$this->request->data) {
			$Service[0]['Cleaner']['cleaner_dateofbirth'] = date('m/d/Y', strtotime($Service[0]['Cleaner']['cleaner_dateofbirth']));
	        $this->request->data = $Service[0];
	    }
		
	    $ServiceProvider = $this->User->ServiceProvider->find('all', array(
			'fields' => array('ServiceProvider.user_id', 'ServiceProvider.provider_name'),
			'conditions' => array('User.user_status <> 2')
		));

		$Service = $this->Category->Service->find('all', array(
			'fields' => array('Service.id', 'Service.service_name', 'Service.category_id'),
			'conditions' => array('Service.service_status <> 2', 'Category.category_status <> 2'),
			'order' => array('Service.category_id')
		));

		$this->set("ServiceProvider", $this->createlist($ServiceProvider, "user_id", "provider_name"));
		$this->set("Service", $this->createlist($Service, "id", "service_name"));
		$this->set("category_service_link", json_encode($this->createlist($Service, "id", "category_id")));
		$this->set("user_id", $user_id);
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
	
	public function admin_cleanerlist(){

		$this->loadModel('User');
		
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		$conditions = array("User.user_type"=>"2", "User.user_status <> 2");

		$count = $this->User->find('count', array('recursive' => -1, 'conditions' => $conditions));
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

		$fields = array('User.id', 'User.username', 'User.user_type', 'User.user_status', 'User.user_created', 'User.user_modified', 'Cleaner.cleaner_name', 'Cleaner.cleaner_gender', 'Cleaner.cleaner_dateofbirth', 'Cleaner.cleaner_caontact_number', 'Cleaner.cleaner_address', 'Cleaner.cleaner_city', 'Cleaner.cleaner_state', 'Cleaner.cleaner_zip_code');

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
					$cleaner_name = $Users['Cleaner']['cleaner_name'];
					$cleaner_gender = $Users['Cleaner']['cleaner_gender'];
					$cleaner_dateofbirth = $Users['Cleaner']['cleaner_dateofbirth'];
					$cleaner_caontact_number = $Users['Cleaner']['cleaner_caontact_number'];
					$cleaner_address = $Users['Cleaner']['cleaner_address'];
					//$provider_website = $Users['Cleaner']['provider_website'];
					//$provider_email_address = $Users['Cleaner']['provider_email_address'];

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

					$edit .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/cleaner/edit/' . $Users['User']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
					
					$delete .= '<center><i class="fa fa-trash fa-lg" onclick="userdelete(' . $Users['User']['id'] . ')" title="Delete Content"></i></center>'; 

					$responce->rows[$i]['id'] = $Users['User']['id'];
					//'User Name', 'Cleaner Name', 'Gender', 'DOB', 'Contact Number'
					$responce->rows[$i]['cell'] = array($i+1, $username, $cleaner_name, $cleaner_gender, $cleaner_dateofbirth, $cleaner_caontact_number, /*$provider_website, $provider_email_address,*/ $action, $edit, $delete);
					$i++;
				}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	
	}
}