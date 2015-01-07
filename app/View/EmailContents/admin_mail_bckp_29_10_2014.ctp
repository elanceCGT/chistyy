<section id="formElement" class="utopia-widget utopia-form-box section">
	<div id="admin_body">
		<div id="admin_inner_flp">
			<div class="utopia-widget-title">
				<span>Compose Mail</span>
			</div>

			<div id="box_bg" class="row-fluid" style="display:block;">
				<div id="content_admin" class="admin_content_block">
					<?php
						echo $this->Form->create("EmailContent", array(
							'autocomplete' => 'off',
							'class'=>'form-horizontal',
							'onsubmit'=>'return validate()'
							)
						);
						echo $this->Form->input('id', array('type' => 'hidden'));
					?>
				
					<div class="control-group">
					<label class="control-label">To</label>
					<?php
					echo $this->Form->input('to', array(
							'type' => 'text',
							'placeholder' => 'To address',
							'id' => 'mailIds',
							'class' => 'control',
							'label' => false,
						)
					);
					?>
					</div>
					
					<div class="control-group">
					<label class="control-label">Subject</label>
					<?php
					echo $this->Form->input('subject', array(
							'type' => 'text',
							'required' => true,
							'placeholder' => 'Subject',
							'class' => 'control',
							'label' => false,
						)
					);
					?>
					</div>
					
					<div class="control-group">
					<label class="control-label">Body</label>
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
					
					<div class="control-group">
					<label class="control-label"></label>
					<?php
					echo $this->Form->submit("SEND", array(
						'label' => false,
						'class' => 'btn btn-primary',
						'div'=>false,
						'onclick'=>'return validate()'
						)
					);
					?>
					<a href="<?php echo $this->Html->url(array('admin'=>TRUE,'controller'=>'users','action'=>'list')); ?>" class="btn">Back</a>
						
					</div>
					<?php
					echo $this->Form->end();
					?>
				</div>
				
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
$(function(){
	$( 'textarea#EmailContentContent' ).ckeditor( {filebrowserUploadUrl:"<?php echo $this->Html->url(array('action'=>'ckupload')) ?>"} );
	
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
	return true;
}
</script>