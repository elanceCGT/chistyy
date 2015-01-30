<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class IndexController extends AppController
{

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('captcha', 'index', 'facebooklogin');
	}

	public function index()
	{
		$this->layout = 'frontpage';
		$this->set('title_for_layout', 'Home Page');
		$this->loadModel('CmsPage');
        $this->loadModel('Setting');
        $this->loadModel('Service');
		//$this->loadModel('TeamMember');
        
        
		$cmsPageData = $this->CmsPage->findByUniqueName("ABOUT_US");
		$this->set("cmsPageData", $cmsPageData);

		$ourTeamData = $this->CmsPage->findByUniqueName("OUR_TEAM");
		$this->set("ourTeamData", $ourTeamData);
        
        $premierLeagueData = $this->CmsPage->findByUniqueName("OFFICIAL_FANTASY");
		$this->set("premierLeagueData", $premierLeagueData);

		$services = $this->Service->find('all', array(
    		'conditions' => array('Service.service_status' => '0'),
    		//'fields'     => array('Service.id', 'Service.service_name')
		));
		


		//$TeamMemberData = $this->TeamMember->find('all');
		//$this->set("TeamMemberData", $TeamMemberData);

        /* Get Youtube id from url */
        //$ytData = $this->Setting->findByUniqueName("SITE_YOUTUBE_URL");
        //$video_id = explode("?v=", $ytData['Setting']['value']);
        //$video_id = $video_id[1];
        //$this->set("ytId", $video_id);
        

		//-------------- facebook login start -----------------//
		App::import('Vendor', 'Facebook', array('file' => 'facebook/facebook.php'));
		$appId = Configure::read('FACEBOOK_APPID');
		$secret = Configure::read('FACEBOOK_SECRET');

		$fbbaseurl = Router::url(array('controller' => 'index', 'action' => 'facebooklogin', 'admin' => false), true);

		$facebook = new Facebook(array('appId' => $appId, 'secret' => $secret, 'cookie' => true));

		$userface = $facebook->getUser();
		$fbLoginUrl = $facebook->getLoginUrl(
			array(
				'scope' => 'email,user_location,user_hometown',
				'redirect_uri' => $fbbaseurl
			)
		);
		$this->set('fbLoginUrl', $fbLoginUrl);
		//-------------- facebook login end -----------------//
		$this->set('services',$services);	
	}

	public function captcha()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		if (!isset($this->Captcha))
		{ //if Component was not loaded throug $components array()
			$this->Captcha = $this->Components->load('Captcha', array(
				'width' => 100,
				'height' => 50,
				'theme' => 'default', //possible values : default, random ; No value means 'default'
			)); //load it
		}
		$this->Captcha->create();
	}

	public function facebooklogin()
	{
		$this->loadModel('User');

		App::import('Vendor', 'Facebook', array('file' => 'facebook/facebook.php'));
		$appId = Configure::read('FACEBOOK_APPID');
		$secret = Configure::read('FACEBOOK_SECRET');

		$facebook = new Facebook(array('appId' => $appId, 'secret' => $secret, 'cookie' => true));
		$userface = $facebook->getUser();

		if ($userface)
		{
			try {
				$user_profile = $facebook->api('/me');
				$login_user_id = $this->Auth->User('id');
				if (isset($login_user_id))
				{
					CakeSession::destroy();
				}
				//prd($user_profile);
				if ($user_profile['id'] != "" && empty($login_user_id) && isset($user_profile['email']))
				{
					$checkexistsuser = $this->User->findByEmail($user_profile['email']);

					if (!empty($checkexistsuser) && count($checkexistsuser) > 0)
					{
						//$this->__checkUserStatus($checkexistsuser);
						if (isset($checkexistsuser['User']['id']) and $checkexistsuser['User']['id'] > 0)
						{

							$data = array();
							$data['User']['modified'] = date("Y-m-d H:i:s");
							$this->User->id = $checkexistsuser['User']['id'];
							//prd($checkexistsuser);
							//$this->request->data = $checkexistsuser;
							if ($this->User->save($data))
							{

								$b = $this->Auth->login($checkexistsuser); //Set session......
								$this->Session->write("Auth.User", $checkexistsuser['User']);

								//pr($checkexistsuser['User']);
								prd($_SESSION);
								prd($this->Session->read('Auth'));

								//$this->redirect(array('controller' => 'index', 'action' => 'dashboard',null));
							}
						}
					}
					else
					{
						//Register user and give login for excess....
						$signup_data = array();

						$signup_data['User']['fname'] = $user_profile['first_name'];
						$signup_data['User']['lname'] = $user_profile['last_name'];
						$signup_data['User']['email'] = $user_profile['email'];
						$signup_data['User']['facebook_id'] = $user_profile['id'];
						$signup_data['User']['status'] = 1;
						$signup_data['User']['user_type'] = 1;
						$signup_data['User']['registered_by'] = 1;

						$saveData = $this->User->save($signup_data);

						if (isset($saveData['User']['id']) && !empty($saveData['User']['id']))
						{

							$checkexistsuser = $this->User->findById($saveData['User']['id']);

							$this->Auth->login($checkexistsuser['User']);
							$this->Session->setFlash(__('Thank you for registration in Xtremap.'), 'flash_success');
							$this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => false));
						}
						else
						{
							$this->Session->setFlash(__('Facebook Registration failed. Please try again later.'), 'flash_error');
							$this->redirect(array('controller' => 'index', 'action' => 'index'));
						}
					}
				}
				else
				{
					$this->Session->setFlash(__('Facebook login failed and email is required.'), 'flash_error');
					$this->redirect(array('controller' => 'index', 'action' => 'index'));
				}
			} catch (FacebookApiException $e) {
				error_log($e);
				$userface = null;
			}
		}
		else
		{
			$this->Session->setFlash(__('Facebook login failed.'), 'flash_error');
			$this->redirect(array('controller' => 'index', 'action' => 'index'));
		}
		//-------------- facebook login end -----------------//
	}

	public function dashboard()
	{
		//echo "ssss";exit;
		prd($_SESSION);
		$d = $this->Session->read("Auth");
		prd($d);
		//prd($d);
	}

	public function admin_index()
	{
		$this->set('title_for_layout', 'Admin Dashboard');
		$this->set('Listings', $this->AdminListings);
        
        //$this->set('Listings',$this->AdminListings);
		$uid = $this->Session->read('Auth.User.id');
		if ($uid == "")
		{
			$this->redirect($this->Auth->loginAction);
		}
	}

	public function admin_forms()
	{
		$this->set('title_for_layout', 'Form Wizard');

		array_push($this->AdminListings, array('controller' => 'index', 'action' => 'admin_forms', 'heading' => 'Admin Forms'));

		$this->set('Listings', $this->AdminListings);
	}

	
	public function access_pins()
	{
		$this->loadModel("Pin");
		$data = $this->Pin->find("all", array(
			"conditions" => array('Pin.status'=>1, 'DATE(Pin.created)' => date('Y-m-d')),
			"recursive" => -1
		));
	}
	
}
