    <div class="modal-dialog signuppopupmain">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title pintext" id="myModalLabel"><?php echo __('SIGN UP'); ?></h4>
            </div>
            <div class="modal-body">
				<?php
				echo $this->Form->create('User', array(
					'id' => 'SigupForm',
					'method' => 'POST',
					'url' => array('controller' => 'users', 'action' => 'signup'),
					'autocomplete' => 'off',
				));
				?>
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
							'required' => true,
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
							'required' => true,
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
							'required' => true,
						));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Security Code'); ?></div>
					<div class="signinpopupinput_right">
						<div class="signinpopupinput_rightfirst">
							<div class="signpopuopcapimg">
								<?php
								echo $this->Html->image($this->Html->url(array('controller' => 'index', 'action' => 'captcha'), true), array(
									'id' => 'img-captcha',
									'vspace' => 2,
									'width' => '118px',
									'height' => '38px',
									'class' => 'img-captcha'
								));
								?>
							</div>
							<div class="signpopuopcaptextbox">
								<?php
								echo $this->Form->input('captcha', array(
									'class' => 'signinpopuptextbox',
									'placeholder' => 'Security Code',
									'label' => false,
									'div' => array('class' => 'input_wrapper'),
									'required' => true,
								));
								?>
							</div>
						</div>  
						<div class="signinpopupinput_rightfirst">
							<span>
								<img src="<?php echo $this->webroot . "img/" ?>signuploadimg.png" />
							</span><?php echo __("Can't read? Reload"); ?>
						</div>
						<div class="signinpopupcondition">
							<label>
								<?php
								echo $this->Form->input('terms', array(
									'type' => 'checkbox',
									'label' => FALSE,
									'hiddenField' => FALSE,
									'required' => true,
								));
								?>
								<?php echo __('I Agree'); ?>&nbsp;<a href=""><?php echo __('Terms And Conditions'); ?></a>
							</label>
						</div>
						<div class="signinpopup_buttondin">
							<button class="signinpopupregisterbutton" id="signupbutton"><?php echo __('Register'); ?></button>
							<button class="signinpopupcancelbutton" type="button" id="signupcancelbutton"><?php echo __('Cancel'); ?></button>
							<a>
								<img src="<?php echo $this->webroot . "img/" ?>loginfacebook.png" />
							</a>
						</div>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
