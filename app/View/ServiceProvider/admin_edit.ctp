<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
        <?/*?><ol class="breadcrumb">
            <li> <a href="index.html">Home</a> </li>
        </ol><?*/?>
    </div>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!-- <div class="formAdmin"> -->
                <div class="ibox-content">
                    <?php echo $this->Form->create('User' ,array("class" => "form-horizontal formAdmin", 'type' => 'file')); ?>
                        
						<div class="form-group <?php echo $this->Form->isFieldError('User.username') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('User.username',array('type' => 'text','placeholder' => 'Username','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
                                 ?>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('User.password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('User.password',array('type' => 'password', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
							    ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('confirm_password',array('type' => 'password', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
												<!-- new area -->
                        
												<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_name') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Provider Name</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.provider_name',array('type' => 'text', 'placeholder' => 'Provider Name','class'=>'form-control','label' => false,'div' => false,'required' => true,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.contact_name') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Contact Name</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.contact_name',array('type' => 'text', 'placeholder' => 'Contact Name','class'=>'form-control','label' => false,'div' => false,'required' => true,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.contact_number') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Contact No.</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.contact_number',array('type' => 'text', 'placeholder' => 'Contact No','class'=>'form-control','label' => false,'div' => false,'required' => true,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.street_address') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.street_address',array('type' => 'textarea', 'placeholder' => '','class'=>'form-control','label' => false,'div' => false,'required' => true,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_city') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.provider_city',array('type' => 'text', 'placeholder' => 'City','class'=>'form-control','label' => false,'div' => false,'required' => true,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_state') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">State</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.provider_state',array('type' => 'text', 'placeholder' => 'State','class'=>'form-control','label' => false,'div' => false,'required' => true,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.provider_zip_code') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Zip</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.provider_zip_code',array('type' => 'text', 'placeholder' => 'Zip','class'=>'form-control','label' => false,'div' => false,'required' => true,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>
												
												    	<?php
							        echo $this->Form->input('ServiceProvider.provider_lat',array('type' => 'hidden',
											'required' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        
    	<?php
							        echo $this->Form->input('ServiceProvider.provider_lng',array('type' => 'hidden',
											'required' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
												
												
												<div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Provider Description</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.provider_description',array('type' => 'text', 'placeholder' => 'Provider Description','class'=>'form-control','label' => false,'div' => false,'required' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Provider Website</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.provider_website',array('type' => 'text', 'placeholder' => 'Provider Website','class'=>'form-control','label' => false,'div' => false,'required' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Provider Email Address</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.provider_email_address',array('type' => 'text', 'placeholder' => 'Provider Email Address','class'=>'form-control','label' => false,'div' => false,'required' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
												
												<div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Provider Logo</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('ServiceProvider.provider_logo',array('type' => 'file',  'placeholder' => 'Provider Logo','class'=>'form-control','label' => false,'div' => false,'required' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                 ?>
                        	</div>
                        </div>
												<!-- area end -->
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                                <button class="btn btn-white" type="reset" onclick="goBack();">Cancel</button>
                            </div>
                        </div>



                    <?php
						echo $this->Form->end();
					?>
                </div>
                    
                <!-- </div> -->
            </div>
        
            
            
        </div>
    </div>
</div>

<script type="text/javascript">
    function goBack() {
        window.top.location = "<?php echo $this->Html->url(array('controller'=>'serviceprovider','action' => 'admin_index'), true); ?>"
    }
	$(document).ready(function(){
		$( "#CustomerCustomerDateofbirth" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1960:2000",
            minDate: new Date(1970, 1 - 1, 1)
        });

		$("#CustomerCustomerAddress").on('change', function(){
				validateAddressnewsk();
		});
			
		$("#CustomerCustomerCity").on('change', function(){
				validateAddressnewsk();
		});

		$("#CustomerCustomerState").on('change', function(){
				validateAddressnewsk();
		});

		$("#CustomerCustomerZipCode").on('change', function(){
				validateAddressnewsk();
		});
	});
		
		
		
		function validateAddressnewsk(){ //alert($.trim($( "#province option:selected" ).text()));
		var address = "";
		address += $.trim($( "#CustomerCustomerAddress" ).val());
		address += " "+$.trim($( "#CustomerCustomerCity" ).val());
		address += " "+$.trim($( "#CustomerCustomerState" ).val());
		address += " "+$.trim($( "#CustomerCustomerZipCode" ).text());
		
		var geo = new google.maps.Geocoder();
		geo.geocode({'address': address}, function (result,status){
			if (status == 'OK') {
				var latlongs	= result[0].geometry.location;
				var address = result[0].formatted_address;
				//createMarker(latlongs.lat(),latlongs.lng(),address);
				$("#CustomerCustomerLat").val(latlongs.lat());
				$("#CustomerCustomerLng").val(latlongs.lng());
			}else {
			}
		});
	}
	
</script>