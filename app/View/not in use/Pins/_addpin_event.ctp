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
			'value' => $location_type
		));
		?>
	</div>
	<div class="pinpopupinput"> 
		<?php
		echo $this->Form->input("name", array(
			"label" => false,
			"class" => "pinpopuptextbox",
			"placeholder" => "Event Name",
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
	<div class="pinpopupinput"> 
		<?php
		echo $this->Form->input("event_date", array(
			'type' => 'text',
			"label" => false,
			"class" => "pinpopuptextbox inp_datepicker",
			"placeholder" => "Date",
			"div" => array("class" => "input_warpper"),
			"required" => true,
			"readonly" => true,
		));
		?>
	</div>
	<div class="pinpopupinput"> 
		<?php
		echo $this->Form->input("description", array(
			"label" => false,
			"class" => "pinpopuptextbox",
			"placeholder" => "Description",
			"div" => array("class" => "input_warpper"),
		));
		?>
	</div>
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
	<div class="pinpopupinput"> 
		<button  class="buttonbox"><?php echo __('ADD PIN'); ?> </button>
	</div>
	<?php
	echo $this->Form->end();
	?>
</div>
		