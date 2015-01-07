<?php
if (empty($GlobalViewData['UserID']))
{   //logged IN 
	?>
	<div class="log" id="signupOpen">
		<?php echo __('SIGNIN'); ?>
	</div>
	<div class="log" id="loginOpen">
		<?php echo __('LOGIN'); ?>
	</div>
	
	<?php
}
else
{
	// LOGGED IN 
    $urlLogout = $this->Html->url(array("controller" => "users", "action" => "logout"));
	$urlPersonalSpace = $this->Html->url(array("controller" => "users", "action" => "index"));
	
	?>
	<div class="aboutushedder_pro_pic">
		<div class="event_pro_img"><img src="<?php echo $this->webroot . "img/" ?>03.png"/></div>
		<div class="event_lo_jon">John smith</div>
		<div class="hedderpopover" >
			<div class="hedderpopoverarrow"><img src="<?php echo $this->webroot . "img/" ?>arrowimg.png" /></div>
			<ul>
				<li>
					<a href="<?php echo $urlPersonalSpace; ?>"><?php echo __('Personal Space'); ?></a>
				</li>
				<li>
					<a href="<?php echo $urlLogout; ?>"><?php echo __('Logout'); ?></a>
				</li>
			</ul>
		</div>
	</div>
	<?php
}
