<?php

$Cards = array(
	'MasterCard' => $this->Html->image('pay_mastercard.png'),
	'Visa' => $this->Html->image('pay_visacard.png'),
	'Amex' => $this->Html->image('pay_xpresscard.png'),
);
?>

<style type="text/css">
    .signinpopupinput_right input[type="radio"]{
        margin: 8px 3px 0px 5px;
    }
    .radio label{
        padding-left: 25px;
    }
    .selectouterdivmonth, .selectouterdivyear{
        border: none;
        padding: 0px;
    }    
</style>

<div class="aboutusmain">
    <div class="aboutusmain_top">
        <div class="container">
            <div class="col-md-12 aboutusmain_top_title"><?php echo __('PAYMENT'); ?></div>
        </div>
    </div>
    <div class="faqbuttom">
        <div class="container">
            <div class="ol-md-8 col-sm-7 col-xs-12 paymentinnerdiv">

                <div class="paymentform"><?php echo __('Payment Details'); ?></div>
                <div class="paymentform"><?php echo __('Type Selected'). ' : '. __($type_name); ?></div>
                <div class="complate_tex">
					<?php 
					echo $this->Form->create("Payment", array(
						"autocomplete" => "off"
					)); 
					?>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('To Pay'); ?></div>
                        <div class="signinpopupinput_right">
						<?php
                        echo $this->Form->input("to_pay", array(
                            'label' => false,
                            'class' => 'pinpopuptextbox',
							'value' => '$ '.$price,
							'style' => 'font-weight:bold;color:#1083BA',
							'div' => array('class' => 'input_wrapper'),
							'readonly' => true
                        )); 
						?>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('Country'); ?></div>
                        <div class="signinpopupinput_right">
						<?php
                        echo $this->Form->input("country", array(
                            'label' => false,
                            'type' => 'select',
                            'class' => 'pinpopuptextbox',
                            'options' => $CountriesList,
                            'empty' => 'Select Country',
                            'required' => true,
                        )); 
						?>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('Payment Type'); ?></div>
                        <div class="signinpopupinput_right">
   						<?php
                        echo $this->Form->input('cctype', array(
                            'type' => "radio",
                            'options' => $Cards,
                            'legend' => false,
                            'required' => true,
                        )); 
                        ?>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('Card Number'); ?></div>
                        <div class="signinpopupinput_right">
   						<?php
                        echo $this->Form->input('cardno', array(
                            'label' => false,
                            'class' => 'pinpopuptextbox',
                            'placeholder' => 'Card Number',
                            'maxlength' => 16,
                            'div' => array('class' => 'input_wrapper'),
                            'required' => true,
                            'onkeypress' => "return check_numsOnly(event, true, true)"
                        )); 
                        ?>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('Expiry Date'); ?></div>
                        <div class="signinpopupinput_right">
                            <div class="selectouterdivmonth">
                            <?php
                            echo $this->Form->input("month", array(
                                'label' => false,
                                'type' => 'select',
                                'class' => 'pinpopuptextbox',
                                'options' => $MonthsList,
                                'empty' => 'Month',
                                'required' => true,
                            )); 
                            ?>
                            </div>
                            <div class="selectouterdivyear">
                            <?php
                            echo $this->Form->input("year", array(
                                'label' => false,
                                'type' => 'select',
                                'class' => 'pinpopuptextbox',
                                'options' => $YearsList,
                                'empty' => 'Year',
                                'required' => true,
                            )); 
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('CVV Number'); ?></div>
                        <div class="signinpopupinput_right">
   						<?php
                        echo $this->Form->input('cvv', array(
                            'type' => 'password',
                            'label' => false,
                            'class' => 'pinpopuptextbox',
                            'maxlength' => 4,
                            'onkeypress' => "return check_numsOnly(event, true, true)",
                            'div' => array('class' => 'input_wrapper'),
                            'required' => true,
                        )); 
                        ?>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('Street'); ?></div>
                        <div class="signinpopupinput_right">
   						<?php
                        echo $this->Form->input('street', array(
                            'label' => false,
                            'class' => 'pinpopuptextbox',
                            'placeholder' => 'Street',
                            'div' => array('class' => 'input_wrapper'),
                            'required' => true,
                        )); 
                        ?>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('City'); ?></div>
                        <div class="signinpopupinput_right">
   						<?php
                        echo $this->Form->input('city', array(
                            'label' => false,
                            'class' => 'pinpopuptextbox',
                            'placeholder' => 'City',
                            'div' => array('class' => 'input_wrapper'),
                            'required' => true,
                        )); 
                        ?>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('State'); ?></div>
                        <div class="signinpopupinput_right">
   						<?php
                        echo $this->Form->input('state', array(
                            'label' => false,
                            'class' => 'pinpopuptextbox',
                            'placeholder' => 'State',
                            'div' => array('class' => 'input_wrapper'),
                            'required' => true,
                        )); 
                        ?>
                        </div>
                    </div>
                    <div class="signinpopupinput">
                        <div class="signinpopupinput_left"><?php echo __('Zip Code'); ?></div>
                        <div class="signinpopupinput_right">
   						<?php
                        echo $this->Form->input('zip', array(
                            'label' => false,
                            'class' => 'pinpopuptextbox',
                            'placeholder' => 'Zip Code',
                            'div' => array('class' => 'input_wrapper'),
                            'required' => true,
                        )); 
                        ?>
                            <div class="signinpopupcondition">
                                <button class="signinpopupregisterbutton" id="signupbutton" style="width:140px;"><?php echo __('Make Payment'); ?></button>
                                <button class="signinpopupcancelbutton" type="button" id="signupcancelbutton"><?php echo __('Cancel'); ?></button>
                            </div>
                        </div>
                    </div>
					<?php echo $this->Form->end(); ?>
                </div>
            </div>  
        </div>
    </div>
</div>
