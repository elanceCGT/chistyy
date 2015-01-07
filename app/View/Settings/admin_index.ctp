<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                

                <div class="ibox-content">
                    <?php echo $this->Form->create("Setting", array(
                        "autocomplete" => "off", 
                        'class' => 'form-horizontal formAdmin',
                        'enctype' => 'multipart/form-data'
                        )); ?>


                    <?php
                    $i = 0;
                    while (isset($record[$i])) {
                        ?>

                        <div class="form-group "><label class="col-sm-2 control-label"><?php echo $record[$i]['Setting']['label']; ?></label>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input($record[$i]['Setting']['unique_name'], array(
                                    "label" => false,
                                    "class" => 'form-control',
                                    "required" => true,
                                    "value" => $record[$i]['Setting']['value']
                                ));
                                ?>

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <?php
                        $i++;
                    }
                    ?>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?php echo $this->Form->button(__("Save"), array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
                            <?php echo $this->Form->button(__("Cancel"), array('type' => 'button', 'class' => 'btn btn-white', 'onclick' => 'goBack();')); ?>
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
        window.top.location = "<? echo $this->Html->url(array('controller'=>'index','action' => 'admin_index'), true); ?>"
    }
</script>