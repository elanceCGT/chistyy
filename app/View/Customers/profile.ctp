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
            yearRange: "1970:-15",
        });

       
    });



    
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script>
<div class="fullwidth">
        <?php echo $this->Form->create('User' ,array("class" => "form-horizontal formAdmin", 'type' => 'file')); ?>
        <?php echo $this->Form->input('Customer.id', array('hiddenField' => true)); ?> 
            <div class="profile_100">
                <div class="subb_title" style="margin-bottom:30px;"> Profile</div>
                <div class="form-group <?php echo $this->Form->isFieldError('User.username') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">Username</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('User.username',array('type' => 'text','placeholder' => 'Username','class'=>'form-control','label' => false,'readonly' => true,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                </div>

                <div class="form-group <?php //echo $this->Form->isFieldError('Customer.customer_name') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">First Name</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Customer.customer_name',array('type' => 'text',  'placeholder' => 'First Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>

                <div class="form-group <?php //echo $this->Form->isFieldError('Customer.customer_name') ? "has-error" : "" ;?>">
                    <label class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Customer.customer_lname',array('type' => 'text',  'placeholder' => 'Last Name','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>                    
                </div>
                
                
                <div class="form-group modfld">
                    <label class="col-md-2 control-label">Gender</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Customer.customer_gender',array('type' => 'radio','class'=>'','label' => false,'div' => false,'required' => true,'options' => array('0' => '<label class="" > Male </label>', '1' => '<label class="" > Female </label>'),'before' => '', 'after' => '', 'between' => '', 'separator' => '<label class="" >&nbsp;&nbsp;&nbsp;</label>','legend' => false, 'fieldset' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                    </div>
                </div>

                <div class="form-group <?php echo $this->Form->isFieldError('Customer.customer_dateofbirth') ? "has-error" : "" ;?>">
                                <label class="col-md-2 control-label">Date Of Birth</label>
                                <div class="col-md-4">
                                <?php echo $this->Form->input('Customer.customer_dateofbirth',array( 'readonly' => true, 'type' => 'text',  'placeholder' => '', 'class'=>'form-control', 'label' => false, 'div' => false, 'required' => false,'value'=>date("m/d/Y",strtotime($this->request->data['Customer']['customer_dateofbirth'])), 'error' => array('attributes' => array( 'wrap' => 'span', 'class' => 'control-label' )))); ?>
                                </div>
                            </div>   
    
                <!-- <div class="form-group <?php echo $this->Form->isFieldError('User.password') ? "has-error" : "" ;?>">
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
                </div> -->
                

                 <div class="subb_title" style="margin-bottom:30px;"> Address</div>
                 <div class="form-group">
                    <label class="col-md-2 control-label">Street Address</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Customer.customer_address',array('type' => 'text',  'placeholder' => 'Address','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Province</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Customer.customer_proviencs',array('type' => 'text',  'placeholder' => 'Province','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                 </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">State</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Customer.customer_state',array('type' => 'text',  'placeholder' => 'State','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Country</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Customer.customer_country',array('type' => 'text',  'placeholder' => 'Country','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">FSA</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Customer.customer_fsa',array('type' => 'text',  'placeholder' => 'FSA','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Postal Code</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->input('Customer.customer_zip_code',array('type' => 'text',  'placeholder' => 'Postal Code','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                        </div>
                 </div>

                 <div class="subb_title" style="margin-bottom:30px;"> Contact Info</div>
                 <div class="form-group">
                    <label class="col-md-2 control-label">Phone No.</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Customer.customer_phone_no',array('type' => 'text',  'placeholder' => 'Phone No.','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Mobile No.</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Customer.customer_mobile_no',array('type' => 'text',  'placeholder' => 'Mobile No.','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                 </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Home Area Code</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('Customer.customer_areacd_no',array('type' => 'text',  'placeholder' => 'Home Area Code','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                    </div>
                 </div>

                 <div class="form-group">
                    <?php echo $this->Form->checkbox('Customer.customer_promotion_by_web', array('hiddenField' => false,'style'=>'float:left'));?>
                    <div style="float:left;margin-left:10px;">Click here if you ant to recieve promotion mail from our site.</div>
                 </div>
                 <div class="form-group">
                    <?php echo $this->Form->checkbox('Customer.customer_promotion_by_email', array('hiddenField' => false,'style'=>'float:left'));?>
                    <div style="float:left; margin-left:10px;">Click here if you ant to recieve promotion mail by email from our site.</div>
                 </div>

       
                
                
                                      
            </div>

            <!-- <div class="profile_50"> -->
                    
               
                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-primary f-right" type="submit">Save changes</button>
                            <button class="btn btn-grey f-right mar_r10" type="reset" onclick="goBack();">Cancel</button>
                        </div>
                    </div>
            <!-- </div> -->
            

            <?php echo $this->Form->input('Cleaner.cleaner_lat',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
            echo $this->Form->input('Cleaner.cleaner_lng',array('type' => 'hidden',  'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
            echo $this->Form->end();?>
    </div>
