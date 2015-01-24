<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
        <?/*?><ol class="breadcrumb">
            <li> <a href="index.html">Home</a> </li>
        </ol><?*/?>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <?php echo $this->Form->create('Service' ,array("class" => "form-horizontal formAdmin")); ?>

						<div class="form-group <?php echo $this->Form->isFieldError('service_name') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Service Name</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('service_name',array('type' => 'text','placeholder' => 'Service Name','class'=>'form-control','label' => false,'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                            </div>
                        </div>
                        
						<div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('service_name') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Service Description</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('servic_description',array('type' => 'text','placeholder' => 'Service Description','class'=>'form-control','label' => false,'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('category_id') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Main Category</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('category_id',array('type' => 'select', 'class'=>'form-control', 'label' => false, 'div' => false, 'options' => $category, 'required'=>true, 'onchange'=>'subcategorylist();', 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('sub_category_id') ? "has-error" : "" ;?>">
                            <label class="col-sm-2 control-label">Sub Category</label>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('sub_category_id',array('type' => 'select', 'class'=>'form-control', 'label' => false, 'div' => false, 'required'=>true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
						
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                                <button class="btn btn-white" type="reset" onclick="goBack();">Cancel</button>
                            </div>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function subcategorylist(){
        URL = '<?php echo $this->Html->url(array("controller" => "services","action" => "admin_subcatselectbox"));?>';
        var ServiceCategoryId = $("#ServiceCategoryId").val();
        $.ajax({
            url : URL,
            type: "POST",
            data : ({ maincatid:ServiceCategoryId }),
            beforeSend: function (XMLHttpRequest) {
                
            },
            complete: function (XMLHttpRequest, textStatus) {
                
            },
            success : function(data){
                $("#ServiceSubCategoryId").html(data);
            }
        });
    }
    $(document).ready(function() {
        subcategorylist();
    });
</script>