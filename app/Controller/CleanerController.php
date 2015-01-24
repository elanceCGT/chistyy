<?php
class CleanerController extends AppController{

	public function index(){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Manage Cleaner(S)');
		$this->loadModel('User');

		$conditions = array("User.user_type"=>"2", "User.user_status <> 2");
		$fields = array('User.id', 'User.username', 'User.user_type', 'User.user_status', 'User.user_created', 'User.user_modified', 'Cleaner.first_na', 'Cleaner.last_na', 'Cleaner.gender_cd', 'Cleaner.phone_no', 'Cleaner.active_dt', 'Cleaner.city_mn', 'Cleaner.prov_mn', 'Cleaner.addr_postal_cd');

		$UserList = $this->User->find("all",array(
			'fields' => $fields,
			'recursive' => 0,
			'conditions' => $conditions,
			'order' => 'User.id'/*,
			'limit' => $limit,
			'offset' => $start*/
			)
		);
		//prd($UserList);
		$this->set('UserList', $UserList);
	}

	public function dashbord(){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Cleaner-Dashbord');
		//$events = $this->showschedule();
		//$this->set('events', $events);
	}

	public function showschedule(){
		$startdate = $_REQUEST["start"];

		$enddate = $_REQUEST["end"];

		$data = $this->request->data;
		
		$this->loadModel('Schedule');

		$user_id = $this->Session->read('Auth.User.id');
		
		$provider_id = $this->Session->read('Auth.User.Cleaner.service_provider_id');

		$conditions = array("Schedule.cleaner_id" => $user_id, "Schedule.provider_id" => $provider_id, "Schedule.avaliable_date >= " => $startdate, "Schedule.avaliable_date <= " => $enddate);

		$scheduleList = $this->Schedule->find(
			"all",
			array(
				'recursive' => 0,
				'conditions' => $conditions
			)
		);
		//prd($scheduleList);
		
		$yesno =  array("Y"=>"green", "N"=>"red", "L"=>"orange");
		$data = array();
		//$alldata = array();
		for($i=0; $i<count($scheduleList); $i++){
			//$data = array();
			for ($j=1; $j < 10; $j++) {

				//if ($j>2){continue;}
				
				$hourstatus = $details = '';
				//Date {Wed Jan 07 2015 16:00:00 GMT+0530 (IST)}
				//D M d Y
				$starttime = $endtime =  date('D M d Y', strtotime($scheduleList[$i]["Schedule"]["avaliable_date"]))." ";

				if($j<4){
					$starttime .= ($j+8).":00:00";
					$endtime .= ($j+9).":00:00";
					$hourstatus = $yesno[$scheduleList[$i]["Schedule"]["hour".$j]];
					$hourstatus2 = $scheduleList[$i]["Schedule"]["hour".$j];
				}elseif($j==4){
					$starttime .= "12:00:00";
					$endtime .= "13:00:00";
					$hourstatus = $yesno["L"];
					$hourstatus2 = "L";
				}elseif($j>4){
					$starttime .= ($j+8).":00:00";
					$endtime .= ($j+9).":00:00";
					$hourstatus = $yesno[$scheduleList[$i]["Schedule"]["hour".($j-1)]];
					$hourstatus2 = $scheduleList[$i]["Schedule"]["hour".($j-1)];
				}
				$details = $hourstatus;
				$data[] = array(
					'id' => $scheduleList[$i]["Schedule"]["id"],
					'title' => $details,
					'start' => $starttime,
					'end' => $endtime,
					'editable' => false,
					'color' => $hourstatus,
					'status' => $hourstatus2
				);	
			}
			//prd(json_encode($data));
			//if($i>1){ continue; }
			//$alldata[]["events"] = json_decode(json_encode($data));
			//$alldata[$i]["events"] = $data;
			//$alldata[$i]["color"]="yellow";
			//$alldata[$i]["textColor"]="black";
		}
		//prd($alldata);
		//prd(json_decode(json_encode($alldata)));
		$json = json_encode($data);
		//$json = json_encode($alldata);
		echo $json;
		exit();
	}

