<style type="text/css">
.hr-line-dashed {
    background-color: #FFFFFF;
    border-top: 1px dashed #E7EAEC;
    color: #FFFFFF;
    height: 1px;
    margin: 20px 0;
}
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#selectform_1").click(function(){
			$(".selectform").hide();
			$("#div_servicesprovider").show();
		});
		
		$("#selectform_2").click(function(){
			$(".selectform").hide();
			$("#div_customer").show();
		});

		$( "#CustomerCustomerDateofbirth" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showWeek: true,
            firstDay: 1,
            yearRange: "1970:2000"
        });
		
        $( "#CustomerCustomerDateofbirth" ).datepicker( "setDate", "01/01/1970" );

		$("#CustomerCustomerAddress").on('change', function(){
			ValidateCustomerAddress();
		});
			
		$("#CustomerCustomerCity").on('change', function(){
			ValidateCustomerAddress();
		});

		$("#CustomerCustomerState").on('change', function(){
			ValidateCustomerAddress();
		});

		$("#CustomerCustomerZipCode").on('change', function(){
			ValidateCustomerAddress();
		});

		$("#ServiceProviderStreetAddress").on('change', function(){
			validateAddressnewsk();
		});
			
		$("#ServiceProviderProviderCity").on('change', function(){
			validateAddressnewsk();
		});

		$("#ServiceProviderProviderState").on('change', function(){
			validateAddressnewsk();
		});

		$("#ServiceProviderProviderZipCode").on('change', function(){
			validateAddressnewsk();
		});
	});

	function ValidateCustomerAddress(){
		
		var address = "";
		address += $.trim($("#CustomerCustomerAddress").val());
		address += " "+$.trim($("#CustomerCustomerCity").val());
		address += " "+$.trim($("#CustomerCustomerState").val());
		address += " "+$.trim($("#CustomerCustomerZipCode").text());
		
		var geo = new google.maps.Geocoder();

		geo.geocode({'address': address}, function (result,status){
			if (status == 'OK') {
				var latlongs	= result[0].geometry.location;
				var address = result[0].formatted_address;
				$("#CustomerCustomerLat").val(latlongs.lat());
				$("#CustomerCustomerLng").val(latlongs.lng());
			}else {

			}
		});
	}

	function validateAddressnewsk(){
		var address = "";
		address += $.trim($( "#ServiceProviderStreetAddress" ).val());
		address += " "+$.trim($( "#ServiceProviderProviderCity" ).val());
		address += " "+$.trim($( "#ServiceProviderProviderState" ).val());
		address += " "+$.trim($( "#ServiceProviderProviderZipCode" ).text());
		
		var geo = new google.maps.Geocoder();
		geo.geocode({'address': address}, function (result,status){
			if (status == 'OK') {
				var latlongs	= result[0].geometry.location;
				var address = result[0].formatted_address;
				$("#ServiceProviderProviderLat").val(latlongs.lat());
				$("#ServiceProviderProviderLng").val(latlongs.lng());
			}else {
			}
		});
	}
