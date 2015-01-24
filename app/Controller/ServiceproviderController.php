<?php
class ServiceProviderController extends AppController{
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('register');
	}

	public function index(){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Service Provider Dashbord');

		$this->loadModel('User');
		$user_id = $this->Session->read('Auth.User.id');

		$conditions = array("User.user_type"=>"2", "User.user_status <> 2", "Cleaner.service_provider_id"=>$user_id);

		$fields = array('Cleaner.user_id', 'Cleaner.first_na');

		$UserList = $this->User->find("all",array(
			'fields' => $fields,
			'recursive' => 0,
			'conditions' => $conditions,
			'order' => 'User.id',
			)
		);

		/*$UserListArr = array();
		foreach($UserList as $key => $value){
			foreach($value as $valuekey => $innervalue){
				$UserListArr[$innervalue["user_id"]] = $innervalue["cleaner_name"];
			}
		}
		$this->set('UserListArr', $UserListArr);*/
	}

	public function showschedule(){
		$startdate = $_REQUEST["start"];

		$enddate = $_REQUEST["end"];

		$data = $this->request->data;
		
		$this->loadModel('Schedule');

		$provider_id = $this->Session->read('Auth.User.id');
		
		$conditions = array("Schedule.provider_id" => $provider_id, "Schedule.avaliable_date >= " => $startdate, "Schedule.avaliable_date <= " => $enddate);

		$fields = array('Schedule.*', 'Cleaners.cleaner_name', 'Cleaners.cleaner_color_indicator');
		$scheduleList = $this->Schedule->find(
			"all",
			array(
				'fields'=>$fields,
				'joins'=>array(
					array(
						'table' => 'booking_cleaners',
						'alias' => 'Cleaners',
						'type' => 'INNER',
						'conditions' => array('Schedule.cleaner_id=Cleaners.user_id')
					)
				),
				'recursive' => 0,
				'conditions' => $conditions
			)
		);

		$data = array();

		for($i=0; $i<count($scheduleList); $i++){
			
			$yesno =  array("Y"=>$color = $scheduleList[$i]["Cleaners"]["cleaner_color_indicator"], "N"=>"red", "L"=>"orange");

			for ($j=1; $j < 10; $j++) {

				$hourstatus = $details = '';

				$starttime = $endtime =  date('D M d Y', strtotime($scheduleList[$i]["Schedule"]["avaliable_date"]))." ";

				$color = $scheduleList[$i]["Cleaners"]["cleaner_color_indicator"];

				if($j<4){
					$starttime .= ($j+8).":00:00";
					$endtime .= ($j+9).":00:00";
					$color = $yesno[$scheduleList[$i]["Schedule"]["hour".$j]];
					$hourstatus2 = $scheduleList[$i]["Schedule"]["hour".$j];
				}elseif($j==4){
					$starttime .= "12:00:00";
					$endtime .= "13:00:00";
					$color = $yesno["L"];
					$hourstatus2 = "L";
				}elseif($j>4){
					$starttime .= ($j+8).":00:00";
					$endtime .= ($j+9).":00:00";
					$color = $yesno[$scheduleList[$i]["Schedule"]["hour".($j-1)]];
					$hourstatus2 = $scheduleList[$i]["Schedule"]["hour".($j-1)];
				}

				$details = $scheduleList[$i]["Cleaners"]["cleaner_name"];

				$data[] = array(
					'id' => $scheduleList[$i]["Schedule"]["id"],
					'title' => $details,
					'start' => $starttime,
					'end' => $endtime,
					'editable' => false,
					//'color' => $hourstatus,
					'color' => $color,
					'status' => $hourstatus2
				);	
			}
		}
		$json = json_encode($data);
		echo $json;
		exit();	
	}

	public function admin_index(){
		$this->set('title_for_layout', 'Service Provider(s)');
	}
	
	public function bookings(){

		$this->loadModel('User');
		$this->loadModel('Booking');
		$user_id = $this->Session->read('Auth.User.id');

		//Date {Wed Jan 07 2015 16:00:00 GMT+0530 (IST)}

		$fields = array('Booking.id', 'Booking.customer_id', 'Booking.provider_id', 'Booking.cleaner_id', 'Booking.service_id', 'Booking.category_id', 'Booking.booking_date', 'Booking.parent_id', 'Booking.booking_time', 'Booking.number_of_rooms', 'Booking.number_of_bath_rooms', 'Booking.estimated_area', 'Booking.estimated_hours', 'Booking.estimated_price', 'Booking.booking_details', 'Booking.booking_status', 'Booking.booking_created', 'Booking.booking_modified', 'CONCAT(DATE_FORMAT(Booking.booking_date, "%a %b %d %Y")," ",Booking.booking_time) as sdt', 'DATE_FORMAT(DATE_ADD(CONCAT(Booking.booking_date," ",Booking.booking_time), INTERVAL Booking.estimated_hours HOUR), "%a %b %d %Y %T") as edt', 'Cleaners.cleaner_name', 'Cleaners.cleaner_color_indicator', 'Users.username', 'Customers.customer_name', 'Customers.customer_address', 'Customers.customer_zip_code', 'Customers.customer_zip_code', 'Customers.customer_number', 'Services.service_name');

		/*$bookings = $this->Booking->find("all",array(
			'fields' => $fields,
			'recursive' => 0,
			//'conditions' => array('Booking.service_provider_id' => $user_id)
			)
		);*/

		$bookings = $this->Booking->find(
			"all",
			array(
				'joins'=>array(
					array(
						'table' => 'booking_users',
						'alias' => 'Users',
						'type' => 'INNER',
						'conditions' => array('Users.id=Booking.cleaner_id')
					),
					array(
						'table' => 'booking_cleaners',
						'alias' => 'Cleaners',
						'type' => 'INNER',
						'conditions' => array('Cleaners.user_id=Users.id')
					),
					array(
						'table' => 'booking_users',
						'alias' => 'Users2',
						'type' => 'INNER',
						'conditions' => array('Users2.id=Booking.customer_id')
					),
					array(
						'table' => 'booking_customers',
						'alias' => 'Customers',
						'type' => 'INNER',
						'conditions' => array('Customers.user_id=Users2.id')
					),
					array(
						'table' => 'booking_services',
						'alias' => 'Services',
						'type' => 'INNER',
						'conditions' => array('Services.id=Booking.service_id')
					)
				),
				'fields'=>$fields,
				'conditions' =>array('Booking.booking_status'=>1, 'Cleaners.service_provider_id'=>$user_id)
		));

		//prd($bookings);

		$data = array();

		for($i=0; $i<count($bookings); $i++){
			$details = '';
			$details = 'Cleaner Name:'.$bookings[$i]["Cleaners"]["cleaner_name"].' '.$bookings[$i]["Booking"]["booking_details"].' Estimated Hours: '.$bookings[$i]["Booking"]["estimated_hours"].' Number Of Rooms: '.$bookings[$i]["Booking"]["number_of_rooms"].' Number Of Bath Rooms: '.$bookings[$i]["Booking"]["number_of_bath_rooms"].' Estimated Area: '.$bookings[$i]["Booking"]["estimated_area"].' Estimated Hours: '.$bookings[$i]["Booking"]["estimated_hours"];
			$data[] = array(
				'title' => $details,
				'start' => $bookings[$i][0]["sdt"],
				'end' => $bookings[$i][0]["edt"],
				'color' => "#".$bookings[$i]["Cleaners"]["cleaner_color_indicator"],
				//'fontColor' => "#FFFFFF"
			);
		}
		//$data[] = array("color" =>"black", "textColor" =>"yellow");
		$json = json_encode($data);
		echo $json;
		exit();
	}

	public function profile(){
		$this->layout = 'innerpages';
		$this->set('title_for_layout', 'Service Provider Profile');
		$this->loadModel('User');
		$user_id = $this->Session->read('Auth.User.id');

		$fields = array('User.id', 'User.username', 'ServiceProvider.id','ServiceProvider.full_busnes_na1', 'ServiceProvider.full_busnes_na2', 'ServiceProvider.branch_name', 'ServiceProvider.contry_name', 'ServiceProvider.prov_name', 'ServiceProvider.city_name', 'ServiceProvider.addr_fsa', 'ServiceProvider.addr_postal_cd', 'ServiceProvider.busnes_addr_tx', 'ServiceProvider.mail_addr_tx', 'ServiceProvider.email_addr_tx', 'ServiceProvider.busnes_phone_no', 'ServiceProvider.busnes_fax_no', 'ServiceProvider.owner_last_na', 'ServiceProvider.owner_first_na', 'ServiceProvider.owner_gender_cd', 'ServiceProvider.owner_phone_no', 'ServiceProvider.last_updated_user_id');

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

	    	unset($this->request->data['User']['username']);
			$this->request->data['User']['id'] = $user_id;
			$this->request->data['User']['user_modified'] = date('Y-m-d H:i:s', strtotime('now'));
			$this->request->data['ServiceProvider']['id'] = $Service[0]['ServiceProvider']['id'];
			$this->request->data['ServiceProvider']['provider_modified'] = date('Y-m-d H:i:s');

			if(empty($this->request->data['User']['password']) ){
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);
			}
	        //prd($this->request->data);
	        if ($this->User->saveAssociated($this->request->data)) {
	            $this->Session->setFlash(__('Your Profile has been updated.'), 'flash_success');
	            return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'profile'));
	        }
	        $this->Session->setFlash(__('Unable to update your Profile.'), 'flash_error');
	    }

	    if(!$this->request->data){
	    	//prd($Service);
	        $this->request->data = $Service[0];
	    }
	}

	public function register(){

		$this->set('title_for_layout', 'Service Provider Registration');
		$this->loadModel('User');
		$this->loadModel('ServiceProvider');
		
		if($this->request->is('post')){
			
			/*$logo = $this->request->data['ServiceProvider']['provider_logo'];
			unset($this->request->data['ServiceProvider']['provider_logo']);

			if (isset($logo['name']) && !empty($logo['name'])){
				$tempname = 'SP_'.strtotime('now')."_".$logo['name'];
			}*/
			
			$this->ServiceProvider->set($this->request->data['ServiceProvider']);

			if($this->ServiceProvider->validates()){

				/*if(!empty($logo['tmp_name'])){
					if(move_uploaded_file($logo['tmp_name'],ROOT."/app/webroot/uploads/service_provider/".$tempname)){
						$this->request->data['ServiceProvider']['provider_logo'] = $tempname;
					}
				}*/

				$data_array = $this->request->data;
				$data_array['User']['user_type'] = '1';

				//prd($data_array);

				if($this->User->saveAssociated($data_array)){
				 	$this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
		            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
		        }
		        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');
		        return $this->redirect(array('controller' => 'users', 'action' => 'signup'));

			} else {
				$this->request->data = $this->request->data;
			}
		}
	}

	/**/
	public function services(){

		$this->layout = 'innerpages';
		$ServiceProviderId = $this->Session->read('Auth.User.id');

		$conditions = array("ServiceProviderService.user_id"=>$ServiceProviderId, "ServiceProviderService.delete_status <> 2");

		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('ServiceProviderService');

		$fields = array('ServiceProviderService.*','Service.service_name','Category.category_name','SubCategory.category_name');

		$Services = $this->ServiceProviderService->find("all",array(
			'fields' => $fields,
			'joins'=>array(
				array(
					'table' => 'booking_services',
					'alias' => 'Service',
					'type' => 'INNER',
					'conditions' => array('Service.id=ServiceProviderService.servic_cd','Service.service_status <> 2')
				),
				array(
					'table' => 'booking_categories',
					'alias' => 'Category',
					'type' => 'INNER',
					'conditions' => array('Category.id=ServiceProviderService.servic_cat_cd','Category.category_status <> 2')
				),
				array(
					'table' => 'booking_categories',
					'alias' => 'SubCategory',
					'type' => 'INNER',
					'conditions' => array('SubCategory.id=ServiceProviderService.servic_subcat_cd','SubCategory.category_status <> 2')
				)
			),
			'conditions' => $conditions
			)
		);
		//prd($Services);
		$this->set('Services', $Services);
		$this->set('title_for_layout', 'Service Provider\'s Services');
	}

	public function addservice(){
		$this->layout = 'innerpages';
		$ServiceProviderId = $this->Session->read('Auth.User.id');
		$this->set('title_for_layout', 'Add Service');
		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('ServiceProviderService');

		if($this->request->is('post')){
			if($this->ServiceProviderService->validates()){

				$data_array = $this->request->data;
				$data_array['ServiceProviderService']['user_id'] = $ServiceProviderId;
				$data_array['ServiceProviderService']['created'] = date('Y-m-d H:i:s');
				$data_array['ServiceProviderService']['modified'] = date('Y-m-d H:i:s');
				pr($data_array);
				$data = $this->ServiceProviderService->save($data_array);
				
				if($data){
					//prd($data);
				 	$this->Session->setFlash(__('Your Service Created.'), 'flash_success');
		            return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'services'));
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
		$this->loadModel('ServiceProviderService');

		$Service = $this->ServiceProviderService->find("all",array(
			'recursive' => 0,
			'conditions' => array('ServiceProviderService.id' => $Id)
			)
		);

		if($this->request->is(array('post', 'put'))){
			if($this->ServiceProviderService->validates()){
				//prd($this->request->data);
				$data_array = $this->request->data;
				$data_array['ServiceProviderService']['id'] = $Service[0]["ServiceProviderService"]["id"];
				$data_array['ServiceProviderService']['modified'] = date('Y-m-d H:i:s');
				//prd($data_array);
				$data = $this->ServiceProviderService->save($data_array);
				
				if($data){
					//prd($data);
				 	$this->Session->setFlash(__('Your Service Updated.'), 'flash_success');
		            return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'services',$Service[0]["ServiceProviderService"]["user_id"]));
		        }
		        $this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
			}else{
				$errors = $this->ServiceProviderService->validationErrors;
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
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => $Service[0]["ServiceProviderService"]["servic_cat_cd"]),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);

		$servic_cd = $this->Service->find('list',
			array(
				'conditions' => array('Service.service_status' => 0, 'Service.category_id' => $Service[0]["ServiceProviderService"]["servic_cat_cd"], 'Service.sub_category_id' => $Service[0]["ServiceProviderService"]["servic_subcat_cd"]),
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

			$this->loadModel('ServiceProviderService');
			
			$this->ServiceProviderService->updateAll(
				array('ServiceProviderService.delete_status' => 2),
				array('ServiceProviderService.id' => $id),
				array('ServiceProviderService.user_id' => $this->Session->read('Auth.User.id'))
			);
			$this->Session->setFlash(__('Your Service is Deleted.'), 'flash_success');
		}else{
			$this->Session->setFlash(__('Unable to Deleted your Service.'), 'flash_error');
		}
		return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'services'));
		exit;
	}
	/**/
	public function admin_add(){

		$this->set('title_for_layout', 'Add Service Provider');
		$this->loadModel('User');
		$this->loadModel('ServiceProvider');
		$this->loadModel('Service');
		
		if($this->request->is('post')){
			
			//$logo = $this->request->data['ServiceProvider']['provider_logo'];
			//unset($this->request->data['ServiceProvider']['provider_logo']);
			//$tempname = 'SP_'.strtotime('now')."_".$logo['name'];
			$this->ServiceProvider->set($this->request->data['ServiceProvider']);
			
			if($this->ServiceProvider->validates()){
				/*if(!empty($logo['tmp_name'])){
					if(move_uploaded_file($logo['tmp_name'],ROOT."/app/webroot/uploads/service_provider/".$tempname)){
						$this->request->data['ServiceProvider']['provider_logo'] = $tempname;
					}
				}*/
				$data_array = $this->request->data;
				
				$data_array['User']['user_type'] = 1;

				$data_array['User']['user_created'] = date('Y-m-d H:i:s');
				$data_array['User']['user_modified'] = date('Y-m-d H:i:s');

				$data_array['ServiceProvider']['active_dt'] = date('Y-m-d');
				$data_array['ServiceProvider']['provider_created'] = date('Y-m-d H:i:s');
				$data_array['ServiceProvider']['provider_modified'] = date('Y-m-d H:i:s');

				//prd($data_array);

				if($this->User->saveAssociated($data_array)){
				 	$this->Session->setFlash(__('Your User has been updated.'), 'flash_success');
		            return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'admin_index'));
		        }
		        //unlink(ROOT."/app/webroot/uploads/service_provider/".$tempname);
		        $this->Session->setFlash(__('Unable to update your User.'), 'flash_error');

			} else {
				$this->request->data = $this->request->data;
			}
		}

		$servicelist = $this->Service->find('list',
			array(
				'conditions' => array('Service.service_status' => 0),
				'fields' => array('Service.id', 'Service.service_name'),
				'order' => array('Service.service_name')
			)
		);
		$this->set('servicelist', $servicelist);
	}

	public function admin_edit($user_id = NULL){

		$this->set('title_for_layout', 'Edit Service Provider');
		$this->loadModel('User');
		
		if (!$user_id) {
        	throw new NotFoundException(__('Invalid User'));
    	}

		$fields = array('User.id', 'User.username', 'ServiceProvider.id','ServiceProvider.full_busnes_na1', 'ServiceProvider.full_busnes_na2', 'ServiceProvider.branch_name', 'ServiceProvider.contry_name', 'ServiceProvider.prov_name', 'ServiceProvider.city_name', 'ServiceProvider.addr_fsa', 'ServiceProvider.addr_postal_cd', 'ServiceProvider.busnes_addr_tx', 'ServiceProvider.mail_addr_tx', 'ServiceProvider.email_addr_tx', 'ServiceProvider.busnes_phone_no', 'ServiceProvider.busnes_fax_no', 'ServiceProvider.owner_last_na', 'ServiceProvider.owner_first_na', 'ServiceProvider.owner_gender_cd', 'ServiceProvider.owner_phone_no', 'ServiceProvider.last_updated_user_id');

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

	    	unset($this->request->data['User']['username']);
			$this->request->data['User']['id'] = $user_id;
			$this->request->data['User']['user_modified'] = date('Y-m-d H:i:s', strtotime('now'));
			$this->request->data['ServiceProvider']['id'] = $Service[0]['ServiceProvider']['id'];
			$this->request->data['ServiceProvider']['provider_modified'] = date('Y-m-d H:i:s');

			if(empty($this->request->data['User']['password']) ){
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);
			}
	        //prd($this->request->data);
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

		$fields = array('User.id', 'User.username', 'User.user_type', 'User.user_status', 'User.user_created', 'User.user_modified', 'ServiceProvider.full_busnes_na1', 'ServiceProvider.full_busnes_na2', 'ServiceProvider.busnes_addr_tx', 'ServiceProvider.owner_first_na', 'ServiceProvider.owner_phone_no');

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
				$full_busnes_na1 = $Users['ServiceProvider']['full_busnes_na1'];
				$full_busnes_na2 = $Users['ServiceProvider']['full_busnes_na2'];
				$busnes_addr_tx = $Users['ServiceProvider']['busnes_addr_tx'];
				$owner_first_na = $Users['ServiceProvider']['owner_first_na'];
				$owner_phone_no = $Users['ServiceProvider']['owner_phone_no'];

				$manage_services = '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/serviceprovider/services/' . $Users['User']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
				$action = '';
				$edit = '';
				$delete = '';
				
				if ($Users['User']['user_status'] == 1){
					$action .= '<i class="fa fa-circle fa-lg clrDisable" onclick="changeUserStatus(' . $Users['User']['id'] . ',0)" title="Change Status"></i>';
				}
				else if ($Users['User']['user_status'] == 0){
					$action .= '<i class="fa fa-circle fa-lg clrEmable" onclick="changeUserStatus(' . $Users['User']['id'] . ',1)" title="Change Status"></i>';
				}

				$edit .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/serviceprovider/edit/' . $Users['User']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
				$delete .= '<center><i class="fa fa-trash fa-lg" onclick="serviceproviderdelete(' . $Users['User']['id'] . ')" title="Delete Content"></i></center>';

				$responce->rows[$i]['id'] = $Users['User']['id'];
				$responce->rows[$i]['cell'] = array($i+1, $username, $full_busnes_na1, $full_busnes_na2, $owner_first_na, $owner_phone_no, $busnes_addr_tx, $manage_services, $action, $edit, $delete);
				$i++;
			}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}

	public function admin_services($serviceproviderid){
		$this->set('title_for_layout', 'Service Provider Service(s)');
		if(empty($serviceproviderid) || $serviceproviderid=="0"){
			$this->Session->setFlash(__('Unable to find Service(s).'), 'flash_error');
			return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'admin_index'));
		}
		$this->set('serviceproviderid', $serviceproviderid);
	}

	public function admin_addservice($ServiceProviderId){
		
		$this->set('title_for_layout', 'Add Service');
		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('ServiceProviderService');

		if($this->request->is('post')){
			if($this->ServiceProviderService->validates()){

				$data_array = $this->request->data;
				$data_array['ServiceProviderService']['user_id'] = $ServiceProviderId;
				$data_array['ServiceProviderService']['created'] = date('Y-m-d H:i:s');
				$data_array['ServiceProviderService']['modified'] = date('Y-m-d H:i:s');
				//pr($data_array);
				$data = $this->ServiceProviderService->save($data_array);
				
				if($data){
					//prd($data);
				 	$this->Session->setFlash(__('Your Service Created.'), 'flash_success');
		            return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'admin_services',$data["ServiceProviderService"]["user_id"]));
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
		$this->loadModel('ServiceProviderService');

		$Service = $this->ServiceProviderService->find("all",array(
			'recursive' => 0,
			'conditions' => array('ServiceProviderService.id' => $Id)
			)
		);

		if($this->request->is(array('post', 'put'))){
			if($this->ServiceProviderService->validates()){
				//prd($this->request->data);
				$data_array = $this->request->data;
				//$data_array['ServiceProviderService']['id'] = $Service[0]["ServiceProviderService"]["id"];
				$data_array['ServiceProviderService']['modified'] = date('Y-m-d H:i:s');
				//prd($data_array);
				$data = $this->ServiceProviderService->save($data_array);
				
				if($data){
					//prd($data);
				 	$this->Session->setFlash(__('Your Service Updated.'), 'flash_success');
		            return $this->redirect(array('controller' => 'serviceprovider', 'action' => 'admin_services',$Service[0]["ServiceProviderService"]["user_id"]));
		        }
		        $this->Session->setFlash(__('Unable to update your Service.'), 'flash_error');
			}else{
				$errors = $this->ServiceProviderService->validationErrors;
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
				'conditions' => array('Category.category_status' => 0, 'Category.parent_id' => $Service[0]["ServiceProviderService"]["servic_cat_cd"]),
				'fields' => array('Category.id', 'Category.category_name'),
				'order' => array('Category.category_name')
			)
		);

		$servic_cd = $this->Service->find('list',
			array(
				'conditions' => array('Service.service_status' => 0, 'Service.category_id' => $Service[0]["ServiceProviderService"]["servic_cat_cd"], 'Service.sub_category_id' => $Service[0]["ServiceProviderService"]["servic_subcat_cd"]),
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

			$this->loadModel('ServiceProviderService');
			$data = $this->request->data;
			$this->ServiceProviderService->updateAll(
				array('ServiceProviderService.delete_status' => 2),
				array('ServiceProviderService.id' => $data['id'])
			);
			echo 1; exit;
		}
		echo 0; exit;
	}

	public function admin_subcatselectbox(){
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

	public function admin_serviceselectbox(){
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

	public function admin_SPServicelist($ServiceProviderId){

		$this->loadModel('Category');
		$this->loadModel('Service');		
		$this->loadModel('ServiceProviderService');
		
		$page = $this->request->query['page'];
		$limit = $this->request->query['rows'];
		$sidx = $this->request->query['sidx'];
		$sord = $this->request->query['sord'];

		if (!$sidx){
			$sidx = 1;
		}
		$order_by = $sidx . ' ' . $sord;

		$conditions = array("ServiceProviderService.user_id"=>$ServiceProviderId, "ServiceProviderService.delete_status <> 2");

		$count = $this->ServiceProviderService->find('count', array(
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

		$fields = array('ServiceProviderService.*','Service.service_name','Category.category_name','SubCategory.category_name');

		$UserList = $this->ServiceProviderService->find("all",array(
			'fields' => $fields,
			'joins'=>array(
				array(
					'table' => 'booking_services',
					'alias' => 'Service',
					'type' => 'INNER',
					'conditions' => array('Service.id=ServiceProviderService.servic_cd','Service.service_status <> 2')
				),
				array(
					'table' => 'booking_categories',
					'alias' => 'Category',
					'type' => 'INNER',
					'conditions' => array('Category.id=ServiceProviderService.servic_cat_cd','Category.category_status <> 2')
				),
				array(
					'table' => 'booking_categories',
					'alias' => 'SubCategory',
					'type' => 'INNER',
					'conditions' => array('SubCategory.id=ServiceProviderService.servic_subcat_cd','SubCategory.category_status <> 2')
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
				$UnitCost = $Users['ServiceProviderService']['unit_cost'];
				$UnitPrice = $Users['ServiceProviderService']['unit_price'];

				$manage_services = '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/serviceprovider/services/' . $Users['ServiceProviderService']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
				$action = '';
				$edit = '';
				$delete = '';

				$edit .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/serviceprovider/editservice/' . $Users['ServiceProviderService']['id'] . '" title="Edit Content"><i class="fa fa-edit fa-lg"></i></a> ';
				
				$delete .= '<center><i class="fa fa-trash fa-lg" onclick="servicedelete(' . $Users['ServiceProviderService']['id'] . ')" title="Delete Content"></i></center>';

				$responce->rows[$i]['id'] = $Users['ServiceProviderService']['id'];
				$responce->rows[$i]['cell'] = array($i+1, $ServiceName, $MainCategory, $SubCategory, $UnitCost, $UnitPrice, $edit, $delete);
				$i++;
			}
			endforeach;
		}
		echo json_encode($responce);
		exit;
	}
}