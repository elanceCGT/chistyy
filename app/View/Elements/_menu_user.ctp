<?php
if (empty($GlobalViewData['UserID']))
{   //NOT LOGGED IN 
	if ($GlobalViewData['Controller'] == 'index' && $GlobalViewData['Action'] == 'index')
	{
		// HOME PAGE
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
		// OTHER PAGES
		?>
		<div class="aboutushedder_pro_pic hedderlanright aboutushedder_pro_pic_without_log"  >
			<div class="log" id="signupOpen" >SIGNIN</div>
			<div class="log" id="loginOpen">LOGIN</div>
		</div>
		<?php
	}
}
else // LOGGED IN 
{

	$urlLogout = $this->Html->url(array("controller" => "users", "action" => "logout"));
	$urlPersonalSpace = $this->Html->url(array("controller" => "users", "action" => "index"));
	$cls2 = '';
	$cls3 = '';
	$user = $this->Session->read("Auth.User");
	$url_imgResize = $this->webroot.'image.php?image=';
	$user_image = $url_imgResize.'img/no_user.jpg&width=42&height=42';
	if (!empty($user['image'])) {
		$user_image = $url_imgResize.'files/profiles'.$user['image'].'&width=42&height=42';
	}
	
	if ($GlobalViewData['Controller'] == 'index' && $GlobalViewData['Action'] == 'index')
	{
		$cls2 = 'aboutushedder_pro_pic_logged';
		$cls3 = 'hedderpopover_logged';
	}
	?>
	<div class="aboutushedder_pro_pic <?php echo $cls2; ?>">
		<div class="event_pro_img">
			<img src="<?php echo $user_image ?>" height="42px" width="42px"/>
		</div>
		<div class="event_lo_jon login-name"><?php echo $user['full_name']; ?></div>
		<div class="hedderpopover <?php echo $cls3; ?>">
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