	public function updateschedule(){
		$data = $this->request->data;
		$time = $data['starttime'].".".$data['endtime'];

		switch ($time) {
			case '9:0:0.10:0:0':
				$field_name = "hour1";
				break;
			case '10:0:0.11:0:0':
				$field_name = "hour2";
				break;
			case '11:0:0.12:0:0':
				$field_name = "hour3";
				break;
			/*case '12:0:0.13:0:0':
				$field_name = "hour4";
				break;*/
			case '13:0:0.14:0:0':
				$field_name = "hour4";
				break;
			case '14:0:0.15:0:0':
				$field_name = "hour5";
				break;
			case '15:0:0.16:0:0':
				$field_name = "hour6";
				break;
			case '16:0:0.17:0:0':
				$field_name = "hour7";
				break;
			case '17:0:0.18:0:0':
				$field_name = "hour8";
				break;
			default:
				# code...
				break;
		}

		$user_id = $this->Session->read('Auth.User.id');
		$provider_id = $this->Session->read('Auth.User.Cleaner.service_provider_id');

		$this->loadModel('Schedule');

		$conditions = array("Schedule.cleaner_id"=>$user_id, "Schedule.provider_id"=>$provider_id, "Schedule.avaliable_date"=>$data['avaliabledate']);

		$ScheduleList = $this->Schedule->find(
			"all",
			array(
				'recursive' => 0,
				'conditions' => $conditions
			)
		);

		//prd($ScheduleList);
		//prd($ScheduleList);

		if($this->request->is('post')){
			$this->loadModel('User');
			$data = $this->request->data;
			$dataarray = array();
			if(count($ScheduleList)>0)
			{
				$dataarray['Schedule']['id'] = $ScheduleList[0]["Schedule"]["id"];
				$dataarray['Schedule']['provider_id'] = $provider_id;
				$dataarray['Schedule']['cleaner_id'] = $user_id;
				$dataarray['Schedule']['avaliable_date'] = $data['avaliabledate'];
				$dataarray['Schedule'][$field_name] = $data['avaliablestatus'];

				prd($this->Schedule->save($dataarray));
				
			}else{
				$dataarray['Schedule']['provider_id'] = $provider_id;
				$dataarray['Schedule']['cleaner_id'] = $user_id;
				$dataarray['Schedule']['avaliable_date'] = $data['avaliabledate'];
				$dataarray['Schedule'][$field_name] = $data['avaliablestatus'];

				prd($this->Schedule->save($dataarray));
			}
			echo 1; exit;
		}
		echo 0; exit;
	}

	public function profile(){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Cleaner-Profile');

		$this->loadModel('User');
		$this->loadModel('ServiceProvider');
		$this->loadModel('Service');
		$this->loadModel('Category');
		$this->loadModel('Cleaner');
		
		$user_id = $this->Session->read('Auth.User.id');

		if (!$user_id) {
        	throw new NotFoundException(__('Invalid User'));
    	}
		$fields = array('User.id', 'User.username', 'Cleaner.*');	
		$Service = $this->User->find("all",array(
			'fields' => $fields,
			'recursive' => 0,
			'conditions' => array('User.id' => $user_id)
			
			)
		);	
			if (!$Service) {
        	throw new NotFoundException(__('Invalid User'));
    	}

	    if ($this->request->is(array('post', 'put'))) {
			
			$this->request->data['User']['id'] = $user_id;
			$this->request->data['ServiceProvider']['id'] = $Service[0]['Cleaner']['service_provider_id'];
			$this->request->data['User']['user_modified'] = date('Y-m-d H:i:s', strtotime('now'));
			
			if(empty($this->request->data['User']['password'])){	
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);
			}
			
			if(isset($this->request->data['Cleaner']['cleaner_dateofbirth']) && !empty($this->request->data['Cleaner']['cleaner_dateofbirth'])){
				$this->request->data['Cleaner']['cleaner_dateofbirth'] = date('Y-m-d', strtotime($this->request->data['Cleaner']['cleaner_dateofbirth']));
			}
			    if ($this->User->saveAssociated($this->request->data)) {
	            $this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'cleaner', 'action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
	    }

		if (!$this->request->data) {
			//$Service[0]['Cleaner']['cleaner_dateofbirth'] = date('m/d/Y', strtotime($Service[0]['Cleaner']['cleaner_dateofbirth']));
	        $this->request->data = $Service[0];
	    }
		
	    $ServiceProvider = $this->User->ServiceProvider->find('all', array(
			'fields' => array('ServiceProvider.user_id', 'ServiceProvider.full_busnes_na1'),
			'conditions' => array('User.user_status <> 2')
		));

		$Service = $this->Category->Service->find('all', array(
			'fields' => array('Service.id', 'Service.service_name', 'Service.category_id'),
			'conditions' => array('Service.service_status <> 2', 'Category.category_status <> 2'),
			'order' => array('Service.category_id')
		));

		$this->set("ServiceProvider", $this->createlist($ServiceProvider, "user_id", "full_busnes_na1"));
		$this->set("Service", $this->createlist($Service, "id", "service_name"));
		$this->set("category_service_link", json_encode($this->createlist($Service, "id", "category_id")));
		$this->set("user_id", $user_id);
	}

