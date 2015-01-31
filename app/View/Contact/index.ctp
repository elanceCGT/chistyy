<style type="text/css">
    .contact{
        width: 80%;
        margin: 0px auto;
     }
     .main_container{
        margin: 50px;
     }

</style>
<div class="contact">
<?php echo $this->Session->flash();?>
    <?php echo $this->Form->create('User' ,array("class" => "form-horizontal formAdmin", 'type' => 'file')); ?>
        <div class="profile_50">
           
            <div class="form-group <?php echo $this->Form->isFieldError('Contact.contact_name') ? "has-error" : "" ;?>">
                <!-- <label class="col-md-2 control-label">Name</label> -->
                <div class="col-md-6">
                    <?php echo $this->Form->input('Contact.contact_name',array('type' => 'text','placeholder' => 'Full Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>

                <div class="col-md-6">
                    <?php echo $this->Form->input('Contact.contact_email',array('type' => 'text',  'placeholder' => 'Email Address','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>  


            <div class="form-group <?php echo $this->Form->isFieldError('Contact.contact_subject') ? "has-error" : "" ;?>">
                <!-- <label class="col-md-2 control-label">Subject</label> -->
                <div class="col-md-12">
                    <?php echo $this->Form->input('Contact.contact_subject',array('type' => 'text',  'placeholder' => 'Subject','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>
                                        
            <div class="form-group <?php echo $this->Form->isFieldError('Contact.contact_message') ? "has-error" : "" ;?>">
                <!-- <label class="col-md-2 control-label">Message</label> -->
                <div class="col-md-12">
                    <?php echo $this->Form->input('Contact.contact_message',array('type' => 'textarea',  'placeholder' => 'Message','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <button class="btn btn-primary f-right" type="submit">GET IN TOUCH</button>
                    <!-- <button class="btn btn-primary f-right mar_r10" type="reset" onclick="goBack();">Cancel</button> -->
                </div>
            </div>
        
        </div>

        <div class="profile_50">
                <div style="width:80%;margin:0px auto">
                    <div class="block7_left">
                    <div class="block7_lefttitle">Contact Info</div>
                    <div class="block7_leftext">Quisque : dfsf<br> Quisque : dfsf </div>
                    <div class="block7_leftext">Quisque : dfsf<br> Quisque : dfsf </div>
                    <div class="block7_leftext">Quisque : dfsf<br> Quisque : dfsf </div>

                    <div class="block7_lefttitle">Social Links</div>
                    <div class="block7_leftext">Quisque : dfsf<br> Quisque : dfsf </div>
                    </div>

                </div>
        </div>       

        <?php //echo $this->Form->input('ServiceProvider.provider_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
        
        //echo $this->Form->input('ServiceProvider.provider_lng',array('type' => 'hidden',  'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));

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