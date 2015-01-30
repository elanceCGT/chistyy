<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{

	public $components = array(
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email', 'password' => 'password'),
				)
			)
		)
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$allowArr = array("admin_forgot", "admin_login", 'signup', 'login', 'logout', "admin_add");
		$this->Auth->allow($allowArr);
	}

	public function signup()
	{	$this->set('title_for_layout', 'User Signup');
	}

	public function changepassword()
	{
		$this->layout = 'innerpages';
		$this->loadModel('User');
		
		$this->set('title_for_layout', 'Change Password');
		
		$currUserId = $this->Session->read('Auth.User.id');
		
		$currUserRecord = $this->User->find("first", array( 'recursive' => -1));
		//prd($currUserRecord);
		$request = $this->request;

		$errors = array();
		if (($request->is('post') || $request->is('put')))
		{
			$data = $request->data;
			//prd($data);
			$this->User->id = $data['User']['id'] = $currUserRecord['User']['id'];

			if (!empty($data['User']['password']) && !empty($data['User']['confirm_password']) && $data['User']['confirm_password']!=$data['User']['password']){
				$this->Session->setFlash(__("Password and confirm password donsen't match"), 'flash_error');
				$this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'changepassword'));
			}else{
				unset($data['User']['confirm_password']);
				//prd($data);
				if($this->User->save($data)){
					$this->Session->setFlash(__("User profile changed successfully."), 'flash_success');
					$this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'changepassword'));
				}
			}
		}else{
			if (isset($currUserRecord) && !empty($currUserRecord)){
				$this->request->data = $currUserRecord;
			}else{
				$this->Session->setFlash(__("Invalid User Request"), 'flash_error');
				$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'login'));
			}
		}
		$this->set("errors", $errors);
	}

	public function admin_login(){
		$this->set('title_for_layout', 'Login');
		$this->Auth->authenticate = array(
			'Form' => array(
				'fields' => array('username' => 'username', 'password' => 'password'),
				'scope' => array('User.user_type' => 0, 'User.user_status' => 0)
			)
		);

		$user_id = $this->Auth->User("id");
		if (!empty($user_id)){
			$this->redirect(array("controller" => "index", "action" => "index"));
		}
		else
		{
			if (($this->request->is('post')) || ($this->request->is('put'))){
				if ($this->Auth->login()){
					$this->redirect($this->Auth->loginRedirect);
				}
				else{
					$this->Session->setFlash(__('Invalid Username or Password!'), 'flash_error');
				}
			}
		}
	}

	public function admin_logout(){
		$this->Session->destroy();
		//$this->Session->setFlash(__('Logged out successfully'),'success');
		$this->redirect($this->Auth->logoutRedirect);
	}

	public function admin_privillage()
	{
		$this->layout = 'admin_default_privillage';
	}

	public function admin_forgot()
	{
		if (($this->request->is('post')) || ($this->request->is('put')))
		{
			$request = $this->request["data"];
			if (!empty($request["User"]["emailid"]))
			{

				$valid_type = array("0", "1");
				$email = $request["User"]["emailid"];
				// check validity
				$result = $this->User->find("first", array(
					"conditions" => array("status !=" => 2, "user_type IN" => $valid_type, "email" => $email),
					"recursive" => -1
				));
				//prd($result);

				if (!empty($result))
				{
					if ($result["User"]["status"] == 1)
					{
						$pass = $this->User->getRandomValues(8, 'mix');
						$name = $result["User"]["first_name"] . " " . $result["User"]["last_name"];
						$id = $result["User"]["id"];

						// Update new Password
						$this->User->id = $id;
						$this->User->saveField('password', $pass);

						// Mail Password to the User
						$this->loadModel('EmailContent');
						$this->EmailContent->forgotPassword($email, $name, $pass);

						//echo '1'; exit;
						$this->Session->setFlash(__('The Password has been  sent successfully to your Email address.'), 'flash_success');
					}
					else
					{
						//echo '9'; exit; // Account deactivated
						$this->Session->setFlash(__('Email address is incorrect.'), 'flash_error');
					}
				}
				else
				{
					$this->Session->setFlash(__('Email address is not found.'), 'flash_error');
				}
			}
		}
	}

	public function admin_profile()
	{

		$this->set('title_for_layout', 'Edit Profile');
		array_push($this->AdminListings, array('controller' => 'users', 'action' => 'admin_profile', 'heading' => 'Edit Profile'));
		$this->set('Listings', $this->AdminListings);
		$request = $this->request;

		$currUserId = $this->Session->read('Auth.User.id');
		
		$currUserRecord = $this->User->find("first", array( 'recursive' => -1));
		//prd($currUserRecord);
		$errors = array();
		if (($request->is('post') || $request->is('put')))
		{
			$data = $request->data;
			$this->User->id = $data['User']['id'] = $currUserRecord['User']['id'];

			if (empty($data['User']['password']))
			{
				unset($data['User']['password']);
				unset($data['User']['confirm_password']);
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['confirm_password']);
			}
			$saveData = $this->User->save($data);
			if ($saveData)
			{
				$this->Session->setFlash(__("User profile changed successfully."), 'flash_success');
				$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'profile'));
			}
		}
		else
		{
			if (isset($currUserRecord) && !empty($currUserRecord))
			{
				$this->request->data = $currUserRecord;
			}
			else
			{
				$this->Session->setFlash(__("Invalid User Request"), 'flash_error');
				$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'login'));
			}
		}
		$this->set("errors", $errors);
	}

	public function admin_index($userType = NULL)
	{
		if (empty($userType))
		{
			$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'index', 1));
		}
		$this->set('title_for_layout', 'Users');
		if ($userType == 1)
		{
			array_push($this->AdminListings, array('controller' => 'users', 'action' => 'admin_index', 'heading' => 'List Free Users'));
		}
		elseif ($userType == 2)
		{
			array_push($this->AdminListings, array('controller' => 'users', 'action' => 'admin_index', 'heading' => 'List Premium Users'));
		}
		elseif ($userType == 3)
		{
			array_push($this->AdminListings, array('controller' => 'users', 'action' => 'admin_index', 'heading' => 'List Professional Users'));
		}
		$this->set('userType', $userType);
		$this->set('Listings', $this->AdminListings);
	}

	public function admin_add($userType = NULL)
	{

		$this->set('title_for_layout', 'Add User');

		if ($userType == 1)
		{
			array_push($this->AdminListings, array('controller' => 'users', 'action' => 'admin_add', 'heading' => 'Add Free User'));
		}
		elseif ($userType == 2)
		{
			array_push($this->AdminListings, array('controller' => 'users', 'action' => 'admin_add', 'heading' => 'Add Premium User'));
		}
		elseif ($userType == 3)
		{
			array_push($this->AdminListings, array('controller' => 'users', 'action' => 'admin_add', 'heading' => 'Add Professional User'));
		}


		$this->set('Listings', $this->AdminListings);

		$request = $this->request;

		$errors = array();

		if (($request->isPost() || $request->isPut()))
		{
			//prd($request['data']);
			$data = $request['data'];

			$this->User->setPasswordRequired();
			$this->User->set($data);

			if ($this->User->validates())
			{

				if (!isset($data['User']['password']) || empty($data['User']['password']))
				{
					unset($data['User']['password']);
					unset($data['User']['confirm_password']);
				}

				$data['User']['status'] = "1";

				if ($this->User->save($data))
				{
					$this->Session->setFlash(__("User added successfully."), 'flash_success');
					$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'index', $userType));
				}
			}
			else
			{
				$errors = $this->User->validationErrors;
				//prd($errors);
			}
		}
		$this->set("userType", $userType);
		$this->set("errors", $errors);
	}

	public function admin_edit($currUserId = NULL)
	{
		$this->set('title_for_layout', 'Edit User');
		array_push($this->AdminListings, array('controller' => 'users', 'action' => 'admin_edit', 'heading' => 'Edit User'));
		$this->set('Listings', $this->AdminListings);

		if (!is_numeric($currUserId) or ( $currUserId == NULL))
		{
			$this->Session->setFlash(__('Invalid Request.'), 'flash_error');
			$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'index', 1));
		}

		$currUserRecord = $this->User->findById($currUserId);

		$request = $this->request;
		$errors = array();
		if (($request->isPost() || $request->isPut()))
		{

			$data = $request['data'];
			$data['User']['id'] = $currUserId;

			if (!isset($data['User']['password']) || empty($data['User']['password']))
			{
				unset($data['User']['password']);
				unset($data['User']['confirm_password']);
			}
			else
			{
				$this->User->setPasswordRequired();
			}

			$this->User->set($data);

			if ($this->User->validates())
			{
				$data['User']['status'] = "1";

				if ($this->User->save($data))
				{
					$this->Session->setFlash(__("User updated successfully."), 'flash_success');
					$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'index', $currUserRecord['User']['user_type']));
				}
			}
			else
			{
				$errors = $this->User->validationErrors;
			}
		}
		else
		{
			$this->request->data = $currUserRecord;
		}
		$this->set("errors", $errors);
	}

	public function admin_grid($userType = NULL)
	{

		$request = $this->request;
		$this->autoRender = false;
		$this->layout = 'ajax';

		if ($request->is('ajax'))
		{
			$page = $request->data('page');
			$limit = $request->data('rows');
			$order = $request->data('sord');
			$index = $request->data('sidx');
			$search = $request->data('_search');
			$start = ($page - 1) * $limit;

			$conditions = array();
			if (empty($userType))
			{
				$conditions['User.user_type !='] = 0;
			}
			else
			{
				$conditions['User.user_type'] = $userType;
			}
			$conditions['User.status !='] = 2;

			if (isset($search) && $search == true)
			{
				$fname = $request->data('first_name');
				if (isset($fname))
				{
					$conditions['User.first_name LIKE'] = "%$fname%";
				}

				$lname = $request->data('last_name');
				if (isset($lname))
				{
					$conditions['User.last_name like'] = "%$lname%";
				}

				$email = $request->data('email');
				if (isset($email))
				{
					$conditions['User.email LIKE'] = "%$email%";
				}
			}

			$joins = array(
			);


			$count = $this->User->find('count', array(
				'conditions' => $conditions,
				'joins' => $joins,
				)
			);

			$total_records = $count;

			if ($total_records > 0)
			{
				$total_pages = ceil($total_records / $limit);
			}
			else
			{
				$total_pages = 0;
			}
			if ($page > $total_pages)
			{
				$page = $total_pages;
			}

			if (isset($index) && !empty($index))
			{
				$sort = array(" User.$index $order ");

				if ($index == 'age')
				{
					$sort = array(" User.dob $order");
				}

				if ($index == 'plan')
				{
					$sort = array(" Plan.title $order");
				}

				if ($index == 'country')
				{
					$sort = array(" Country.name $order");
				}
			}
			else
			{
				$sort = array(" first_name asc ");
			}

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

			$usersList = $this->User->find('all', array(
				'conditions' => $conditions,
				'order' => $sort,
				'limit' => $limit,
				'offset' => $start,
				'joins' => $joins,
				//'fields' 	=> array('User.*','floor(datediff(curdate(),User.dob) / 365) as age','Country.*','Plan.*')
				'fields' => array('User.*')
				)
			);


			$return_result['page'] = $page;
			$return_result['total'] = $total_pages;
			$return_result['records'] = $total_records;
			$i = 0;

			if (is_array($usersList))
			{
				$temp = array();
				foreach ($usersList as $user)
				{
					$return_result['rows'][$i]['id'] = $user['User']['id'];
					$return_result['rows'][$i]['cell'] = $user['User'];
					$i++;
				}
			}
			echo json_encode($return_result);
			exit;
		}
		else
		{
			$this->render('/nodirecturl');
		}
	}

	public function admin_deleteUser()
	{
		if ($this->request->is('ajax'))
		{
			$data = array();
			if (isset($this->request->data['id']))
			{
				$data['User']['id'] = $this->request->data['id'];
				$data['User']['status'] = '2';
				$this->User->save($data);
			}
			if (isset($this->request->data['ids']))
			{

				$this->request->data['ids'];
				$cnd = array(
					"User.id" => explode(",", $this->request->data['ids'])
				);
				$data['status'] = '2';
				$this->User->updateAll($data, $cnd);
			}
			exit;
		}
		else
		{
			$this->Session->setFlash(__('Invalid request'), 'flash_error');
			$this->redirect(array('admin' => true, 'controller' => 'Subscription', 'action' => 'index'));
		}
	}

	public function admin_changestatus()
	{

		if ($this->request->is('ajax'))
		{

			$data['User']['id'] = $this->request->data['id'];
			$data['User']['status'] = $this->request->data['status'] == 1 ? 0 : 1;

			if ($this->User->save($data))
			{
				echo '1';
			}
			else
			{
				echo '0';
			}
			exit;
		}
		else
		{
			
		}
	}


	/*
	 * function for user login
	 */
	public function login(){
		$this->set('title_for_layout', 'Chistyy Login');
		$this->Auth->authenticate = array(
			'Form' => array(
				'fields' => array('username' => 'username', 'password' => 'password'),
				'scope' => array('User.user_type !=' => 0, 'User.user_status' => 0)
			)
		);

		$user_id = $this->Auth->User("id");
		if (!empty($user_id)){
			$user_type = $this->Auth->User("user_type");
					
			if($user_type == "1"){
				$this->Auth->loginRedirect = array('admin' => false, 'controller' => 'serviceprovider', 'action' => 'index');
			}elseif ($user_type == "2"){
				$this->Auth->loginRedirect = array('admin' => false, 'controller' => 'cleaner', 'action' => 'dashbord');
			}elseif ($user_type == "3"){
				$this->Auth->loginRedirect = array('admin' => false, 'controller' => 'customers', 'action' => 'index');
			}
			$this->redirect($this->Auth->loginRedirect);
		}else{
			if (($this->request->is('post')) || ($this->request->is('put'))){

				if ($this->Auth->login()){

					$user_type = $this->Auth->User("user_type");
					
					if($user_type == "1"){
						$this->Auth->loginRedirect = array('admin' => false, 'controller' => 'serviceprovider', 'action' => 'index');
					}elseif ($user_type == "2"){
						$this->Auth->loginRedirect = array('admin' => false, 'controller' => 'cleaner', 'action' => 'dashbord');
					}elseif ($user_type == "3"){
						$this->Auth->loginRedirect = array('admin' => false, 'controller' => 'customers', 'action' => 'index');
					}

					$this->redirect($this->Auth->loginRedirect);
				}else{
					$this->Session->setFlash(__('Invalid Username or Password!'), 'flash_error');
				}
			}
		}
	}

	public function logout()
	{
		$this->Session->destroy();
		$this->Cookie->destroy();
		$this->redirect($this->Auth->logoutRedirect);
	}

	/**
	 * 
	 */
	public function index()
	{
		$this->set('title_for_layout', __("Dashbord"));
		$request = $this->request;
		$user_id = $this->_getCurrentUserId();
	}

	public function profile()
	{
		$request = $this->request;
		$userId = $this->_getCurrentUserId();
		if (!empty($userId))
		{
			if (($request->is('post') || $request->is('put')) && !empty($request->data))
			{
				$data = $request->data;
				unset($data["User"]['email']);
				if (!isset($data["User"]["change_password"]))
				{
					unset($data['User']['password']);
					unset($data['User']['confirm_password']);
				}
				$this->User->id = $userId;
				if ($this->User->save($data))
				{
					$this->Session->setFlash(__("Profile updated successfully"));
					$this->redirect(array("action" => "index"));
				}
			}
			else
			{
				$data = $this->User->findById($userId);
				$this->request->data = $data;
			}
		}
	}

	public function GetConditionjqgrid($fld, $foper, $fldata)
	{

		/* $conditions = "";
		  $parent_field = '';
		  if( $fld == "parent_category_id"){
		  $fld = "Category.category_name";
		  $parent_field = 'parent_category_id';
		  }else{
		  $fld = "Category.".$fld;
		  } */

		switch ($foper) {
			case 'eq'://"is equal to" 
				$conditions = $fld . ' = "' . $fldata . '"';
				break;
			case 'ne': //"is not equal to"
				$conditions = $fld . ' != "' . $fldata . '"';
				break;
			case 'lt': //"is less than" 
				$conditions = $fld . ' < "' . $fldata . '"';
				break;
			case 'le': //"is less or equal to" 
				$conditions = $fld . ' <= "' . $fldata . '"';
				break;
			case 'gt': //"is greater than" 
				$conditions = $fld . ' > "' . $fldata . '"';
				break;
			case 'ge': //"is greater or equal to"
				$conditions = $fld . ' >= "' . $fldata . '"';
				break;
			case 'in': //"is in"
				$fieldArr = explode(",", $fldata);
				$fieldString = "";
				if (count($fieldArr) > 0)
				{
					$i = 0;
					foreach ($fieldArr as $key => $val)
					{
						$val = trim($val);
						if ($i != 0)
						{
							$fieldString .= ",";
						}
						$fieldString .= "'" . $val . "'";
						$i++;
					}
				}
				$conditions = '' . $fld . ' IN (' . $fieldString . ')';
				break;
			case 'ni': //"is not in" 
				$fieldArr = explode(",", $fldata);
				$fieldString = "";
				if (count($fieldArr) > 0)
				{
					$i = 0;
					foreach ($fieldArr as $key => $val)
					{
						$val = trim($val);
						if ($i != 0)
						{
							$fieldString .= ",";
						}
						$fieldString .= "'" . $val . "'";
						$i++;
					}
				}
				$conditions = '' . $fld . ' NOT IN (' . $fieldString . ')';
				break;
			case 'bw': //"begins with" 
				$conditions = $fld . ' LIKE "' . $fldata . '%"';
				break;
			case 'bn': //"does not begin with" 
				$conditions = $fld . ' NOT LIKE "' . $fldata . '%"';
				break;
			case 'ew': //"ends with" 
				$conditions = $fld . ' LIKE "%' . $fldata . '"';
				break;
			case 'en': //"does not end with" 
				$conditions = $fld . ' NOT LIKE "%' . $fldata . '"';
				break;
			case 'cn': //"contains" 
				$conditions = $fld . ' LIKE "%' . $fldata . '%"';
				break;
			case 'nc': //"does not contain" 
				$conditions = $fld . ' NOT LIKE "%' . $fldata . '%"';
				break;

			case 'nu': //"is null" 
				$conditions = '' . $fld . ' = ""';
				break;
			case 'nn': //"is not null" 
				$conditions = '' . $fld . ' != ""';
				break;
		}

		/* 	if(!empty($parent_field)){			
		  $conditions = " Category.parent_category_id in (select id from ez_categories as Category where ".$conditions.") ";
		  }
		 */
		//echo $conditions;exit;

		return $conditions;
	}

	/*public function services(){
		$this->set('title_for_layout', 'Services');
		$this->loadModel('Service');
		$services = $this->Service->find('all', array(
    		'conditions' => array('Service.service_status' => '0'),
    		//'fields'     => array('Service.id', 'Service.service_name')
		));
		$this->set('services',$services);	
	}*/

	public function contactus(){
		$this->set('title_for_layout', 'Contact Us');
		$this->loadModel('Service');
		$services = $this->Service->find('all', array(
    		'conditions' => array('Service.service_status' => '0'),
    		//'fields'     => array('Service.id', 'Service.service_name')
		));
		$this->set('services',$services);	
	}

}
