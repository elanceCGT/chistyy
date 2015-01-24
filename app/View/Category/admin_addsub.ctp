<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
    </div>
    <div class="col-lg-2">
        
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <?php echo $this->Form->create('Category' ,array("class" => "form-horizontal formAdmin")); ?>
                        <div class="form-group <?php echo $this->Form->isFieldError('category_name') ? "has-error" : "" ;?>">
                            <label class="col-sm-3 control-label">Sub-Category Name</label>
                            <div class="col-sm-9">
                                <?php echo $this->Form->input('category_name', array( 'type' => 'text', 'placeholder' => 'Category Name', 'class'=>'form-control', 'label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>
                            </div>
                        </div>

                        <div class="form-group <?php echo $this->Form->isFieldError('parent_id') ? "has-error" : "" ;?>">
                            <label class="col-sm-3 control-label">Main Category</label>
                            <div class="col-sm-9">
                                <?php echo $this->Form->input('parent_id',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => true,'options' => $parent_id, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
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
function goBack() {
    window.top.location = "<? echo $this->Html->url(array('controller'=>'category','action' => 'admin_index'), true); ?>"
}
</script>