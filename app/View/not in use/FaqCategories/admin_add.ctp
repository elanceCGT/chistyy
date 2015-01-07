<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight"> 
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                
               
                <div class="ibox-content">
					<?php echo $this->Form->create('FaqCategory', array("class" => "form-horizontal formAdmin col-lg-10",'id' => 'frm_FaqCategory', 'name' => 'frm_cmspage')); ?>

					<div class="form-group <?php echo $this->Form->isFieldError('title') ? "has-error" : "" ;?>">
						<label class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
							<?php
						        
						        echo $this->Form->input('title',array('type' => 'text','placeholder' => 'Title','class'=>'form-control','label' => false,'div' => false,'maxlength' => 35,
						            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
						        ));
						    ?>					    
						</div>
					</div>
					<div class="hr-line-dashed"></div>

					<div class="form-group <?php echo $this->Form->isFieldError('title_jpn') ? "has-error" : "" ;?>">
						<label class="col-sm-2 control-label">Title (Japanese) </label>
						<div class="col-sm-10">
							<?php
						        
						        echo $this->Form->input('title_jpn',array('type' => 'text','placeholder' => 'Title','class'=>'form-control','label' => false,'div' => false,'maxlength' => 35,
						            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
						        ));
						    ?>					    
						</div>
					</div>
					<div class="hr-line-dashed"></div>

					<div class="form-group">
	                    <div class="col-sm-4 col-sm-offset-2">
	                        <button class="btn btn-white" type="reset">Cancel</button>
	                        <button class="btn btn-primary" type="submit">Save</button>
	                    </div>
	                </div>
					 
					<?php echo $this->Form->end(); ?>      
					<div class="clearfix"></div>             
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
