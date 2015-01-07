<?php // echo $this->element('admin/breadcrumb',array('Listings'=>$Listings)); ?>
<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight"> 
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                
               
                <div class="ibox-content">
                    
                    <?php
						echo $this->Form->create('User' ,array("class" => "form-horizontal formAdmin"));
					?>
                        
                        <div class="form-group <?php echo $this->Form->isFieldError('fname') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('fname',array('type' => 'text','placeholder' => 'First Name','class'=>'form-control','label' => false,'div' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));
							    ?>
                                
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('lname') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('lname',array('type' => 'text','placeholder' => 'Last Name','class'=>'form-control','label' => false,'div' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));
							     
                                    //echo "<span class='control-label'>".$this->Form->error('lname')."</span>";
                                 ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('email') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <?php
                                    echo $this->Form->input('email',array('type' => 'text','placeholder' => 'Email','class'=>'form-control','label' => false,'div' => false,

                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))

                                     ));
                                 
                                    //echo "<span class='control-label'>".$this->Form->error('lname')."</span>";

                                 ?>
                            </div>
                        </div>




                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('password',array('type' => 'password', 'value' => '', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));
                                    //echo "<span class='control-label'>".$this->Form->error('password')."</span>";
							    ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('confirm_password',array('type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => false,
                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                        ));

                                    //echo "<span class='control-label'>".$this->Form->error('confirm_password')."</span>";
                                 ?>
                        	</div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="reset">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save changes</button>
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