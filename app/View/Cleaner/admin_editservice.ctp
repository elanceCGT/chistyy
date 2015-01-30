<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php //prd($this->request->data); 
        echo $title_for_layout;?></h2>
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

                <div class="ibox-content">
                    
                    <?php echo $this->Form->create('CleanerService' ,array("class" => "form-horizontal formAdmin", 'type' => 'file')); ?>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group <?php echo $this->Form->isFieldError('servic_cat_cd') ? "has-error" : "" ;?>">
                            <label class="col-md-2 control-label">Main Category</label>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('servic_cat_cd',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => true,'options' => $servic_cat_cd, 'onchange'=>'subcategorylist();', 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>

                        <div class="form-group <?php echo $this->Form->isFieldError('servic_subcat_cd') ? "has-error" : "" ;?>">
                            <label class="col-md-2 control-label">Sub Category</label>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('servic_subcat_cd',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => true,'options' => $servic_subcat_cd, 'onchange'=>'servicelist();', 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>

                        <div class="form-group <?php echo $this->Form->isFieldError('servic_cd') ? "has-error" : "" ;?>">
                            <label class="col-md-2 control-label">Service</label>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('servic_cd',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => true,'options' => $servic_cd, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                                                    
                        <div class="form-group <?php echo $this->Form->isFieldError('unit_cost') ? "has-error" : "" ;?>">
                            <label class="col-md-2 control-label">Unit Cost</label>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('unit_cost',array('type' => 'text',  'placeholder' => 'Per hour per person that charge to us','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                            </div>
                        </div>
                                                    
                        <div class="form-group <?php echo $this->Form->isFieldError('unit_price') ? "has-error" : "" ;?>">
                            <label class="col-md-2 control-label">Unit Price</label>
                            <div class="col-md-4">
                                <?php echo $this->Form->input('unit_price',array('type' => 'text',  'placeholder' => 'Per hour per person that bill to our customers','class'=>'form-control','label' => false,'div' => false,'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                                <button class="btn btn-white" type="reset" onclick="goBack();">Cancel</button>
                            </div>
                        </div>

                    <?php echo $this->Form->end();?>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function goBack() {
    window.top.location = "<?php echo $this->Html->url(array('controller'=>'serviceprovider','action' => 'admin_index'), true); ?>"
}
function subcategorylist(){
    URL = '<?php echo $this->Html->url(array("controller" => "serviceprovider","action" => "admin_subcatselectbox"));?>';
    var ServiceCategoryId = $("#CleanerServiceServicCatCd").val();
    $.ajax({
        url : URL,
        type: "POST",
        data : ({ maincatid:ServiceCategoryId }),
        beforeSend: function (XMLHttpRequest) {
            
        },
        complete: function (XMLHttpRequest, textStatus) {
            
        },
        success : function(data){
            $("#CleanerServiceServicSubcatCd").html(data);
            servicelist();
        }
    });
}
function servicelist(){
    URL = '<?php echo $this->Html->url(array("controller" => "serviceprovider","action" => "admin_serviceselectbox"));?>';
    var ServiceCategoryId = $("#CleanerServiceServicCatCd").val();
    var ServiceSubCategoryId = $("#CleanerServiceServicSubcatCd").val();
    $.ajax({
        url : URL,
        type: "POST",
        data : ({ maincatid:ServiceCategoryId, subcatid:ServiceSubCategoryId }),
        beforeSend: function (XMLHttpRequest) {
            
        },
        complete: function (XMLHttpRequest, textStatus) {
            
        },
        success : function(data){
            $("#CleanerServiceServicCd").html(data);
        }
    });
}
$(document).ready(function() {
    //subcategorylist();
});
</script>