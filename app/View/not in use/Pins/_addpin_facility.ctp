<div class="modal-body">
	<?php
	echo $this->Form->create('Pin', array(
		"url" => array('controller' => 'index', 'action' => 'addpin'),
		"id" => "AddPinForm"
	));
	?>
	<div class="pinpopupinput">
		<?php
		echo $this->Form->input("location_type", array(
			'type' => 'select',
			'label' => false,
			'id' => 'location_type',
			'class' => 'pinpopuptextbox mod_select_box',
			'options' => $LocationTypeData,
		));
		?>
	</div>
	<div class="pinpopupinput"> 
		<?php
		echo $this->Form->input("name", array(
			"label" => false,
			"class" => "pinpopuptextbox",
			"placeholder" => "Location Name",
			"div" => array("class" => "input_warpper"),
			"required" => true,
		));
		?>
	</div>
	<div class="pinpopupinput">
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
	<div class="pinpopupinput"> 
		<?php
		echo $this->Form->input("address", array(
			'type' => 'text',
			"label" => false,
			"class" => "pinpopuptextbox",
			"placeholder" => "Address",
			"div" => array("class" => "input_warpper"),
			"required" => true,
			'onblur' => 'getGeoLoc()'
		));
		echo $this->Form->hidden("lat");
		echo $this->Form->hidden("long");
		?>
	</div>
	<?php
	// Paid User's options starts
	if ($user_type > 1)
	{
		?>
		<div class="pinpopupinput"> 
			<?php
			echo $this->Form->input("email", array(
				'type' => 'email',
				"label" => false,
				"class" => "pinpopuptextbox",
				"placeholder" => "Email",
				"div" => array("class" => "input_warpper"),
			));
			?>
		</div>
		<?php
	}
	?>

	<?php
	// Paid User's options starts
	if ($user_type > 1)
	{
		?>
		<div class="pinpopupinput"> 
			<div class="popupbrowsemaindiv">
				<div id="path">Upload Image</div>
				<div class="popupbrowsediv">
					<?php
					echo $this->Form->input('image', array(
						"label" => false,
						"type" => "file",
						"class" => "browseimg pinimage_pre",
						"required" => true,
						"readonly" => true,
						"div" => false,
					));
					?>
					Browse
				</div>
			</div>
			<div class="file-upload-progressbar-wrap">
				<div class="file-upload-progressbar"></div>
			</div>
			<?php echo $this->Form->hidden("uploaded_images", array("value" => "")); ?>
		</div>		
		<div class="pinpopupinput"> 
			<?php
			echo $this->Form->input('video', array(
				"label" => false,
				"class" => "pinpopuptextbox",
				"placeholder" => "Video Url",
				"div" => array("class" => "input_warpper"),
			));
			?>
		</div>
		<div class="pinpopupinput"> 
			<?php
			echo $this->Form->input('phone', array(
				"label" => false,
				"class" => "pinpopuptextbox",
				"placeholder" => "Phone Number",
				"div" => array("class" => "input_warpper"),
			));
			?>
		</div>
		<div class="pinpopupinput"> 
			<?php
			echo $this->Form->input('price', array(
				"label" => false,
				"class" => "pinpopuptextbox",
				"placeholder" => "Price",
				"div" => array("class" => "input_warpper"),
			));
			?>
		</div>

		<div class="popupdesing">
			<div class="popupdesing_top">
				<div class="popupdesing1 respop"><?php echo __('DAY'); ?></div>
				<div class="popupdesing2 respop2"><?php echo __('Start Time'); ?></div>
				<div class="popupdesing2 respo4"><?php echo __('End Time'); ?></div>
				<div class="popupdesing3 respop3"><?php echo __('Closed'); ?></div>
			</div>
			<div class="popupdesing_buttom">
				<div class="popupdesing_buttom_first">
					<div class="popupdesing1 popupdesing1_normal popres1"><?php echo __('Mon'); ?></div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('mon_start', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('mon_end', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing_buttomcheckbox popres8">
						<?php
						echo $this->Form->input('mon_isclosed', array(
							'type' => 'checkbox',
							'label' => false,
							'hiddenField' => FALSE,
							'class' => 'checkbox-align'
						));
						?>
					</div>
				</div>
				<div class="popupdesing_buttom_first">
					<div class="popupdesing1 popupdesing1_normal popres1"><?php echo __('Tue'); ?></div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('tue_start', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('tue_end', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing_buttomcheckbox popres8">
						<?php
						echo $this->Form->input('tue_isclosed', array(
							'type' => 'checkbox',
							'label' => false,
							'hiddenField' => FALSE,
							'class' => 'checkbox-align'
						));
						?>
					</div>
				</div>
				<div class="popupdesing_buttom_first">
					<div class="popupdesing1 popupdesing1_normal popres1"><?php echo __('Wed'); ?></div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('wed_start', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('wed_end', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing_buttomcheckbox popres8">
						<?php
						echo $this->Form->input('wed_isclosed', array(
							'type' => 'checkbox',
							'label' => false,
							'hiddenField' => FALSE,
							'class' => 'checkbox-align'
						));
						?>
					</div>
				</div>
				<div class="popupdesing_buttom_first">
					<div class="popupdesing1 popupdesing1_normal popres1"><?php echo __('Thu'); ?></div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('thu_start', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('thu_end', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing_buttomcheckbox popres8">
						<?php
						echo $this->Form->input('thu_isclosed', array(
							'type' => 'checkbox',
							'label' => false,
							'hiddenField' => FALSE,
							'class' => 'checkbox-align'
						));
						?>
					</div>
				</div>
				<div class="popupdesing_buttom_first">
					<div class="popupdesing1 popupdesing1_normal popres1"><?php echo __('Fri'); ?></div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('fri_start', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('fri_end', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing_buttomcheckbox popres8">
						<?php
						echo $this->Form->input('fri_isclosed', array(
							'type' => 'checkbox',
							'label' => false,
							'hiddenField' => FALSE,
							'class' => 'checkbox-align'
						));
						?>
					</div>
				</div>
				<div class="popupdesing_buttom_first">
					<div class="popupdesing1 popupdesing1_normal popres1"><?php echo __('Sat'); ?></div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('sat_start', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('sat_end', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing_buttomcheckbox popres8">
						<?php
						echo $this->Form->input('sat_isclosed', array(
							'type' => 'checkbox',
							'label' => false,
							'hiddenField' => FALSE,
							'class' => 'checkbox-align'
						));
						?>
					</div>
				</div>
				<div class="popupdesing_buttom_first">
					<div class="popupdesing1 popupdesing1_normal popres1"><?php echo __('Sun'); ?></div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('sun_start', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing2">
						<?php
						echo $this->Form->input('sun_end', array(
							"label" => false,
							"class" => "popupdesing_buttomtextbox inp_time",
							"div" => array("class" => "input_warpper"),
						));
						?>
					</div>
					<div class="popupdesing_buttomcheckbox popres8">
						<?php
						echo $this->Form->input('sun_isclosed', array(
							'type' => 'checkbox',
							'label' => false,
							'hiddenField' => FALSE,
							'class' => 'checkbox-align'
						));
						?>
					</div>
				</div>
			</div>
		</div>

		<?php
		// End Paid User's Options
	}
	else
	{
		?>
		<div class="pinpopupinput"> 
			<div class="popupbrowsemaindiv">
				<div id="path">Upload Image</div>
				<div class="popupbrowsediv">
					<?php
					echo $this->Form->input('image', array(
						"label" => false,
						"type" => "file",
						"class" => "browseimg",
						"required" => true,
						"readonly" => true,
						"div" => false,
					));
					?>
					Browse
				</div>
			</div>
		</div>
		<?php
	}
	?>

	<div class="pinpopupinput"> 
		<button  class="buttonbox"><?php echo __('ADD PIN'); ?> </button>
	</div>
	<?php 
	echo $this->Form->end(); 
	
	if ($user_type == 1)
	{
		?>
		<div class="ftex" ><?php echo __('Want to upload more info?'); ?>&nbsp; <span id="getpre"><?php echo __('Get Premium'); ?></span></div>
		<?php
		//--
	}
	?>
</div>
