<div class="fullwidth">
    <div class="center530">
        <?php echo $this->Form->create('User', array("class" => "form-horizontal formAdmin")); ?>
    
            <div class="form-group <?php echo $this->Form->isFieldError('User.password') ? "has-error" : "" ;?>">
                <label class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('User.password',array('type' => 'password', 'value' => '', 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                </div>
            </div>
    
            <div class="hr-line-dashed"></div>
    
            <div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : "" ;?>"><label class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('confirm_password',array('type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password','class'=>'form-control','label' => false,'div' => false,'required' => true, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
                </div>
            </div>
    
            <div class="form_lastrow">
                <div class="f-right">
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    <button class="btn btn-primary" type="reset">Cancel</button>
                </div>
            </div>
    
        <?php echo $this->Form->end(); ?>
    </div>
</div>