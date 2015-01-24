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
<div class="fullwidth">
		<?php echo $this->Form->create('User' ,array("class" => "form-horizontal formAdmin", 'type' => 'file')); ?>
            <div class="profile_50">
                <div class="form-group <?php echo $this->Form->isFieldError('User.username') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">Username</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('User.username',array('type' => 'text','placeholder' => 'Username','class'=>'form-control','label' => false,'readonly' => true,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                </div>
    
                <div class="form-group <?php echo $this->Form->isFieldError('User.password') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">Password</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('User.password',array('type' => 'password', 'value' => '', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                </div>
    
                <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">Confirm Password</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('confirm_password',array('type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                
                <div class="form-group <?php echo $this->Form->isFieldError('Cleaner.first_na') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">First Name</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Cleaner.first_na',array('type' => 'text',  'placeholder' => 'First Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>
                
                <div class="form-group">
                	<label class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Cleaner.last_na',array('type' => 'text',  'placeholder' => 'Last Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                </div>
                
                <div class="form-group modfld">
                    <label class="col-md-2 control-label">Gender</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Cleaner.gender_cd',array('type' => 'radio','class'=>'','label' => false,'div' => false,'required' => true,'options' => array('0' => '<label class="" > Male </label>', '1' => '<label class="" > Female </label>'),'before' => '', 'after' => '', 'between' => '', 'separator' => '<label class="" >&nbsp;&nbsp;&nbsp;</label>','legend' => false, 'fieldset' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Phone Number</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Cleaner.phone_no',array('type' => 'text',  'placeholder' => 'Phone Number','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                </div>
    
                <div class="form-group">
                    <label class="col-md-2 control-label">Country</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Cleaner.contry_mn',array('type' => 'text',  'placeholder' => 'Country','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>
                
                <div class="form-group">
                	<label class="col-md-2 control-label">Province</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Cleaner.prov_mn',array('type' => 'text',  'placeholder' => 'Province','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                </div>
                
                
                                      
            </div>
            <div class="profile_50">
            		<div class="form-group">
                    <label class="col-md-2 control-label">City</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Cleaner.city_mn',array('type' => 'text',  'placeholder' => 'District','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                </div>
                                            
                    <div class="form-group">
                        <label class="col-md-2 control-label">District</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Cleaner.dstrct_mn',array('type' => 'text',  'placeholder' => 'City','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>           
                    </div>
                     
                    <div class="form-group">
                    <label class="col-md-2 control-label">FSA</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Cleaner.addr_fsa',array('type' => 'text',  'placeholder' => 'FSA Part Of Postal Code','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>
                
                    <div class="form-group">
                        <label class="col-md-2 control-label">Postal Code</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Cleaner.addr_postal_cd',array('type' => 'text', 'placeholder' => 'Full postal code','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                    </div>
                                            
                    <div class="form-group <?php echo $this->Form->isFieldError('Cleaner.busnes_addr_tx') ? "has-error" : "" ;?>"><label class="col-md-2 control-label">Business Address</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Cleaner.busnes_addr_tx',array('type' => 'text',  'placeholder' => 'Business Address','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                    </div>
                                            
                    <div class="form-group <?php echo $this->Form->isFieldError('Cleaner.mail_addr_tx') ? "has-error" : "" ;?>">
                        <label class="col-md-2 control-label">Mail Address</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Cleaner.mail_addr_tx',array('type' => 'text',  'placeholder' => 'Mail Address','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php echo $this->Form->isFieldError('Cleaner.email_addr_tx') ? "has-error" : "" ;?>">
                        <label class="col-md-2 control-label">Email Address</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Cleaner.email_addr_tx',array('type' => 'text', 'placeholder' => 'Email Address','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Phone Number</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Cleaner.busnes_phone_no',array('type' => 'text', 'placeholder' => 'Business Phone Number','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-2 control-label">Fax Number</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Cleaner.busnes_fax_no',array('type' => 'text',  'placeholder' => 'Business Fax Number','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
        			</div>
                    
                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-primary f-right" type="submit">Save changes</button>
                            <button class="btn btn-grey f-right mar_r10" type="reset" onclick="goBack();">Cancel</button>
                        </div>
                    </div>
                </div>
            

            <?php echo $this->Form->input('Cleaner.cleaner_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
            echo $this->Form->input('Cleaner.cleaner_lng',array('type' => 'hidden',  'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
            echo $this->Form->end();?>
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