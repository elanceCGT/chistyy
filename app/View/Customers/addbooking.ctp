<style type="text/css">
.hr-line-dashed {
    background-color: #FFFFFF;
    border-top: 1px dashed #E7EAEC;
    color: #FFFFFF;
    height: 1px;
    margin: 20px 0;
}
</style>
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script> -->
<script type="text/javascript">
  /*  $(document).ready(function(){
        
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
            yearRange: "1970:-15",
        });
    }*/
    $(document).ready(function(){
        $( "#BookingBookingDate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showWeek: true,
            firstDay: 1,
            yearRange: "+0:+0",
        });

        $('#BookingAddSameAsProfile').click(function(){
            if($(this).is(':checked')){
                $('#BookingHomeAddrStreet').val('<?php echo $customer_data['Customer']['customer_address']?>');
                $('#BookingHomeAddrProv').val('<?php echo $customer_data['Customer']['customer_proviencs']?>');
                $('#BookingHomeAddrState').val('<?php echo $customer_data['Customer']['customer_state']?>');
                $('#BookingHomeAddrCountry').val('<?php echo $customer_data['Customer']['customer_country']?>');
                $('#BookingHomeAddrFsa').val('<?php echo $customer_data['Customer']['customer_fsa']?>');
                $('#BookingHomeAddrPcd').val('<?php echo $customer_data['Customer']['customer_zip_code']?>');                
            }else
            {
                $('#BookingHomeAddrStreet').val('');
                $('#BookingHomeAddrProv').val('');
                $('#BookingHomeAddrState').val('');
                $('#BookingHomeAddrCountry').val('');
                $('#BookingHomeAddrFsa').val('');
                $('#BookingHomeAddrPcd').val('');
            }
            //customer_data
        })

        $('.tg').click(function(){
            $('.bookingwizard').toggle();
            $('.sn').html($("#BookingServiceId option:selected").text());
            $('.nr').html($('#BookingNumberOfRooms').val());
            $('.nbr').html($('#BookingNumberOfBathRooms').val());
            $('.eh').html($('#BookingEstimatedHours').val());
            $('.nclr').html($('#BookingNumberOfCleaner').val());
            $('.dt').html($('#BookingBookingDate').val()+'  '+$('#BookingBookingTime').val());

            //$('.eh').text($('#BookingBookingTime').val()).text());
        });
    })
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script>
<div class="fullwidth">
        <?php echo $this->Form->create('Booking' ,array("class" => "form-horizontal formAdmin", 'type' => 'file')); ?>
        <?php //echo $this->Form->input('Customer.id', array('hiddenField' => true)); ?> 
            <div class="profile_100 bookingwizard">
                <div class="form-group <?php echo $this->Form->isFieldError('User.username') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">Service Name</label>
                    <div class="col-md-4">
                        <?php //echo $this->Form->input('User.username',array('type' => 'text','placeholder' => 'Username','class'=>'form-control','label' => false,'readonly' => true,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        <?php echo $this->Form->input('Booking.service_id', array('options' => $services,'class'=>'form-control','label' => false,'div' => false,'empty' => 'Select Service')); ?>
                    </div>
                </div>
    
                
                 <div class="form-group <?php //echo $this->Form->isFieldError('Customer.customer_name') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">No. of Bed Rooms</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Booking.number_of_rooms',array('type' => 'text',  'placeholder' => 'No. of Bed Rooms','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>

                 <div class="form-group <?php //echo $this->Form->isFieldError('Customer.customer_name') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">No. of Bath Rooms</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Booking.number_of_bath_rooms',array('type' => 'text',  'placeholder' => 'No. of Bath Rooms','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>
                <div class="form-group <?php //echo $this->Form->isFieldError('Customer.customer_name') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">Estimated Hours</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Booking.estimated_hours',array('type' => 'text',  'placeholder' => 'Estimated Hours','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>

                <div class="form-group <?php //echo $this->Form->isFieldError('Customer.customer_name') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">No. of Cleaner's Required</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Booking.number_of_cleaner',array('type' => 'text',  'placeholder' => 'No. of Cleaner','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>

                <div class="form-group <?php //echo $this->Form->isFieldError('Customer.customer_name') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">Date and Time</label>
                    <div class="col-md-2">
                        <?php echo $this->Form->input('Booking.booking_date',array('type' => 'text',  'placeholder' => 'Booking Date','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $this->Form->input('Booking.booking_time',array('type' => 'text',  'placeholder' => 'Booking Time','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>
                  <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-primary f-right tg">Submit</button>
                        </div>
                  </div>
                

                
                
            
                                      
            </div>

             <div class="profile_100 bookingwizard" style="display:none">
                 <div class="form-group">
                    <?php echo $this->Form->checkbox('add_same_as_profile', array('hiddenField' => false,'style'=>'float:left'));?>
                    <div style="float:left; margin-left:10px;">Same as your profile.</div>
                 </div>   
                 
                 <div class="form-group">
                    <label class="col-md-2 control-label">Street Address</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Booking.home_addr_street',array('type' => 'text',  'placeholder' => 'Address','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Province</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Booking.home_addr_prov',array('type' => 'text',  'placeholder' => 'Province','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                 </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">State</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Booking.home_addr_state',array('type' => 'text',  'placeholder' => 'State','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Country</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Booking.home_addr_country',array('type' => 'text',  'placeholder' => 'Country','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">FSA</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Booking.home_addr_fsa',array('type' => 'text',  'placeholder' => 'FSA','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Postal Code</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Booking.home_addr_pcd',array('type' => 'text',  'placeholder' => 'Postal Code','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Service Name</label>
                        <div class="col-md-4">
                            <label class="col-md-4 control-label sn"></label>
                        </div>
                 </div>
                 <div class="form-group">
                    <label class="col-md-2 control-label">No. of Bed Rooms</label>
                        <div class="col-md-4">
                            <label class="col-md-4 control-label nr"></label>
                        </div>
                 </div>
                 <div class="form-group">
                    <label class="col-md-2 control-label">No. of Bath Rooms</label>
                        <div class="col-md-4">
                            <label class="col-md-4 control-label nbr"></label>
                        </div>
                 </div>
                 <div class="form-group">
                    <label class="col-md-2 control-label">Estimated Hours</label>
                        <div class="col-md-4">
                            <label class="col-md-4 control-label eh"></label>
                        </div>
                 </div>
                 <div class="form-group">
                    <label class="col-md-2 control-label">Number of Cleaner's Required</label>
                        <div class="col-md-4">
                            <label class="col-md-4 control-label nclr"></label>
                        </div>
                 </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Date and Time</label>
                        <div class="col-md-4">
                            <label class="col-md-4 control-label dt"></label>
                        </div>
                 </div>


                 <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-primary f-right" type="submit">Book</button>
                            <button class="btn btn-grey f-right mar_r10 tg" >Back</button>
                        </div>
                 </div>

             </div>    

            <!-- <div class="profile_50"> -->
                    
               
                    
            <!-- </div> -->
            

            <?php echo $this->Form->input('Cleaner.cleaner_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
            echo $this->Form->input('Cleaner.cleaner_lng',array('type' => 'hidden',  'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
            echo $this->Form->end();?>
    </div>
