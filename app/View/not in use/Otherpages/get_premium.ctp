<?php
$url_post = $this->Html->url(array("controller"=> "otherpages", "action" => "payment"),true);
?>
<div class="aboutusmain">
    <div class="aboutusmain_top">
		<div class="container">
			<div class="col-md-12 aboutusmain_top_title">get Premium </div>
		</div>
	</div>
    <div class="faqbuttom">
		<div class="container">
			<div class="col-md-6 col-sm-6 col-xs-12 premimum_pad">
				<div class="getpre_left">
					<div class="getpre_left_title">Premium Features</div>
					<div class="getpre_left_buttom">
						<div class="getpre_left_buttom_first">
							<div class="getpre_left_buttom_first_title">Promote your locations</div>
							<div class="getpre_left_buttom_first_line">
								Upload up to 5 Pictures
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Upload Youtube Videos
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Add the Opening Hours
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Add Entrance Fee
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
						</div>
						<div class="getpre_left_buttom_first">
							<div class="getpre_left_buttom_first_title">Promote your club or Activity</div>
							<div class="getpre_left_buttom_first_line">
								Create your own Events (synchronized with Facebook) 
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Invite your friends to your events
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Include your phone Number
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>

						</div>
						<div class="getpre_left_buttom_first">
							<div class="getpre_left_buttom_first_title">Improve your browsing experience</div>
							<div class="getpre_left_buttom_first_line">
								Access to the Favorite location options
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Access to your stats (know how many views you made)
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Edit your locations
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
						</div>
					</div>
					<div class="getprebuttonouter">
                        <button class="getprebutton" onclick="callPay('1')">Purchase for $<?php echo $data["PREMIUM_PRICE"]; ?></button>
					</div>
				</div>  
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 premimum_pad2">
				<div class="getpre_left">
					<div class="getpre_left_title">Professional Features</div>
					<div class="getpre_left_buttom">
						<div class="getpre_left_buttom_first">
							<div class="getpre_left_buttom_first_title">Be more visible</div>
							<div class="getpre_left_buttom_first_line">
								Get your pins visible whatever the filters of the map
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Upload up to 5 pictures
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Upload Youtube videos
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Add your Opening hours
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Input a phone number
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
						</div>
						<div class="getpre_left_buttom_first">
							<div class="getpre_left_buttom_first_title">Sell more</div>
							<div class="getpre_left_buttom_first_line">
								Upload your products directly on the website
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Add links to your Shop’s website
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
						</div>
						<div class="getpre_left_buttom_first">
							<div class="getpre_left_buttom_first_title">Manage your communication </div>
							<div class="getpre_left_buttom_first_line">
								Access to your Statistics
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
							<div class="getpre_left_buttom_first_line">
								Edit your pins
								<span><img src="<?php echo $this->webroot . "img/" ?>get_rightimg.png" /></span>
							</div>
						</div>
					</div>
					<div class="getprebuttonouter">
						<button class="getprebutton" onclick="callPay('2')">Purchase for $<?php echo $data["PROFESSIONAL_PRICE"]; ?></button>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<script type="text/javascript">
    function callPay(type){
		<?php if (!empty($GlobalViewData['UserID'])) { ?>
			window.location = '<?php echo $this->Html->url(array("action"=>"otherpages", "action"=>"payment"))?>/'+type;
		<?php } else { ?>
			$("#loginOpen").click();
		<?php } ?>
    }
</script>