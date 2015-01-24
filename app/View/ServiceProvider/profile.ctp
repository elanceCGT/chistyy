<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script>

<div class="fullwidth">
    <?php echo $this->Form->create('User' ,array("class" => "form-horizontal formAdmin", 'type' => 'file')); ?>
        <div class="profile_50">
            <div class="form-group <?php echo $this->Form->isFieldError('User.username') ? "has-error" : "" ;?>">
            <label class="col-md-2 control-label">Username</label>
            <div class="col-md-4">
                <?php echo $this->Form->input('User.username',array('type' => 'text','placeholder' => 'Username','class'=>'form-control','label' => false,'div' => false,'readonly' => true,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
            </div>
        </div>

            <div class="form-group <?php echo $this->Form->isFieldError('User.password') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">Password</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('User.password',array('type' => 'password', 'value' => '', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>

            <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">Confirm Password</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('confirm_password',array('type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                </div>
            </div>
                                        
            <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.full_busnes_na1') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">Full Business Name 1</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.full_busnes_na1',array('type' => 'text',  'placeholder' => 'Full Business Name 1','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
                                        
            <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.full_busnes_na2') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">Full Business Name 2</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.full_busnes_na2',array('type' => 'text',  'placeholder' => 'Full Business Name 2','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
                                        
            <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.branch_name') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">Branch Name</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.branch_name',array('type' => 'text',  'placeholder' => 'Branch Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Country</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.contry_name',array('type' => 'text',  'placeholder' => 'Country','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>                
            </div>
            
            <div class="form-group">
            	<label class="col-md-2 control-label">Province</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.prov_name',array('type' => 'text',  'placeholder' => 'Province','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">City</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.city_name',array('type' => 'text',  'placeholder' => 'City','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
                                        
            <div class="form-group">
                <label class="col-md-2 control-label">FSA</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.addr_fsa',array('type' => 'text',  'placeholder' => 'FSA Part Of Postal Code','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                </div>                
            </div>
        
        	
        </div>
        
        <div class="profile_50">
        	<div class="form-group">
            	<label class="col-md-2 control-label">Postal Code</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.addr_postal_cd',array('type' => 'text', 'placeholder' => 'Full postal code','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
            
            <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.busnes_addr_tx') ? "has-error" : "" ;?>"><label class="col-md-2 control-label">Business Address</label>
            <div class="col-md-4">
                <?php echo $this->Form->input('ServiceProvider.busnes_addr_tx',array('type' => 'text',  'placeholder' => 'Business Address','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
            </div>
        </div>
                                
            <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.mail_addr_tx') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">Mail Address</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.mail_addr_tx',array('type' => 'text',  'placeholder' => 'Mail Address','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
            
            <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.email_addr_tx') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">Email Address</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.email_addr_tx',array('type' => 'text', 'placeholder' => 'Email Address','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Phone Number</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.busnes_phone_no',array('type' => 'text', 'placeholder' => 'Business Phone Number','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>                
            </div>
            <div class="form-group">
            	<label class="col-md-2 control-label">Fax Number</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.busnes_fax_no',array('type' => 'text',  'placeholder' => 'Business Fax Number','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
                                    
            <div class="form-group <?php echo $this->Form->isFieldError('ServiceProvider.owner_last_na') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">First Name</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.owner_first_na',array('type' => 'text',  'placeholder' => 'Owner First Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>                
            </div>
            
            <div class="form-group">
            	<label class="col-md-2 control-label">Last Name</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.owner_last_na',array('type' => 'text',  'placeholder' => 'Owner Last Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
            
            <div class="form-group modfld ">
                <label class="col-md-2 control-label">Gender</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.owner_gender_cd',array('type' => 'radio','class'=>'','label' => false,'div' => false,'required' => true,'options' => array('0' => '<label class="" > Male </label>', '1' => '<label class="" > Female </label>'),'before' => '', 'after' => '', 'between' => '', 'separator' => '<label class="" >&nbsp;&nbsp;&nbsp;</label>','legend' => false, 'fieldset' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Phone Number</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('ServiceProvider.owner_phone_no',array('type' => 'text',  'placeholder' => 'Owner Phone Number','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <button class="btn btn-primary f-right" type="submit">Save changes</button>
                    <button class="btn btn-primary f-right mar_r10" type="reset" onclick="goBack();">Cancel</button>
                </div>
            </div>
        
        </div>       

        <?php echo $this->Form->input('ServiceProvider.provider_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
        echo $this->Form->input('ServiceProvider.provider_lng',array('type' => 'hidden',  'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));

        echo $this->Form->end();
    ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
    
    $("#ServiceProviderBusnesAddrTx").on('change', function(){
        validateAddressnewsk();
    });
    $("#ServiceProviderBusnesAddrTx").on('blur', function(){
        validateAddressnewsk();
    });

    $("#ServiceProviderCityName").on('change', function(){
        validateAddressnewsk();
    });
    $("#ServiceProviderCityName").on('blur', function(){
        validateAddressnewsk();
    });

    $("#ServiceProviderProvName").on('change', function(){
        validateAddressnewsk();
    });
    $("#ServiceProviderProvName").on('blur', function(){
        validateAddressnewsk();
    });

    $("#ServiceProviderAddrPostalCd").on('change', function(){
        validateAddressnewsk();
    });

    $("#ServiceProviderAddrPostalCd").on('blur', function(){
        validateAddressnewsk();
    });
});

function validateAddressnewsk(){
    var address = "";
    address += $.trim($( "#ServiceProviderBusnesAddrTx" ).val());
    address += " "+$.trim($( "#ServiceProviderCityName" ).val());
    address += " "+$.trim($( "#ServiceProviderProvName" ).val());
    address += " "+$.trim($( "#ServiceProviderAddrPostalCd" ).text());
    
    var geo = new google.maps.Geocoder();
    geo.geocode({'address': address}, function (result,status){
        if (status == 'OK') {
            var latlongs    = result[0].geometry.location;
            var address = result[0].formatted_address;
            $("#ServiceProviderProviderLat").val(latlongs.lat());
            $("#ServiceProviderProviderLng").val(latlongs.lng());
        }else {
        }
    });
}
</script>