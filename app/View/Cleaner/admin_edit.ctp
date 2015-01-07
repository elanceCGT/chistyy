<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
        <?/*?><ol class="breadcrumb">
            <li> <a href="index.html">Home</a> </li>
        </ol><?*/?>
    </div>
</div>
<STYLE TYPE="text/css">
.ui-datepicker { z-index:999 !important; }
</STYLE>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script>
<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins"> 
                <!-- <div class="formAdmin"> -->                
                <div class="ibox-content">
                    
                    <?php
                        echo $this->Form->create('User' ,array("class" => "form-horizontal formAdmin"));
                        echo $this->Form->hidden('user_type' ,array('value'=>2));
                    ?>
                        
                        <div class="form-group <?php echo $this->Form->isFieldError('username') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <?php  echo $this->Form->input('User.username',array('type' => 'text', 'placeholder' => 'Username', 'class'=>'form-control', 'label' => false, 'div' => false, 'readonly' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('password') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('User.password',array('type' => 'password','required' => false, 'value' => '', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));
                                    //echo "<span class='control-label'>".$this->Form->error('password')."</span>";
                                ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('confirm_password',array('type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')))); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                        <!-- new area -->
                        
                        <div class="form-group <?php echo $this->Form->isFieldError('service_provider_id') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Service Provider</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.service_provider_id',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => false,'options' => $ServiceProvider, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo $this->Form->isFieldError('service_id') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Service</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.service_id',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => false,'options' => $Service, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo $this->Form->isFieldError('cleaner_name') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Cleaner Name</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.cleaner_name',array('type' => 'text', 'placeholder' => 'Cleaner Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('cleaner_gender') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.cleaner_gender',array('type' => 'radio','class'=>'','label' => false,'div' => false,'required' => false,'options' => array('0' => '<label class="" > Male </label>', '1' => '<label class="" > Female </label>'),'before' => '', 'after' => '', 'between' => '', 'separator' => '<label class="" >&nbsp;&nbsp;&nbsp;</label>','legend' => false, 'fieldset' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                            <div class="form-group <?php echo $this->Form->isFieldError('cleaner_dateofbirth') ? "has-error" : "" ;?>">
                                <label class="col-sm-2 control-label">Date Of Birth</label>
                                <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.cleaner_dateofbirth',array('readonly' => true,'type' => 'text', 'placeholder' => '',  'class'=>'form-control', 'label' => false, 'div' => false, 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')))); ?>
                                </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('cleaner_caontact_number') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Contact No.</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.cleaner_caontact_number',array('type' => 'text', 'placeholder' => 'Contact No','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('cleaner_address') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                            <?php echo $this->Form->input('Cleaner.cleaner_address',array('type' => 'textarea', 'placeholder' => '','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('cleaner_city') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.cleaner_city',array('type' => 'text', 'placeholder' => 'City','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('cleaner_state') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">State</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.cleaner_state',array('type' => 'text', 'placeholder' => 'State','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                        <div class="form-group <?php echo $this->Form->isFieldError('cleaner_zip_code') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Zip</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Cleaner.cleaner_zip_code',array('type' => 'text', 'placeholder' => 'Zip','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                                                
                        <?php echo $this->Form->input('Cleaner.id',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));
                        
                        echo $this->Form->input('Cleaner.cleaner_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));

                        echo $this->Form->input('Cleaner.cleaner_lng',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));

                        echo $this->Form->input('Cleaner.category_id',array('type' => 'hidden','required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                                <button class="btn btn-white" type="reset" onclick="goBack();">Cancel</button>
                            </div>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
                    
                <!-- </div> -->
            </div>
        
            
            
        </div>
    </div>
</div>

<script type="text/javascript">
    function goBack() {
        window.top.location = "<? echo $this->Html->url(array('controller'=>'Cleaner','action' => 'admin_index'), true); ?>"
    }
		$(document).ready(function(){
			$( "#CleanerCleanerDateofbirth" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "1960:2000",
                minDate: new Date(1970, 1 - 1, 1)
            });
			
			$("#CleanerCleanerAddress").on('change', function(){
				validateAddressnewsk();
			});
				
			$("#CleanerCleanerCity").on('change', function(){
				validateAddressnewsk();
			});

			$("#CleanerCleanertate").on('change', function(){
                validateAddressnewsk();
			});

			$("#CleanerCleanerZipCode").on('change', function(){
				validateAddressnewsk();
			});
		});
		
		function validateAddressnewsk(){ //alert($.trim($( "#province option:selected" ).text()));
		var address = "";
		address += $.trim($( "#CleanerCleanerAddress" ).val());
		address += " "+$.trim($( "#CleanerCleanerCity" ).val());
		address += " "+$.trim($( "#CleanerCleanertate" ).val());
		address += " "+$.trim($( "#CleanerCleanerZipCode" ).text());
		
		var geo = new google.maps.Geocoder();
		geo.geocode({'address': address}, function (result,status){
			if (status == 'OK') {
				var latlongs	= result[0].geometry.location;
				var address = result[0].formatted_address;
				//createMarker(latlongs.lat(),latlongs.lng(),address);
				$("#CleanerCleanerLat").val(latlongs.lat());
				$("#CleanerCleanerLng").val(latlongs.lng());
			}else {
			}
		});
	}
	
</script>