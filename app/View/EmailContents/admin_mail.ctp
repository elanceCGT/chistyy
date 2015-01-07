<?php // echo $this->element('admin/breadcrumb',array('Listings'=>$Listings)); ?>
<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                
               
                <div class="ibox-content">
                    
                      
					<?php
						echo $this->Form->create("EmailContent", array(
							'autocomplete' => 'off',
							'class'=>'form-horizontal formAdmin',
							'onsubmit'=>'return validate()'
							)
						);
						echo $this->Form->input('id', array('type' => 'hidden'));
					?>
                        
                    <div class="form-group"><label class="col-sm-2 control-label">To</label>
                        <div class="col-sm-10">
                        	 

						    <?php
								echo $this->Form->input('to', array(
										'type' => 'text',
										'placeholder' => 'To address',
										'id' => 'mailIds',
										'class' => 'form-control',
										'label' => false,
									)
								);
							?>

                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                    <div class="form-group"><label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                        	 

						    <?php
								echo $this->Form->input('subject', array(
										'type' => 'text',
										'required' => true,
										'placeholder' => 'Subject',
										'class' => 'form-control',
										'label' => false,
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
										'placeholder' => 'Email Body',
										'rows' => '6',
										'cols' => '120',
										'label' => false,
										'required' => false
									)
								);
								echo $this->Form->error('content');
							?>

                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                    

                    
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" onclick="window.location='<?php echo $this->Html->url(array('admin'=>true,'controller'=>'users','action'=>'list')); ?>'" type="button">Back</button>
                            <button class="btn btn-primary" type="submit">Send</button>
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
$(function(){
	//$( 'textarea#EmailContentContent' ).ckeditor( {filebrowserUploadUrl:"<?php echo $this->Html->url(array('action'=>'ckupload')) ?>"} );
	$( 'textarea#EmailContentContent' ).ckeditor(  );
	
        //bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

	$('#mailIds').tagsinput();
	
	<?php if(isset($user_email) && !empty($user_email)){ ?>
			$('#mailIds').tagsinput('add', '<?php echo $user_email; ?>');
	<?php } ?>
});

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

function validate()
{
    $(".error-message").remove();
     
    if($("#EmailContentSubject").val().trim() == ""){
        $("#EmailContentSubject").parent().append('<div class="error-message">Subject is required.</div>');
		return false;
    }
    
	description	=	'EmailContentContent';
	if(validateCKEDITORforBlank($.trim(CKEDITOR.instances.EmailContentContent.getData().replace(/<[^>]*>|\s/g, ''))))
	{
		$("#"+description).parent().append('<div class="error-message">This field is required.</div>');
		//CKEDITOR.instances.description.setData("");
		return false;
	}
     

    /*var nicE = new nicEditors.findEditor('EmailContentContent');
    var dataInEditor    =   nicE.getContent();*/

    if($("#EmailContentSubject").val().trim() == ""){
        $("#EmailContentSubject").parent().append('<div class="error-message">Subject is required.</div>');
		return false;
    }
    
    description	=	'EmailContentContent';
    if(validateCKEDITORforBlank($.trim(dataInEditor.replace(/<[^>]*>|\s/g, ''))))
    {
            $("#"+description).parent().append('<div class="error-message">This field is required.</div>');
            nicE.setContent("");
            return false;
    }
    return true;
}
</script>