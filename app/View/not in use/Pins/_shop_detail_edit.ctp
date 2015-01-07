<div class="aboutusmain">
    <div class="aboutusmain_top">
        <div class="container">
            <div class="col-md-12 aboutusmain_top_title"><?php echo __('Shop Edit')?></div>
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
                    <div class="signinpopupinput_left"><?php echo __('Online Shop\'s URL'); ?></div>
                    <div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('shop_link', array(
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
                    <div class="signinpopupinput_left"><?php echo __('Address'); ?></div>
                    <div class="signinpopupinput_right">
						<?php
                            echo $this->Form->input('address', array(
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
                    <div class="signinpopupinput_left"><?php echo __('Phone'); ?></div>
                    <div class="signinpopupinput_right">
						<?php
						echo $this->Form->input('phone', array(
							'type' => 'text',
							'class' => 'signinpopuptextbox',
							'placeholder' => 'Phone',
							'label' => false,
							'div' => array('class' => 'input_wrapper'),
							'required' => false,
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

                    </div>
                </div>
                <div class="signinpopupinput">
                    <div class="signinpopupinput_right">
                        <div class="popupdesing_top">
                            <div class="col-md-3 col-sm-3 col-xs-3">Day</div>
                            <div class="col-md-4 col-sm-4 col-xs-4">Start Time</div>
                            <div class="col-md-4 col-sm-4 col-xs-4">End Time</div>
                            <div class="col-md-1 col-sm-1 col-xs-1">Closed</div>
                        </div>
                        <div class="popupdesing_buttom">
                            
                            <!-- Timing Elements Start -->
                            <div class="popupdesing_buttom_first">
                                <div class="popupdesing1 popupdesing1_normal popres1 col-md-3 col-sm-3 col-xs-3">Mon</div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">                                        
                                        <?php 
                                             echo $this->Form->input('mon_start', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">
                                        <?php 
                                             echo $this->Form->input('mon_end', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing_buttomcheckbox popres8 col-md-1 col-sm-1 col-xs-1">
                                    <div class="input checkbox">
                                        
                                        <?php 
                                             echo $this->Form->checkbox('mon_isclosed', array(
                                                    "id"=>"PinMonStart",                                                    
                                                    'class' => 'checkbox-align',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                        
                                    </div>				
                                </div>
                            </div>
                            
                            <div class="popupdesing_buttom_first">
                                <div class="popupdesing1 popupdesing1_normal popres1 col-md-3 col-sm-3 col-xs-3">Tue</div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">                                        
                                        <?php 
                                             echo $this->Form->input('tue_start', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">
                                        <?php 
                                             echo $this->Form->input('tue_end', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing_buttomcheckbox popres8 col-md-1 col-sm-1 col-xs-1">
                                    <div class="input checkbox">
                                        
                                        <?php 
                                             echo $this->Form->checkbox('tue_isclosed', array(
                                                    "id"=>"PinMonStart",                                                    
                                                    'class' => 'checkbox-align',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                        
                                    </div>				
                                </div>
                            </div>
                            
                            <div class="popupdesing_buttom_first">
                                <div class="popupdesing1 popupdesing1_normal popres1 col-md-3 col-sm-3 col-xs-3">Wed</div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">                                        
                                        <?php 
                                             echo $this->Form->input('wed_start', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">
                                        <?php 
                                             echo $this->Form->input('wed_end', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing_buttomcheckbox popres8 col-md-1 col-sm-1 col-xs-1">
                                    <div class="input checkbox">
                                        
                                        <?php 
                                             echo $this->Form->checkbox('wed_isclosed', array(
                                                    "id"=>"PinMonStart",                                                    
                                                    'class' => 'checkbox-align',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                        
                                    </div>				
                                </div>
                            </div>
                            <div class="popupdesing_buttom_first">
                                <div class="popupdesing1 popupdesing1_normal popres1 col-md-3 col-sm-3 col-xs-3">Mon</div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">                                        
                                        <?php 
                                             echo $this->Form->input('thu_start', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">
                                        <?php 
                                             echo $this->Form->input('thu_end', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing_buttomcheckbox popres8 col-md-1 col-sm-1 col-xs-1">
                                    <div class="input checkbox">
                                        
                                        <?php 
                                             echo $this->Form->checkbox('thu_isclosed', array(
                                                    "id"=>"PinMonStart",                                                    
                                                    'class' => 'checkbox-align',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                        
                                    </div>				
                                </div>
                            </div>
                            <div class="popupdesing_buttom_first">
                                
                                <div class="popupdesing1 popupdesing1_normal popres1 col-md-3 col-sm-3 col-xs-3">Fri</div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">                                        
                                        <?php 
                                             echo $this->Form->input('fri_start', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">
                                        <?php 
                                             echo $this->Form->input('fri_end', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing_buttomcheckbox popres8 col-md-1 col-sm-1 col-xs-1">
                                    <div class="input checkbox">
                                        
                                        <?php 
                                             echo $this->Form->checkbox('fri_isclosed', array(
                                                    "id"=>"PinMonStart",                                                    
                                                    'class' => 'checkbox-align',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                        
                                    </div>				
                                </div>
                            </div>
                            <div class="popupdesing_buttom_first">
                                <div class="popupdesing1 popupdesing1_normal popres1 col-md-3 col-sm-3 col-xs-3">Sat</div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">                                        
                                        <?php 
                                             echo $this->Form->input('sat_start', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">
                                        <?php 
                                             echo $this->Form->input('sat_end', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing_buttomcheckbox popres8 col-md-1 col-sm-1 col-xs-1">
                                    <div class="input checkbox">
                                        
                                        <?php 
                                             echo $this->Form->checkbox('sat_isclosed', array(
                                                    "id"=>"PinMonStart",                                                    
                                                    'class' => 'checkbox-align',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                        
                                    </div>				
                                </div>
                            </div>
                            <div class="popupdesing_buttom_first">
                                <div class="popupdesing1 popupdesing1_normal popres1 col-md-3 col-sm-3 col-xs-3">Sun</div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">                                        
                                        <?php 
                                             echo $this->Form->input('sun_start', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing2 col-md-4 col-sm-4 col-xs-4">
                                    <div class="input_warpper">
                                        <?php 
                                             echo $this->Form->input('sun_end', array(
                                                    "id"=>"PinMonStart",
                                                    'class' => 'popupdesing_buttomtextbox inp_time',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                    </div>				
                                </div>
                                <div class="popupdesing_buttomcheckbox popres8 col-md-1 col-sm-1 col-xs-1">
                                    <div class="input checkbox">
                                        
                                        <?php 
                                             echo $this->Form->checkbox('sun_isclosed', array(
                                                    "id"=>"PinMonStart",                                                    
                                                    'class' => 'checkbox-align',                                                    
                                                    'label' => false,
                                                    'div' => array('class' => 'input_wrapper'),
                                                    'autocomplete'=>'off'
                                                    //'required' => true,
                                                ));
                                        ?>
                                        
                                    </div>				
                                </div>
                            </div>
                           <!--Timing Elements End--> 
                            
                            
                            
                             
                              
                            
                             
                             
                             
                             
                             
                             
                        </div>
                    </div>
                </div>



                <div class="signinpopupinput">

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
    $(document).ready(function () {
        $(".inp_datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
        
        $(".inp_time").mask("00:00");
        
    });
    
    
</script>