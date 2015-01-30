<style type="text/css">
.hr-line-dashed {
    background-color: #FFFFFF;
    border-top: 1px dashed #E7EAEC;
    color: #FFFFFF;
    height: 1px;
    margin: 20px 0;
}
.ui-datepicker { z-index:999 !important; }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script>
<div class="aboutusmain">
    <div class="aboutusmain_top">
        <div class="container">
            <div class=" col-md-12 aboutusmain_top_title">
                <div class=" col-md-12 aboutusmain_top_title"><?php echo $title_for_layout?></div>
            </div>
        </div>
    </div>
    <div class="aboutusmain_buttom">
        <div class="container">
            <?php echo $this->Form->create('User' ,array('autocomplete' => 'off', "class" => "form-horizontal formAdmin")); ?>
                <div class="form-group <?php echo $this->Form->isFieldError('username') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <?php  echo $this->Form->input('User.username',array('autocomplete' => 'off', 'type' => 'text','placeholder' => 'Username', 'class'=>'form-control', 'label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')))); ?>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="form-group <?php echo $this->Form->isFieldError('password') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('User.password',array('autocomplete' => 'off', 'type' => 'password', 'value' => '', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));
                        ?>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('confirm_password',array('autocomplete' => 'off', 'type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')))); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group <?php echo $this->Form->isFieldError('customer_name') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Service</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Cleaner.service_id',array('autocomplete' => 'off', 'type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => false,'options' => $Service, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>

                <div class="form-group <?php echo $this->Form->isFieldError('customer_name') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Cleaner Name</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Cleaner.cleaner_name',array('autocomplete' => 'off', 'type' => 'text', 'placeholder' => 'Cleaner Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                                        
                <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Cleaner.cleaner_gender',array('autocomplete' => 'off', 'type' => 'radio','class'=>'','label' => false,'div' => false,'required' => false,'options' => array('0' => '<label class="" > Male </label>', '1' => '<label class="" > Female </label>'),'before' => '', 'after' => '', 'between' => '', 'separator' => '<label class="" >&nbsp;&nbsp;&nbsp;</label>','legend' => false, 'fieldset' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                                        
                    <div class="form-group <?php echo $this->Form->isFieldError('dateofbirth') ? "has-error" : "" ;?>">
                        <label class="col-sm-2 control-label">Date Of Birth</label>
                        <div class="col-sm-10">
                        <?php echo $this->Form->input('Cleaner.cleaner_dateofbirth',array('autocomplete' => 'off', 'readonly' => true,'type' => 'text',  'value' => '', 'placeholder' => '',  'class'=>'form-control', 'label' => false, 'div' => false, 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')))); ?>
                        </div>
                </div>
                <div class="hr-line-dashed"></div>
                                        
                <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">Contact No.</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Cleaner.cleaner_caontact_number',array('autocomplete' => 'off', 'type' => 'text', 'placeholder' => 'Contact No','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                                        
                <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                    <?php echo $this->Form->input('Cleaner.cleaner_address',array('autocomplete' => 'off', 'type' => 'textarea', 'placeholder' => '','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                
                <div class="hr-line-dashed"></div>
                                        
                <div class="form-group <?php echo $this->Form->isFieldError('cleaner_city') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Cleaner.cleaner_city',array('autocomplete' => 'off', 'type' => 'text', 'placeholder' => 'City','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                
                <div class="hr-line-dashed"></div>
                                        
                <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">State</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Cleaner.cleaner_state',array('autocomplete' => 'off', 'type' => 'text', 'placeholder' => 'State','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                
                <div class="hr-line-dashed"></div>
                                        
                <div class="form-group <?php echo $this->Form->isFieldError('cleaner_zip_code') ? "has-error" : "" ;?>">
                    <label class="col-sm-2 control-label">Zip</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('Cleaner.cleaner_zip_code',array('autocomplete' => 'off', 'type' => 'text', 'placeholder' => 'Zip','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                                        
                <?php echo $this->Form->input('Cleaner.cleaner_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));
                    echo $this->Form->input('Cleaner.cleaner_lng',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')))); 
                    //echo $this->Form->input('Cleaner.category_id',array('type' => 'hidden','required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
                    ?>

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit">Save changes</button>
                        <button class="btn btn-white" type="reset" onclick="goBack();">Cancel</button>
                    </div>
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
var jsonvalue;
    $(document).ready(function(){

        jsonvalue = <?php echo $category_service_link; ?>;

        //$("#CleanerCleanerDateofbirth").datepicker();

        $("#CleanerCleanerDateofbirth").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1960:2000",
            minDate: new Date(1970, 1 - 1, 1)
        });
        $( "#CleanerCleanerDateofbirth" ).datepicker( "setDate", "01/01/1970" );
        
		$("#CleanerCleanerAddress").on('change', function(){
			validateAddressnewsk();
		});
		
		$("#CleanerCleanerCity").on('change', function(){
			validateAddressnewsk();
		});

		$("#CleanerCleanerState").on('change', function(){
			validateAddressnewsk();
		});

		$("#CleanerCleanerZipCode").on('change', function(){
			validateAddressnewsk();
		});
		
        $("#CleanerServiceId").on("change", function(){
            console.log(jsonvalue.$(this).val());
        });	
        
	});	
	
	function validateAddressnewsk(){ //alert($.trim($( "#province option:selected" ).text()));
		var address = "";
		address += $.trim($( "#CleanerCleanerAddress" ).val());
		address += " "+$.trim($( "#CleanerCleanerCity" ).val());
		address += " "+$.trim($( "#CleanerCleanerState" ).val());
		address += " "+$.trim($( "#CleanerCleanerZipCode" ).val());
		
		var geo = new google.maps.Geocoder();
		geo.geocode({'address': address}, function (result,status){
			if (status == 'OK') {
				var latlongs	= result[0].geometry.location;
				var address = result[0].formatted_address;
				console.log(latlongs);
				$("#CleanerCleanerLat").val(latlongs.lat());
				$("#CleanerCleanerLng").val(latlongs.lng());
			}else {
			}
		});
	}
</script>