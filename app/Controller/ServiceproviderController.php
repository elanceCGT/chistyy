<?php
class ServiceProviderController extends AppController{
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('register');
	}

	public function index(){
		$this->set('title_for_layout', 'Service Provider Dashbord');
	}

	public function admin_index(){
		$this->set('title_for_layout', 'Service Provider(s)');
	}
	

	public function register(){

		$this->set('title_for_layout', 'Service Provider Registration');
		$this->loadModel('User');
		$this->loadModel('ServiceProvider');
		
		if($this->request->is('post')){
			
			$logo = $this->request->data['ServiceProvider']['provider_logo'];
			unset($this->request->data['ServiceProvider']['provider_logo']);

			if (isset($logo['name']) && !empty($logo['name'])){
				$tempname = 'SP_'.strtotime('now')."_".$logo['name'];
			}
			
			$this->ServiceProvider->set($this->request->data['ServiceProvider']);

			if($this->ServiceProvider->validates()){

				if(!empty($logo['tmp_name'])){
					if(move_uploaded_file($logo['tmp_name'],ROOT."/app/webroot/uploads/service_provider/".$tempname)){
						$this->request->data['ServiceProvider']['provider_logo'] = $tempname;
					}
				}

				$data_array = $this->request->data;
				$data_array['User']['user_type'] = '1';

				//prd($data_array);

				if($this->User->saveAssociated($data_array)){
				 	$this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
		            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
		        }
		        @unlink(ROOT."/app/webroot/uploads/service_provider/".$tempname);
		        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
		        return $this->redirect(array('controller' => 'users', 'action' => 'signup'));

			} else {
				$this->request->data = $this->request->data;
			}
		}
	}

	public function admin_add(){

		$this->set('title_for_layout', 'Add Service Provider');
		$this->loadModel('User');
		$this->loadModel('ServiceProvider');

		if($this->request->is('post')){
			
			$logo = $this->request->data['ServiceProvider']['provider_logo'];
			unset($this->request->data['ServiceProvider']['provider_logo']);
			$tempname = 'SP_'.strtotime('now')."_".$logo['name'];
			$this->ServiceProvider->set($this->request->data['ServiceProvider']);
			
			if($this->ServiceProvider->validates()){
				if(!empty($logo['tmp_name'])){
					if(move_uploaded_file($logo['tmp_name'],ROOT."/app/webroot/uploads/service_provider/".$tempname)){
						$this->request->data['ServiceProvider']['provider_logo'] = $tempname;
					}
				}
				$data_array = $this->request->data;
				$data_array['User']['user_type'] = 1;

				if($this->User->saveAssociated($data_array)){
				 	$this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
		            return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'admin_index'));
		        }
		        unlink(ROOT."/app/webroot/uploads/service_provider/".$tempname);
		        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');

			} else {
				$this->request->data = $this->request->data;
			}
		}
	}
	
	public function admin_edit($user_id = NULL){

		$this->set('title_for_layout', 'Edit Service Provider');
		$this->loadModel('User');
		
		if (!$user_id) {
        	throw new NotFoundException(__('Invalid User'));
    	}

		$fields = array('User.id', 'User.username', 'User.user_type', 'User.user_status', 'User.user_created', 'User.user_modified', 'ServiceProvider.id','ServiceProvider.provider_name', 'ServiceProvider.contact_name', 'ServiceProvider.contact_number', 'ServiceProvider.street_address', 'ServiceProvider.provider_website', 'ServiceProvider.provider_email_address', 'ServiceProvider.provider_city', 'ServiceProvider.provider_state', 'ServiceProvider.provider_description', 'ServiceProvider.provider_zip_code', 'ServiceProvider.provider_lat', 'ServiceProvider.provider_lng');

		$Service = $this->User->find("all",array(
			'fields' => $fields,
			'recursive' => 0,
			'conditions' => array('User.id' => $user_id)
			)
		);
		//prd($Service);
    	if (!$Service) {
        	throw new NotFoundException(__('Invalid User'));
    	}

	    if ($this->request->is(array('post', 'put'))) {
	    	if(!empty($this->request->data['ServiceProvider']['provider_logo']['tmp_name'])){
				if(move_uploaded_file($this->request->data['ServiceProvider']['provider_logo']['tmp_name'], ROOT."/app/webroot/uploads/service_provider/".$tempname)){
					$tempname = 'SP_'.strtotime('now')."_".$logo['name'];
					$this->request->data['ServiceProvider']['provider_logo'] = $tempname;
				}
			} else {
				unset($this->request->data['ServiceProvider']['provider_logo']);
			}

			$this->request->data['User']['id'] = $user_id;
			$this->request->data['ServiceProvider']['id'] = $Service[0]['ServiceProvider']['id'];
			$this->request->data['User']['user_modified'] = date('Y-m-d H:i:s', strtotime('now'));
			
			if(empty($this->request->data['User']['password']) ){
				unset($this->request->data['User']['password']);
			}
	        
	        if ($this->User->saveAssociated($this->request->data)) {
	            $this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'admin_index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
	    }

	    if (!$this->request->data) {
	    	//prd($Service);
	        $this->request->data = $Service[0];
	    }
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
	
	public function admin_servicelist(){

		$this->loadModel('User');
		
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		$conditions = array("User.user_type"=>"1", "User.user_status <> 2");

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

		$fields = array('User.id', 'User.username', 'User.user_type', 'User.user_status', 'User.user_created', 'User.user_modified', 'ServiceProvider.provider_name', 'ServiceProvider.contact_name', 'ServiceProvider.contact_number', 'ServiceProvider.street_address', 'ServiceProvider.provider_website', 'ServiceProvider.provider_email_address');

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
				$provider_name = $Users['ServiceProvider']['provider_name'];
				$contact_name = $Users['ServiceProvider']['contact_name'];
				$contact_number = $Users['ServiceProvider']['contact_number'];
				$street_address = $Users['ServiceProvider']['street_address'];
				$provider_website = $Users['ServiceProvider']['provider_website'];
				$provider_email_address = $Users['ServiceProvider']['provider_email_address'];

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

				$edit .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/serviceprovider/edit/' . $Users['User']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
				$delete .= '<center><i class="fa fa-trash fa-lg" onclick="userdelete(' . $Users['User']['id'] . ')" title="Delete Content"></i></center>'; 

				$responce->rows[$i]['id'] = $Users['User']['id'];
				$responce->rows[$i]['cell'] = array($i+1, $username, $provider_name, $contact_name, $contact_number, $street_address, $provider_website, $provider_email_address, $action, $edit, $delete);
				$i++;
			}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}
}