</script>
<div class="aboutusmain">
	<div class="aboutusmain_top">
		<div class="container">
			<div class=" col-md-12 aboutusmain_top_title">
				<div class=" col-md-12 aboutusmain_top_title">User Signup</div>
			</div>
		</div>
	</div>
	<div class="aboutusmain_buttom">
		<div class="container">
			
			<div class="col-md-12">
				<div class="col-md-4"></div>
				<div class="col-md-2"><input id="selectform_1" type="radio" name="selectform" value="1" checked="checked" /> Service Provider </div>
				<div class="col-md-2"><input id="selectform_2" type="radio" name="selectform" value="2" /> Customer </div>
				<div class="col-md-4"></div>
			</div>

			<div class="col-md-12">
				<div id="div_servicesprovider" class="selectform">
                    <?php echo $this->Form->create('User', array('url' => array('controller' => 'serviceprovider', 'action' => 'register'), "class" => "form-horizontal formAdmin")); ?>
                        
                        <div class="hr-line-dashed"></div>

                    	<div class="form-group <?php echo $this->Form->isFieldError('User.username') ? "has-error" : "" ;?>">
                    		<label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('User.username',array('type' => 'text','placeholder' => 'Username','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('User.password') ? "has-error" : "" ;?>">
                        	<label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('User.password',array('type' => 'password', 'value' => '', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));
                                ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('confirm_password',array('type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                                                
                        
                        <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_name') ? "has-error" : "" ;?>">
                        	<label class="col-sm-2 control-label">Provider Name</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.provider_name',array('type' => 'text',  'placeholder' => 'Provider Name','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
						<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.contact_name') ? "has-error" : "" ;?>">
							<label class="col-sm-2 control-label">Contact Name</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.contact_name',array('type' => 'text',  'placeholder' => 'Contact Name','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                                                
						<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.contact_number') ? "has-error" : "" ;?>">
							<label class="col-sm-2 control-label">Contact No.</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.contact_number',array('type' => 'text',  'placeholder' => 'Contact No','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                                                
						<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.street_address') ? "has-error" : "" ;?>">
							<label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.street_address',array('type' => 'textarea', 'placeholder' => '','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_city') ? "has-error" : "" ;?>">
                        	<label class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.provider_city',array('type' => 'text',  'placeholder' => 'City','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_state') ? "has-error" : "" ;?>">
                        	<label class="col-sm-2 control-label">State</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.provider_state',array('type' => 'text',  'placeholder' => 'State','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_zip_code') ? "has-error" : "" ;?>">
                        	<label class="col-sm-2 control-label">Zip</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.provider_zip_code',array('type' => 'text', 'placeholder' => 'Zip','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                                                
                        <?php echo $this->Form->input('ServiceProvider.provider_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));

                        	echo $this->Form->input('ServiceProvider.provider_lng',array('type' => 'hidden',  'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                                                
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_description') ? "has-error" : "" ;?>">
                        	<label class="col-sm-2 control-label">Provider Description</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.provider_description',array('type' => 'text', 'placeholder' => 'Provider Description','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_website') ? "has-error" : "" ;?>">
                        	<label class="col-sm-2 control-label">Provider Website</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.provider_website',array('type' => 'text',  'placeholder' => 'Provider Website','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                                                
                         <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_email_address') ? "has-error" : "" ;?>">
                         	<label class="col-sm-2 control-label">Provider Email Address</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.provider_email_address',array('type' => 'text',  'placeholder' => 'Provider Email Address','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_logo') ? "has-error" : "" ;?>">
                        	<label class="col-sm-2 control-label">Provider Logo</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('ServiceProvider.provider_logo',array('type' => 'file', 'placeholder' => 'Provider Logo','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')))); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                                <button class="btn btn-white" type="reset" onclick="goBack();">Cancel</button>
                            </div>
                        </div>
					<?php echo $this->Form->end(); ?>
				</div>
				<div id="div_customer" style="display:none;" class="selectform">
					<?php echo $this->Form->create('User', array('url' => array('controller' => 'customers', 'action' => 'register'), "class" => "form-horizontal formAdmin")); ?>
                        <div class="hr-line-dashed"></div>
    					<div class="form-group <?php echo $this->Form->isFieldError('username') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('User.username',array('type' => 'text','placeholder' => 'Username','class'=>'form-control','label' => false,'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('password') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('User.password',array('type' => 'password', 'value' => '', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('confirm_password',array('type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        
						<div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_name') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Customer Name</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('Customer.customer_name',array('type' => 'text',  'placeholder' => 'Customer Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
												
						<div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_gender') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('Customer.customer_gender',array('type' => 'radio','class'=>'','label' => false,'div' => false,'required' => false,'options' => array('0' => '<label class="" > Male </label>', '1' => '<label class="" > Female </label>'),'before' => '', 'after' => '', 'between' => '', 'separator' => '<label class="" >&nbsp;&nbsp;&nbsp;</label>','legend' => false, 'fieldset' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')))); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
												
						<div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_dateofbirth') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Date Of Birth</label>
                            <div class="col-sm-10">
                            <?php echo $this->Form->input('Customer.customer_dateofbirth',array( 'readonly' => true, 'type' => 'text',  'placeholder' => '', 'class'=>'form-control', 'label' => false, 'div' => false, 'required' => false, 'error' => array('attributes' => array( 'wrap' => 'span', 'class' => 'control-label' )))); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
												
						<div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_number') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Contact No.</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('Customer.customer_number',array('type' => 'text',  'placeholder' => 'Contact No','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
												
						<div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_address') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('Customer.customer_address',array('type' => 'textarea',  'placeholder' => '','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
												
						<div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_city') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('Customer.customer_city',array('type' => 'text',  'placeholder' => 'City','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
												
						<div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_state') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">State</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('Customer.customer_state',array('type' => 'text',  'placeholder' => 'State','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
												
						<div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_zip_code') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Zip</label>
                            <div class="col-sm-10">
                            	<?php echo $this->Form->input('Customer.customer_zip_code',array('type' => 'text',  'placeholder' => 'Zip','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                        	</div>
                        </div>

                        <div class="hr-line-dashed"></div>
												
						<?php echo $this->Form->input('Customer.customer_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); 

                            echo $this->Form->input('Customer.customer_lng',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>

                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                                <button class="btn btn-white" type="reset" onclick="goBack();">Cancel</button>
                            </div>
                        </div>
                    <?php echo $this->Form->end(); ?>
				</div>
			</div>  
		</div>
    </div>
</div>