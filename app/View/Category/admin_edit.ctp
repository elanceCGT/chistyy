<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
        <?/*?><ol class="breadcrumb">
            <li> <a href="index.html">Home</a> </li>
        </ol><?*/?>
    </div>
    <div class="col-lg-2"><a style="margin-top:20px;" href="<?php echo $this->Html->url(array('controller' => 'category', 'action' => 'admin_add')); ?>" class="btn btn-primary control-label pull-right">Add</a></div>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=weather"></script>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">    
                <!-- <div class="formAdmin"> -->                
                <div class="ibox-content">
                    <?php echo $this->Form->create('Category' ,array("class" => "form-horizontal formAdmin")); ?>
						<div class="form-group <?php echo $this->Form->isFieldError('category_name') ? "has-error" : "" ;?>">
                             <label class="col-sm-2 control-label">Category Name</label>
                            		<div class="col-sm-10">
                                	<?php
                                    echo $this->Form->input('category_name',
																				array(
																					'type' => 'text',
																					'placeholder' => 'Category Name',
																					'class'=>'form-control',
																					'label' => false,
																					'div' => false,
                                        	'error' => 
																						array(
																							'attributes' => 
																								array(
																									'wrap' => 'span', 
																									'class' => 'control-label'
																									)
																						)
                                     		)
																		);
                                 ?>
                            </div>
                        </div>
												<!-- area end -->
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" type="submit">Update changes</button>
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
    window.top.location = "<? echo $this->Html->url(array('controller'=>'category','action' => 'admin_index'), true); ?>"
  }	
</script>