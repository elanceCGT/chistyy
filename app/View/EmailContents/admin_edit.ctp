<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                
               
                <div class="ibox-content">
                    
                     
					<?php
						echo $this->Form->create("EmailContent", array(
							'action' => 'admin_edit',
							'autocomplete' => 'off',
							'class'=>'form-horizontal formAdmin',
							'onsubmit'=>'return validate("content")'
							)
						);
						echo $this->Form->input('id', array('type' => 'hidden'));
					?>
                        
                        <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('title', array(
										'type' => 'text',
										'required' => true,
										'placeholder' => 'Title',
										'class' => 'form-control',
										'label' => false,
										)
									);
							    ?>

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                            	<?php
							        echo $this->Form->input('title', array(
										'type' => 'text',
										'required' => true,
										'placeholder' => 'Title',
										'class' => 'form-control',
										'label' => false,
										)
									);
							    ?>

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Keywords</label>
                            <div class="col-sm-10">
                            	 
							    <?php
									echo $this->Form->input('keywords', array(
										'type' => 'text',
										'required' => true,
										'placeholder' => 'Title',
										'class' => 'form-control',
										'label' => false,
                                        'readonly' => true,
										)
									);
									?>

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Body</label>
                            <div class="col-sm-10">
                            	 
							    <?php
									echo $this->Form->input('content', array(
										'type' => 'textarea',
										'required' => true,
										'placeholder' => 'Email Body',
										'rows' => '6',
										'cols' => '120',
										'label' => false
										)
									);
								?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="button" onclick="window.location='<?php echo $this->Html->url(array('admin'=>true,'controller'=>'email_contents','action'=>'index')); ?>'" type="buton">Back</button>
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


<script type="text/javascript">
$( document ).ready( function() {
		$( 'textarea#EmailContentContent' ).ckeditor();
       // bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
} );


function validateCKEDITORforBlank(field)
{
	var vArray = new Array();
	vArray = field.split("&nbsp;");
	var vFlag = 0;
	for(var i=0;i<vArray.length;i++)
	{
		if(vArray[i] == '' || vArray[i] == "")
		{
			continue;
		}
		else
		{
			vFlag = 1;
			break;
		}
	}
	if(vFlag == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}	

function validate(description)
{

	$(".error-message").remove();
    /*
    if(trim($("#EmailContentContent").val()) == ""){
        $("#EmailContentContent").parent().append('<div class="error-message">Subject is required.</div>');
		return false;
    }   */

	if(validateCKEDITORforBlank($.trim(CKEDITOR.instances.EmailContentContent.getData().replace(/<[^>]*>|\s/g, ''))))
	{
		$("#"+description).parent().append('<div class="error-message">This field is required.</div>');
		CKEDITOR.instances.EmailContentContent.setData("");
		return false;
	}
	return true;
     

}
</script>