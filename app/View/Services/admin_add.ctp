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
                    
                    <?php echo $this->Form->create('Service' ,array("class" => "form-horizontal formAdmin")); ?>
                        
												 <div class="form-group <?php echo $this->Form->isFieldError('service_name') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Service Name</label>
                            <div class="col-sm-10">
                                <?php
                                    echo $this->Form->input('service_name',array('type' => 'text','placeholder' => 'Service Name','class'=>'form-control','label' => false,'div' => false,

                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))

                                     ));
                                 ?>
                            </div>
                        </div>
                        
												<div class="hr-line-dashed"></div>

														<div class="form-group <?php echo $this->Form->isFieldError('category_id') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <?php
                                    echo $this->Form->input('category_id',array('type' => 'select', 'class'=>'form-control', 'label' => false, 'div' => false, 'options' => $category, 'value'=>$catid, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))

                                     ));
                                 ?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('hourly_rate') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Hourly Rate</label>
                            <div class="col-sm-10">
                                <?php
                                    echo $this->Form->input('hourly_rate',array('type' => 'text','placeholder' => 'Hourly Rate','class'=>'form-control','label' => false,'div' => false,

                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))

                                     ));
                                 ?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('minimum_hour') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Minimum Hour</label>
                            <div class="col-sm-10">
                                <?php
                                    echo $this->Form->input('minimum_hour',array('type' => 'text','placeholder' => 'Minimum Hour','class'=>'form-control','label' => false,'div' => false,

                                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))

                                     ));
                                 ?>
                            </div>
                        </div>
                        

                        <div class="hr-line-dashed"></div>

												
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
		window.top.location = "<?php echo $this->Html->url(array('controller'=>'services','action' => 'admin_index'), true); ?>"
	}	
</script>