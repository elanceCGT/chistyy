<?php $user_type = $this->Session->read('Auth.User.user_type');

if($user_type == "1"){
	$username = $this->Session->read('Auth.User.ServiceProvider.full_busnes_na1');
	$link = $this->Html->url(array("controller" => "serviceprovider", "action" => "index"));
}elseif($user_type == "2"){
	$username = $this->Session->read('Auth.User.Cleaner.first_na')." ".$this->Session->read('Auth.User.Cleaner.last_na');
	$link = $this->Html->url(array("controller" => "cleaner", "action" => "dashbord"));
}elseif($user_type == "3"){
	$username = $this->Session->read('Auth.User.Customer.customer_name');
	$link = $this->Html->url(array("controller" => "cleaner", "action" => "index"));
}?>
<div class="innermain_logo">
	<a href="<?php echo $link?>">
		<?php echo $this->Html->image('../images/main_logo.png',array('alt' => ''  ));?>
	</a>
</div>

<div class="credential">
	<div class="welcome_name">Welcome<br /><?php echo $username?></div>
	<div class="login_logo"></div>
</div>
<div class="inn_back_bg">
	<div class="container">
    	<div class="inn_names"><?php echo __($title_for_layout); ?></div>
    </div>
</div>