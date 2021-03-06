<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight"> 
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                
               
                <div class="ibox-content">

                	<div class="pull-right">
	                	<input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $this->Html->url(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index', $cat_id)); ?>'" value="Back">
	                	&nbsp;&nbsp;&nbsp; 
	                </div>	
					<?php echo $this->Form->create('Faq', array("class" => "form-horizontal formAdmin col-lg-10",'id' => 'frm_FaqCategory', 'name' => 'frm_faqpage')); ?>

					<div class="form-group <?php echo $this->Form->isFieldError('title') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                        	<?php
						        echo $this->Form->input('title',array('type' => 'text','placeholder' => 'Title','class'=>'form-control','label' => false,'div' => false,'maxlength' => 120, 'required' => true,
                                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                    ));
						    ?>
                            
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group <?php echo $this->Form->isFieldError('title_jpn') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Title JPN</label>
                        <div class="col-sm-10">
                            <?php
                                echo $this->Form->input('title_jpn',array('type' => 'text','placeholder' => 'Title','class'=>'form-control','label' => false,'div' => false,'maxlength' => 120, 'required' => true,
                                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                    ));
                            ?>
                            
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                    <div class="form-group <?php echo $this->Form->isFieldError('content') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Content</label>
                        <div class="col-sm-10">
                        	<?php
						        echo $this->Form->input('content',array('type' => 'textarea','placeholder' => 'Title','class'=>'form-control','label' => false,'div' => false,'maxlength' => 120, 'required' => false,
                                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                    ));
						    ?>
                            
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group <?php echo $this->Form->isFieldError('content_jpn') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Content (Japanese) </label>
                        <div class="col-sm-10">
                            <?php
                                echo $this->Form->input('content_jpn',array('type' => 'textarea','placeholder' => 'Title','class'=>'form-control','label' => false,'div' => false,'maxlength' => 120, 'required' => false,
                                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
                                    ));
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

					 

					<?php echo $this->Form->end(); ?>

					<div class="clearfix"></div>
				</div>





			</div>
		</div>
	</div>
</div>

<div style="clear:both"></div>
<script type="text/javascript">
//$("#pages").addClass("active");	
//$("#faq").addClass("sub_activ a");
//var editor = CKEDITOR.replace('FaqContent', {height: 180, width: 700, toolbar: 'MyToolbar'});

$( document ).ready( function() {
	$( 'textarea#FaqContent, textarea#FaqContentJpn' ).ckeditor();
} );
</script>

