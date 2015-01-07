<?php
//if ($GlobalViewData['Controller']=='index' && $GlobalViewData['Action']=='index') {
if( ($this->Session->read('Auth.User.id')) && ($this->Session->read('Auth.User.id') > 0) ){
	$urls = array(
		'urlDashboard' => $this->Html->url(array("controller" => "serviceprovider", "action" => "index")),
		'urlProfile' => $this->Html->url(array("controller" => "serviceprovider", "action" => "profile")),
		'urlChabgepassword' => $this->Html->url(array("controller" => "users", "action" => "chabgepassword")),
		'urlManagecleaner' => $this->Html->url(array("controller" => "cleaner", "action" => "index")),
		'urlLogout' => $this->Html->url(array("controller" => "users", "action" => "logout"))
	);
	echo $this->element('_menu_afterlogin', $urls);
} else {

	$urls = array(
		'urlHome' => $this->Html->url(array("controller" => "index", "action" => "index")),
		'urlSinup' => $this->Html->url(array("controller" => "users", "action" => "signup")),
		'urlLogin' => $this->Html->url(array("controller" => "users", "action" => "login")),
		'urlHelp' => $this->Html->url(array("controller" => "CmsPages", "action" => "index","HELP")),
		'urlService' => $this->Html->url(array("controller" => "CmsPages", "action" => "index","SERVICES"))
	);
	echo $this->element('_menu_other', $urls);
}
