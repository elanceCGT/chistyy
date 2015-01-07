<div class="aboutusmain">
	<div class="aboutusmain_top">
		<div class="container">
			<div class="col-md-12 aboutusmain_top_title"><?php echo __('Event Edit')?></div>
		</div> 
    </div>
	<div class="faqbuttom">
		<div class="container">
			<?php 
			echo $this->Form->create('Pin', array(
				'id' => 'UserProfileForm',
				'method' => 'POST',
				'autocomplete' => 'off',
			));
			?>
			<div class="col-md-8 col-sm-7 col-xs-12 faqbuttom_left premimum_pad">
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Name'); ?></div>
					<div class="signinpopupinput_right">
						<?php
                            
                            echo $this->Form->input('name', array(
                                'class' => 'signinpopuptextbox',
                                'placeholder' => 'Name',
                                'label' => false,
                                'div' => array('class' => 'input_wrapper'),
                                'required' => true,
                            ));
                        
                            echo $this->Form->input('id', array(
                                'type' => 'hidden'
                            ));
                        
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Sport Type'); ?></div>
					<div class="signinpopupinput_right">
						<?php
                            echo $this->Form->input("sports_type", array(
                                'type' => 'select',
                                'label' => false,
                                'class' => 'pinpopuptextbox mod_select_box',
                                'id' => 'sports_type',
                                'options' => $SportsData,
                                'empty' => "Select Sports",
                                'required' => true
                            ));
                            ?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Address'); ?></div>
					<div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('email', array(
							'type' => 'email',
							'class' => 'signinpopuptextbox',
							'placeholder' => 'Address',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
							'readonly' => true,
						));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Date'); ?></div>
					<div class="signinpopupinput_right">
						<?php
                            echo $this->Form->input('event_date', array(
                                'type' => 'text',
                                'class' => 'signinpopuptextbox inp_datepicker',
                                'placeholder' => 'Date',
                                'label' => false,
                                'div' => array('class' => 'input_wrapper'),
                                'readonly' => true,
                            ));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Description'); ?></div>
					<div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('description', array(
							'type' => 'password',
							'class' => 'signinpopuptextbox',
							'placeholder' => 'Description',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
							'required' => false,
							'value' => '',
						));
						?>
					</div>
				</div>
				<div class="signinpopupinput">
					<div class="signinpopupinput_left"><?php echo __('Upload Image'); ?></div>
					<div class="signinpopupinput_right">
						<?php
						/*echo $this->Form->input('confirm_password', array(
							'type' => 'password',
							'class' => 'signinpopuptextbox',
							'placeholder' => 'Confirm Password',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
							'required' => false,
							'value' => '',
						));*/
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
<script  type="text/javascript">
    $(document).ready(function(){
        $(".inp_datepicker").datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
		});
    });
</script>