<?php 
//prd($this->Session->read('Auth'));
$link = '';
 if($this->Session->read('Auth.User.user_type') == 1)
 $link = "serviceprovider"; else
 if($this->Session->read('Auth.User.user_type') == 2)
 $link = "cleaner/dashbord"; else
 if($this->Session->read('Auth.User.user_type') == 3)
 $link = "customers/addbooking"; else	
 $link = "users/signup"; 

 
 //$link = $this->Session->read('Auth.User.user_type') !='' ? "": ""  ; 
?>
<div class="fullwidth block1">
	<div class="container">
    	<div class="logo_menu">
        	<div class="logo"><a href=""><img src="images/logo.png" border="0" /></a></div>
			<div class="headermenu">
			<div class="streat"><a href="<? echo $this->Html->url(array("controller" => "index", "action" => "index"))?>">home</a></div>
			<div class="streat"><a href="<? echo $this->Html->url(array("controller" => "users", "action" => "signup"))?>">sign up</a></div>
			<div class="streat"><a href="<? echo $this->Html->url(array("controller" => "users", "action" => "login"))?>">login</a></div>
			<div class="streat"><a href="<? echo $this->Html->url(array("controller" => "CmsPages", "action" => "index","HELP"))?>">help</a></div>
			<div class="streat"><a href="<? echo $this->Html->url(array("controller" => "services", "action" => "services"))?>">services</a></div>
		</div>
        </div>
		<div class="fullwidth main_text">Neque porro quisquam est qui dolorem ipsum.</div>
			<div class="fullwidth betwen_smal_text">Integer ornare nibh vel condimentum pulvinar. Quisque luctus ullamcorper.</br> Sed eu posuere magna, vel euismod eros. </div>
			<div class="fullwidth blue_btn">
				<a href="<?php echo $this->webroot.$link?>"><div class="blu_btnt">Get Started Now</div></a>
			</div>
    </div>
</div>