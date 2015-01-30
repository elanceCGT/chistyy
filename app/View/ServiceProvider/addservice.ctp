<style type="text/css">
.hr-line-dashed {
    background-color: #FFFFFF;
    border-top: 1px dashed #E7EAEC;
    color: #FFFFFF;
    height: 1px;
    margin: 20px 0;
}
.ui-datepicker { z-index:999 !important; }
</style>
<div class="fullwidth">
    <?php echo $this->Form->create('ServiceProviderService' ,array("class" => "form-horizontal formAdmin", 'type' => 'file')); ?>

        <div class="profile_50">

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
                    <?php echo $this->Form->input('servic_subcat_cd',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => true, 'onchange'=>'servicelist();', 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
                </div>
            </div>

            <div class="form-group <?php echo $this->Form->isFieldError('servic_cd') ? "has-error" : "" ;?>">
                <label class="col-md-2 control-label">Service</label>
                <div class="col-md-4">
                    <?php echo $this->Form->input('servic_cd',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) ));?>
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
                    <button class="btn btn-primary mar_r10" type="submit">Save</button>
                    <button class="btn btn-grey" type="reset" onclick="goBack();">Cancel</button>
                </div>
            </div>
        </div>
    <?php echo $this->Form->end();?>
</div>

<script type="text/javascript">
function subcategorylist(){
    URL = '<?php echo $this->Html->url(array("controller" => "Cleaner","action" => "subcatselectbox"));?>';
    var ServiceCategoryId = $("#ServiceProviderServiceServicCatCd").val();
    $.ajax({
        url : URL,
        type: "POST",
        data : ({ maincatid:ServiceCategoryId }),
        beforeSend: function (XMLHttpRequest) {
            
        },
        complete: function (XMLHttpRequest, textStatus) {
            
        },
        success : function(data){
            $("#ServiceProviderServiceServicSubcatCd").html(data);
            servicelist();
        }
    });
}
function servicelist(){
    URL = '<?php echo $this->Html->url(array("controller" => "Cleaner","action" => "serviceselectbox"));?>';
    var ServiceCategoryId = $("#ServiceProviderServiceServicCatCd").val();
    var ServiceSubCategoryId = $("#ServiceProviderServiceServicSubcatCd").val();
    $.ajax({
        url : URL,
        type: "POST",
        data : ({ maincatid:ServiceCategoryId, subcatid:ServiceSubCategoryId }),
        beforeSend: function (XMLHttpRequest) {
            
        },
        complete: function (XMLHttpRequest, textStatus) {
            
        },
        success : function(data){
            $("#ServiceProviderServiceServicCd").html(data);
        }
    });
}
$(document).ready(function() {
    subcategorylist();
});
</script>