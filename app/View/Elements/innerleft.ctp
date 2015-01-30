<?php
//if ($GlobalViewData['Controller']=='index' && $GlobalViewData['Action']=='index') {
if( ($this->Session->read('Auth.User.id')) && ($this->Session->read('Auth.User.id') > 0) ){

	$user_type = $this->Session->read('Auth.User.user_type');

	if($user_type=="1"){
		$urls = array(
			'urlDashboard' => $this->Html->url(array("controller" => "serviceprovider", "action" => "index")),
			'urlProfile' => $this->Html->url(array("controller" => "serviceprovider", "action" => "profile")),
			'urlChabgepassword' => $this->Html->url(array("controller" => "users", "action" => "changepassword")),
			'urlManagecleaner' => $this->Html->url(array("controller" => "cleaner", "action" => "index")),
			'urlManageServices' => $this->Html->url(array("controller" => "serviceprovider", "action" => "services")),
			'urlLogout' => $this->Html->url(array("controller" => "users", "action" => "logout"))
		);
		echo $this->element('_menu_afterlogin_serviceproviders', $urls);
	}elseif($user_type=="2"){
		$urls = array(
			'urlDashboard' => $this->Html->url(array("controller" => "cleaner", "action" => "dashbord")),
			'urlProfile' => $this->Html->url(array("controller" => "cleaner", "action" => "profile")),
			'urlManageServices' => $this->Html->url(array("controller" => "cleaner", "action" => "services")),
			'urlChabgepassword' => $this->Html->url(array("controller" => "users", "action" => "changepassword")),
			'urlLogout' => $this->Html->url(array("controller" => "users", "action" => "logout"))
		);
		echo $this->element('_menu_afterlogin_cleaner', $urls);
	}elseif($user_type=="3"){
		$urls = array(
			'urlDashboard' => $this->Html->url(array("controller" => "customers", "action" => "index")),
			'urlProfile' => $this->Html->url(array("controller" => "customers", "action" => "profile")),
			'urlChabgepassword' => $this->Html->url(array("controller" => "users", "action" => "changepassword")),
			'urlCreateBooking' => $this->Html->url(array("controller" => "customers", "action" => "createbooking")),
			'urlLogout' => $this->Html->url(array("controller" => "users", "action" => "logout"))
		);

		echo $this->element('_menu_afterlogin_customer', $urls);
	}
	
} else {

	$urls = array(
		'urlHome' => $this->Html->url(array("controller" => "index", "action" => "index")),
		'urlSinup' => $this->Html->url(array("controller" => "users", "action" => "signup")),
		'urlLogin' => $this->Html->url(array("controller" => "users", "action" => "login")),
		'urlHelp' => $this->Html->url(array("controller" => "CmsPages", "action" => "index","HELP")),
		'urlService' => $this->Html->url(array("controller" => "services", "action" => "services"))
	);
	echo $this->element('_menu_other', $urls);
}

