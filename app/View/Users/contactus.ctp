	<div class="block3toptitle">
    <span><img src="<?php echo $this->webroot?>img/lineimg.png"></span>
	<div class="block3toptitletext">Contact Us</div>
	<span><img src="<?php echo $this->webroot?>img/lineimg.png"></span>
   </div>
   <div class="container">	
		<div class="ourserviceli">
			
		</div>
	</div>		

<div class="aboutusmain">
	<div class="aboutusmain_top">
		<div class="container">
			<div class="col-md-12 aboutusmain_top_title"><?php echo __('Profile')?></div>
		</div> 
    </div>
	<div class="faqbuttom">
		<div class="container">
			<?php 
			echo $this->Form->create('User', array(
				'id' => 'UserProfileForm',
				'method' => 'POST',
				'autocomplete' => 'off',
			));
			?>
			<div class="col-md-8 col-sm-7 col-xs-12 faqbuttom_left premimum_pad">
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('First Name'); ?></div>
					<div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('first_name', array(
							'class' => 'signinpopuptextbox',
							'placeholder' => 'First Name',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
							'required' => true,
						));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Last Name'); ?></div>
					<div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('last_name', array(
							'class' => 'signinpopuptextbox',
							'placeholder' => 'Last Name',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
						));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Email Address'); ?></div>
					<div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('email', array(
							'type' => 'email',
							'class' => 'signinpopuptextbox',
							'placeholder' => 'Email Address',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
							'readonly' => true,
						));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Change Password'); ?></div>
					<div class="signinpopupinput_right">
						<?php 
						echo $this->Form->input('change_password', array(
							'type' => 'checkbox',
							'label' => FALSE,
							'hiddenField' => FALSE,
							'class' => 'checkbox-align'
						));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Password'); ?></div>
					<div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('password', array(
							'type' => 'password',
							'class' => 'signinpopuptextbox',
							'placeholder' => 'Password',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
							'required' => false,
							'value' => '',
						));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Confirm Password'); ?></div>
					<div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('confirm_password', array(
							'type' => 'password',
							'class' => 'signinpopuptextbox',
							'placeholder' => 'Confirm Password',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
							'required' => false,
							'value' => '',
						));
						?>
						<div class="signinpopupcondition">
							<button class="signinpopupregisterbutton" id="signupbutton"><?php echo __('Save'); ?></button>
							<button class="signinpopupcancelbutton" type="button" id="signupcancelbutton"><?php echo __('Cancel'); ?></button>
						</div>
					</div>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