	public function add(){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Add-Cleaner');
		$this->loadModel('User');
		$this->loadModel('ServiceProvider');
		$this->loadModel('Service');
		$this->loadModel('Category');
		$this->loadModel('Cleaner');
		$this->loadModel('Schedule');

		$provider_id = $this->Session->read('Auth.User.id');

		if($this->request->is('post')){
			$post_data = $this->request->data;
			
			$post_data['User']['user_type'] = '2';
			$post_data['Cleaner']['service_provider_id'] = $provider_id;
			$post_data['Cleaner']['active_dt'] = date('Y-m-d');
			$post_data['Cleaner']['last_change_dt'] = date('Y-m-d H:i:s');
			
			//prd($post_data);

			/*if(!empty($post_data['Cleaner']['cleaner_dateofbirth'])) {
				$post_data['Cleaner']['cleaner_dateofbirth'] = date('Y-m-d', strtotime($post_data['Cleaner']['cleaner_dateofbirth']));
			}*/
			$cleaner = $this->User->saveAssociated($post_data);
			if($cleaner){

				$next_year = strtotime('+1 year');
				$current_time = time();

				$user_id = $this->User->getLastInsertID();

				$alldata =  array();
				while($current_time < $next_year){
				    $current_time = strtotime('+1 day', $current_time);
				    //print date('Y-m-d', $current_time).'<br />';
				    $dataarray = array();

				    $dataarray['Schedule']['provider_id'] = $provider_id;
					$dataarray['Schedule']['cleaner_id'] = $user_id;
					$dataarray['Schedule']['avaliable_date'] = date('Y-m-d', $current_time);

					$this->Schedule->create();
					$this->Schedule->save($dataarray);
				}
				

			 	$this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'cleaner', 'action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
		}

		$Service = $this->Category->Service->find('all', array(
			'fields' => array('Service.id', 'Service.service_name', 'Service.category_id'),
			'conditions' => array('Service.service_status <> 2', 'Category.category_status <> 2'),
			'order' => array('Service.category_id')
		));

		$this->set("Service", $this->createlist($Service, "id", "service_name"));
		$this->set("category_service_link", json_encode($this->createlist($Service, "id", "category_id")));
	}
	
	public function edit($user_id = NULL){
		$this->layout = 'innerpages'; 
		$this->set('title_for_layout', 'Edit-Cleaner');
		$this->loadModel('User');
		$this->loadModel('ServiceProvider');
		$this->loadModel('Service');
		$this->loadModel('Category');
		$this->loadModel('Cleaner');
		
		if (!$user_id) {
        	throw new NotFoundException(__('Invalid User'));
    	}
		$fields = array('User.id', 'User.username', 'Cleaner.*');	
		$Service = $this->User->find("all",
			array(
				'fields' => $fields,
				'recursive' => 0,
				'conditions' => array('User.id' => $user_id)
			)
		);	
			if (!$Service) {
        	throw new NotFoundException(__('Invalid User'));
    	}

	    if ($this->request->is(array('post', 'put'))) {
			
			$this->request->data['User']['id'] = $user_id;
			$this->request->data['ServiceProvider']['id'] = $Service[0]['Cleaner']['service_provider_id'];
			$this->request->data['User']['user_modified'] = date('Y-m-d H:i:s', strtotime('now'));
			
			if(empty($this->request->data['User']['password'])){	
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);
			}
			
			/*if(isset($this->request->data['Cleaner']['cleaner_dateofbirth']) && !empty($this->request->data['Cleaner']['cleaner_dateofbirth'])){
				$this->request->data['Cleaner']['cleaner_dateofbirth'] = date('Y-m-d', strtotime($this->request->data['Cleaner']['cleaner_dateofbirth']));
			}*/
			if ($this->User->saveAssociated($this->request->data)) {
	            $this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'cleaner', 'action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
	    }

		if (!$this->request->data) {
			/*$Service[0]['Cleaner']['cleaner_dateofbirth'] = date('m/d/Y', strtotime($Service[0]['Cleaner']['cleaner_dateofbirth']));*/
	        $this->request->data = $Service[0];
	    }
		
	    $ServiceProvider = $this->User->ServiceProvider->find('all', array(
			'fields' => array('ServiceProvider.user_id', 'ServiceProvider.full_busnes_na1'),
			'conditions' => array('User.user_status <> 2')
		));

		$Service = $this->Category->Service->find('all', array(
			'fields' => array('Service.id', 'Service.service_name', 'Service.category_id'),
			'conditions' => array('Service.service_status <> 2', 'Category.category_status <> 2'),
			'order' => array('Service.category_id')
		));

		$this->set("ServiceProvider", $this->createlist($ServiceProvider, "user_id", "full_busnes_na1"));
		$this->set("Service", $this->createlist($Service, "id", "service_name"));
		$this->set("category_service_link", json_encode($this->createlist($Service, "id", "category_id")));
		$this->set("user_id", $user_id);
	}
	
	public function delete(){
		if($this->request->is('get')){
			$this->loadModel('User');
			$data = $this->request->params['named']; 
			$id	=	$this->User->updateAll(
				array('User.user_status' => 2),
				array('User.id' => $data['id'])
			);		
			if($id){
				$this->Session->setFlash(__('Your User has been deleted.'), 'flash_success');
				return $this->redirect(array('controller' => 'cleaner', 'action' => 'index'));
			}
		}
		if(!isset($id) && !$id){
		 $this->Session->setFlash(__('Some Error Occured.'), 'flash_error');
	   return $this->redirect(array('controller' => 'cleaner', 'action' => 'index'));
		}
	}
	
	public function changestatus(){ 
		if($this->request->is('get')){
			$this->loadModel('User');
			$data = $this->request->params['named'];
			$id	=	$this->User->updateAll(
				array('User.user_status' => $data['status']),
				array('User.id' => $data['id'])
			);
			if($id){
				$this->Session->setFlash(__('Your User status has been updated.'), 'flash_success');
				return $this->redirect(array('controller' => 'cleaner', 'action' => 'index'));
			}
		}
		if(!isset($id) && !$id){
		 $this->Session->setFlash(__('Some Error Occured.'), 'flash_error');
	   return $this->redirect(array('controller' => 'cleaner', 'action' => 'index'));
		}
	}

	/**/
	public function services(){

		$this->layout = 'innerpages';
		$cleanerid = $this->Session->read('Auth.User.id');
		$ServiceProviderId = $this->Session->read('Auth.Cleaner.id');

		$conditions = array("CleanerService.cleaner_id"=>$cleanerid, "CleanerService.delete_status <> 2");

		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('CleanerService');

		$fields = array('CleanerService.*','Service.service_name','Category.category_name','SubCategory.category_name');

		$Services = $this->CleanerService->find("all",array(
			'fields' => $fields,
			'joins'=>array(
				array(
					'table' => 'booking_services',
					'alias' => 'Service',
					'type' => 'INNER',
					'conditions' => array('Service.id=CleanerService.servic_cd','Service.service_status <> 2')
				),
				array(
					'table' => 'booking_categories',
					'alias' => 'Category',
					'type' => 'INNER',
					'conditions' => array('Category.id=CleanerService.servic_cat_cd','Category.category_status <> 2')
				),
				array(
					'table' => 'booking_categories',
					'alias' => 'SubCategory',
					'type' => 'INNER',
					'conditions' => array('SubCategory.id=CleanerService.servic_subcat_cd','SubCategory.category_status <> 2')
				)
			),
			//'recursive' => 0,
			'conditions' => $conditions,
			//'order' => $order_by,
			//'limit' => $limit,
			//'offset' => $start
			)
		);
		//prd($Services);
		$this->set('Services', $Services);
		$this->set('title_for_layout', 'Cleaner Services');
	}

	public function addservice(){
		$this->layout = 'innerpages';
		$cleanerid = $this->Session->read('Auth.User.id');
		$ServiceProviderId = $this->Session->read('Auth.User.Cleaner.service_provider_id');

		$this->set('title_for_layout', 'Add Service');
		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('CleanerService');

		if($this->request->is('post')){
			if($this->CleanerService->validates()){

				$data_array = $this->request->data;
				$data_array['CleanerService']['cleaner_id'] = $cleanerid;
				$data_array['CleanerService']['provider_id'] = $ServiceProviderId;
				$data_array['CleanerService']['created'] = date('Y-m-d H:i:s');
				$data_array['CleanerService']['modified'] = date('Y-m-d H:i:s');
				//prd($data_array);
				$data = $this->CleanerService->save($data_array);
				
				if($data){
					//prd($data);
				 	$this->Session->setFlash(__('Your Service added.'), 'flash_success');
		            return $this->redirect(array('controller' => 'cleaner', 'action' => 'services'));
		        }
		        $this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
			}
		}
		
		$servic_cat_cd = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => 0),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);
		$this->set('servic_cat_cd', $servic_cat_cd);
	}

	public function editservice($Id){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Edit Service');
		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('CleanerService');

		$Service = $this->CleanerService->find("all",array(
			'recursive' => 0,
			'conditions' => array('CleanerService.id' => $Id)
			)
		);

		if($this->request->is(array('post', 'put'))){
			if($this->CleanerService->validates()){
				//prd($this->request->data);
				$data_array = $this->request->data;
				$data_array['CleanerService']['id'] = $Service[0]["CleanerService"]["id"];
				$data_array['CleanerService']['modified'] = date('Y-m-d H:i:s');
				//prd($data_array);
				$data = $this->CleanerService->save($data_array);
				
				if($data){
					//prd($data);
				 	$this->Session->setFlash(__('Your Service Updated.'), 'flash_success');
		            return $this->redirect(array('controller' => 'cleaner', 'action' => 'services'));
		        }
		        $this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
			}else{
				$errors = $this->CleanerService->validationErrors;
				prd($errors);
			}
			$this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
		}
		
		$servic_cat_cd = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => 0),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);

		$servic_subcat_cd = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => $Service[0]["CleanerService"]["servic_cat_cd"]),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);
		$servic_cd = $this->Service->find('list',
			array(
				'conditions' => array('Service.service_status' => 0, 'Service.category_id' => $Service[0]["CleanerService"]["servic_cat_cd"], 'Service.sub_category_id' => $Service[0]["CleanerService"]["servic_subcat_cd"]),
				'fields' => array('Service.id', 'Service.service_name'),
				'order' => array('Service.service_name')
			)
		);

		$this->set('servic_cat_cd', $servic_cat_cd);
		$this->set('servic_subcat_cd', $servic_subcat_cd);
		$this->set('servic_cd', $servic_cd);

		if (!$this->request->data) {
	    	//prd($Service[0]);
	        $this->request->data = $Service[0];
	    }
	}
	public function deleteservice($id = NULL){
		$data = $this->request->data;

		if($id != 0 || $id > 0){

			$this->loadModel('CleanerService');
			
			$this->CleanerService->updateAll(
				array('CleanerService.delete_status' => 2),
				array('CleanerService.id' => $id),
				array('CleanerService.user_id' => $this->Session->read('Auth.User.id'))
			);
			$this->Session->setFlash(__('Your Service is Deleted.'), 'flash_success');
		}else{
			$this->Session->setFlash(__('Unable to Deleted your Service.'), 'flash_error');
		}
		return $this->redirect(array('controller' => 'cleaner', 'action' => 'services'));
		exit;
	}
	/**/
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
		$this->loadModel('Schedule');

		if($this->request->is('post')){
			$post_data = $this->request->data;

			$post_data['User']['user_type'] = 2;
			$post_data['Cleaner']['active_dt'] = date('Y-m-d');
			//$post_data['Cleaner']['provider_created'] = date('Y-m-d H:i:s');
			$post_data['Cleaner']['last_change_dt'] = date('Y-m-d H:i:s');

			/*if(empty($post_data['Cleaner']['category_id'])) {
				unset($post_data['Cleaner']['category_id']);
			}*/

			/*if(!empty($post_data['Cleaner']['cleaner_dateofbirth'])) {
				$post_data['Cleaner']['cleaner_dateofbirth'] = date('Y-m-d', strtotime($post_data['Cleaner']['cleaner_dateofbirth']));
			}*/

			//prd($post_data);
			if($this->User->saveAssociated($post_data)){

				$next_year = strtotime('+1 year');
				$current_time = time();
				$service_provider_id = $post_data['Cleaner']['service_provider_id'];
				$cleaner_id = $this->User->getLastInsertID();

				$alldata =  array();

				while($current_time < $next_year){
				    $current_time = strtotime('+1 day', $current_time);
				    //print date('Y-m-d', $current_time).'<br />';
				    $dataarray = array();

				    $dataarray['Schedule']['provider_id'] = $service_provider_id;
					$dataarray['Schedule']['cleaner_id'] = $cleaner_id;
					$dataarray['Schedule']['avaliable_date'] = date('Y-m-d', $current_time);

					$this->Schedule->create();
					$this->Schedule->save($dataarray);
				}

			 	$this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'cleaner', 'action' => 'admin_index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
		}

		$ServiceProvider = $this->User->ServiceProvider->find('all', array(
			'fields' => array('ServiceProvider.user_id', 'ServiceProvider.full_busnes_na1'),
			'conditions' => array('User.user_status <> 2')
		));

		$Service = $this->Category->Service->find('all', array(
			'fields' => array('Service.id', 'Service.service_name', 'Service.category_id'),
			'conditions' => array('Service.service_status <> 2', 'Category.category_status <> 2'),
			'order' => array('Service.category_id')
		));

		$this->set("ServiceProvider", $this->createlist($ServiceProvider, "user_id", "full_busnes_na1"));
		$this->set("Service", $this->createlist($Service, "id", "service_name"));
		$this->set("category_service_link", json_encode($this->createlist($Service, "id", "category_id")));
		$this->set("userType", $userType);
	}
	
	public function subcatselectbox(){
		if($this->request->is('post')){
			$maincatid = $this->request->data['maincatid'];
			$this->loadModel('Category');
			$subcategory = $this->Category->find('list',
				array(
					'conditions' => array('Category.category_status' => 0,'Category.parent_id' => $maincatid),
					'fields' => array('Category.id', 'Category.category_name'),
					'order' => array('Category.category_name')
				)
			);
			//prd($subcategory);
			if(count($subcategory)>0){
				foreach ($subcategory as $key => $value) {
					echo '<option value="'.$key.'">'.$value.'</option>';
				}
			}else{
				echo '<option value=""></option>';
			}
			exit;
		}
		echo '<option value=""></option>';
		exit;
	}

	public function serviceselectbox(){
		if($this->request->is('post')){
			
			$maincatid = $this->request->data['maincatid'];

			$subcatid = $this->request->data['subcatid'];

			$this->loadModel('Service');
			$services = $this->Service->find('list',
				array(
					'conditions' => array('Service.service_status' => 0,'Service.sub_category_id' => $subcatid, 'Service.category_id'=> $maincatid),
					'fields' => array('Service.id', 'Service.service_name'),
					'order' => array('Service.service_name')
				)
			);
			//prd($services);
			if(count($services)>0){
				foreach ($services as $key => $value){
					echo '<option value="'.$key.'">'.$value.'</option>';
				}
			}else{
				echo '<option value=""></option>';
			}
			exit;
		}
		echo '<option value=""></option>';
		exit;
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

		$fields = array('User.id', 'User.username', 'Cleaner.id', 'Cleaner.first_na', 'Cleaner.last_na', 'Cleaner.gender_cd', 'Cleaner.contry_mn', 'Cleaner.prov_mn', 'Cleaner.city_mn', 'Cleaner.addr_postal_cd', 'Cleaner.cleaner_lng', 'Cleaner.cleaner_lat','Cleaner.service_provider_id', 'Cleaner.addr_fsa', 'Cleaner.addr_postal_cd', 'Cleaner.busnes_addr_tx', 'Cleaner.mail_addr_tx', 'Cleaner.email_addr_tx', 'Cleaner.busnes_phone_no', 'Cleaner.busnes_fax_no', 'Cleaner.phone_no', 'Cleaner.cleaner_lat', 'Cleaner.cleaner_lng', 'Cleaner.dstrct_mn');

		$Service = $this->User->find("all",array(
			'fields' => $fields,
			'recursive' => 0,
			'conditions' => array('User.id' => $user_id)
			
			)
		);
			if (!$Service) {
        	throw new NotFoundException(__('Invalid User'));
    	}

	    if ($this->request->is(array('post', 'put'))) {
			
			$this->request->data['User']['id'] = $user_id;
			$this->request->data['Cleaner']['id'] = $Service[0]['Cleaner']['id'];
			$this->request->data['User']['user_modified'] = date('Y-m-d H:i:s', strtotime('now'));
			
			if(empty($this->request->data['User']['password'])){
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);
			}
			//prd($this->request->data);
			/*if(isset($this->request->data['Cleaner']['cleaner_dateofbirth']) && !empty($this->request->data['Cleaner']['cleaner_dateofbirth'])){
				$this->request->data['Cleaner']['cleaner_dateofbirth'] = date('Y-m-d', strtotime($this->request->data['Cleaner']['cleaner_dateofbirth']));
			}*/
			//prd($this->request->data);

	        if ($this->User->saveAssociated($this->request->data)) {
	            $this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'cleaner', 'action' => 'admin_index'));
	        }
	        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
	    }

		if (!$this->request->data) {
			//$Service[0]['Cleaner']['cleaner_dateofbirth'] = date('m/d/Y', strtotime($Service[0]['Cleaner']['cleaner_dateofbirth']));
	        $this->request->data = $Service[0];
	    }
		
	    $ServiceProvider = $this->User->ServiceProvider->find('all', array(
			'fields' => array('ServiceProvider.user_id', 'ServiceProvider.full_busnes_na1'),
			'conditions' => array('User.user_status <> 2')
		));

		$Service = $this->Category->Service->find('all', array(
			'fields' => array('Service.id', 'Service.service_name', 'Service.category_id'),
			'conditions' => array('Service.service_status <> 2', 'Category.category_status <> 2'),
			'order' => array('Service.category_id')
		));

		$this->set("ServiceProvider", $this->createlist($ServiceProvider, "user_id", "full_busnes_na1"));
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

		$fields = array('User.id', 'User.username', 'User.user_type', 'User.user_status', 'User.user_created', 'User.user_modified', 'Cleaner.first_na', 'Cleaner.last_na', 'Cleaner.gender_cd', 'Cleaner.phone_no', 'Cleaner.busnes_phone_no', 'Cleaner.city_mn', 'Cleaner.prov_mn', 'Cleaner.addr_postal_cd', 'Cleaner.active_dt', 'Cleaner.busnes_addr_tx','Cleaner.service_provider_id');

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
			
			$gender = array(0 => "Male", 1 => "Female");

			foreach ($UserList as $Users): {
					
					$username = $Users['User']['username'];
					$cleaner_name = $Users['Cleaner']['first_na']." ".$Users['Cleaner']['last_na'];
					$cleaner_gender = $gender[$Users['Cleaner']['gender_cd']];
					$cleaner_dateofbirth = $Users['Cleaner']['active_dt'];
					$cleaner_caontact_number = $Users['Cleaner']['phone_no'];
					$cleaner_address = $Users['Cleaner']['busnes_addr_tx'];
					//$provider_website = $Users['Cleaner']['provider_website'];
					//$provider_email_address = $Users['Cleaner']['provider_email_address'];

					$action = '';
					$edit = '';
					$delete = '';

					$manageservice = '<a href="' . $this->webroot . 'admin/cleaner/services/'.$Users['User']['id'].'/'.$Users['Cleaner']['service_provider_id'].'" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a>';
					
					if ($Users['User']['user_status'] == 1){
						$action .= '<i class="fa fa-circle fa-lg clrDisable" onclick="changeUserStatus(' . $Users['User']['id'] . ',0)" title="Change Status"></i>';
					}else if ($Users['User']['user_status'] == 0){
						$action .= '<i class="fa fa-circle fa-lg clrEmable" onclick="changeUserStatus(' . $Users['User']['id'] . ',1)" title="Change Status"></i>';
					}

					$edit .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/cleaner/edit/' . $Users['User']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
					
					$delete .= '<center><i class="fa fa-trash fa-lg" onclick="userdelete(' . $Users['User']['id'] . ')" title="Delete Content"></i></center>'; 

					$responce->rows[$i]['id'] = $Users['User']['id'];
					//'User Name', 'Cleaner Name', 'Gender', 'DOB', 'Contact Number'
					$responce->rows[$i]['cell'] = array($i+1, $username, $cleaner_name, $cleaner_gender, $cleaner_dateofbirth, $cleaner_caontact_number, $manageservice, /*$provider_website, $provider_email_address,*/ $action, $edit, $delete);
					$i++;
				}
			endforeach;
		}
		echo json_encode($responce);
		exit;	
	}

	public function admin_services($cleanerid,$serviceproviderid){
		$this->set('title_for_layout', 'Cleaner Service(s)');
		if(empty($serviceproviderid) || $serviceproviderid=="0"){
			$this->Session->setFlash(__('Unable to find Service(s).'), 'flash_error');
			return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'admin_index'));
		}
		$this->set('cleanerid', $cleanerid);
		$this->set('serviceproviderid', $serviceproviderid);
	}

	public function admin_CServicelist($cleanerid,$ServiceProviderId){

		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('CleanerService');
		
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		$conditions = array("CleanerService.cleaner_id"=>$cleanerid, "CleanerService.delete_status <> 2");

		$count = $this->CleanerService->find('count', array(
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

		$fields = array('CleanerService.*','Service.service_name','Category.category_name','SubCategory.category_name');

		$UserList = $this->CleanerService->find("all",array(
			'fields' => $fields,
			'joins'=>array(
				array(
					'table' => 'booking_services',
					'alias' => 'Service',
					'type' => 'INNER',
					'conditions' => array('Service.id=CleanerService.servic_cd','Service.service_status <> 2')
				),
				array(
					'table' => 'booking_categories',
					'alias' => 'Category',
					'type' => 'INNER',
					'conditions' => array('Category.id=CleanerService.servic_cat_cd','Category.category_status <> 2')
				),
				array(
					'table' => 'booking_categories',
					'alias' => 'SubCategory',
					'type' => 'INNER',
					'conditions' => array('SubCategory.id=CleanerService.servic_subcat_cd','SubCategory.category_status <> 2')
				)

			),
			//'recursive' => 0,
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
				//prd($Users);
				//'S No','Service Name', 'Main Category', 'Sub Category', 'Unit Cost', 'Unit Price', 'Edit', 'Delete'				
				$ServiceName = $Users['Service']['service_name'];
				$MainCategory = $Users['Category']['category_name'];
				$SubCategory = $Users['SubCategory']['category_name'];
				$UnitCost = $Users['CleanerService']['unit_cost'];
				$UnitPrice = $Users['CleanerService']['unit_price'];

				$manage_services = '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/serviceprovider/services/' . $Users['CleanerService']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
				$action = '';
				$edit = '';
				$delete = '';

				$edit .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/cleaner/editservice/' . $Users['CleanerService']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
				$delete .= '<center><i class="fa fa-trash fa-lg" onclick="servicedelete(' . $Users['CleanerService']['id'] . ')" title="Delete Content"></i></center>';

				$responce->rows[$i]['id'] = $Users['CleanerService']['id'];
				$responce->rows[$i]['cell'] = array($i+1, $ServiceName, $MainCategory, $SubCategory, $UnitCost, $UnitPrice, $edit, $delete);
				$i++;
			}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}

	public function admin_addservice($cleanerid,$ServiceProviderId){
		
		$this->set('title_for_layout', 'Add Service');
		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('CleanerService');

		if($this->request->is('post')){
			if($this->CleanerService->validates()){

				$data_array = $this->request->data;
				$data_array['CleanerService']['cleaner_id'] = $cleanerid;
				$data_array['CleanerService']['provider_id'] = $ServiceProviderId;
				$data_array['CleanerService']['created'] = date('Y-m-d H:i:s');
				$data_array['CleanerService']['modified'] = date('Y-m-d H:i:s');
				//prd($data_array);
				$data = $this->CleanerService->save($data_array);
				
				if($data){
					//prd($data);
				 	$this->Session->setFlash(__('Your Service added.'), 'flash_success');
		            return $this->redirect(array('controller' => 'cleaner', 'action' => 'admin_services',$cleanerid, $ServiceProviderId));
		        }
		        $this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
			}
		}
		
		$servic_cat_cd = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => 0),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);
		$this->set('servic_cat_cd', $servic_cat_cd);
	}

	public function admin_editservice($Id){
		
		$this->set('title_for_layout', 'Edit Service');
		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('CleanerService');

		$Service = $this->CleanerService->find("all",array(
			'recursive' => 0,
			'conditions' => array('CleanerService.id' => $Id)
			)
		);

		if($this->request->is(array('post', 'put'))){
			if($this->CleanerService->validates()){
				//prd($this->request->data);
				$data_array = $this->request->data;
				$data_array['CleanerService']['id'] = $Service[0]["CleanerService"]["id"];
				$data_array['CleanerService']['modified'] = date('Y-m-d H:i:s');
				//prd($data_array);
				$data = $this->CleanerService->save($data_array);
				
				if($data){
					//prd($data);
				 	$this->Session->setFlash(__('Your Service Updated.'), 'flash_success');
		            return $this->redirect(array('controller' => 'cleaner', 'action' => 'admin_services',$Service[0]["CleanerService"]["cleaner_id"],$Service[0]["CleanerService"]["provider_id"]));
		        }
		        $this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
			}else{
				$errors = $this->CleanerService->validationErrors;
				prd($errors);
			}
			$this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
		}
		
		$servic_cat_cd = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => 0),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);

		$servic_subcat_cd = $this->Category->find('list',
			array(
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => $Service[0]["CleanerService"]["servic_cat_cd"]),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);
		$servic_cd = $this->Service->find('list',
			array(
				'conditions' => array('Service.service_status' => 0, 'Service.category_id' => $Service[0]["CleanerService"]["servic_cat_cd"], 'Service.sub_category_id' => $Service[0]["CleanerService"]["servic_subcat_cd"]),
				'fields' => array('Service.id', 'Service.service_name'),
				'order' => array('Service.service_name')
			)
		);

		$this->set('servic_cat_cd', $servic_cat_cd);
		$this->set('servic_subcat_cd', $servic_subcat_cd);
		$this->set('servic_cd', $servic_cd);

		if (!$this->request->data) {
	    	//prd($Service[0]);
	        $this->request->data = $Service[0];
	    }
	}

	public function admin_deleteservice($id = NULL){

		if($this->request->is('post')){

			$this->loadModel('CleanerService');
			$data = $this->request->data;
			$this->CleanerService->updateAll(
				array('CleanerService.delete_status' => 2),
				array('CleanerService.id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}
}