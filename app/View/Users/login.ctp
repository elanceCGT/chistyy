<div class="head_title">
	<div class="container">
    	<div class="htcf_title">
        	<div class="ht_line"></div>
            <div class="ht_name">User Login</div>
            <div class="ht_line"></div>
        </div>
    </div>
</div>
<div class="inner_bg_color">
<?php echo $this->Session->flash();?>
        <div class="container">
            <div class="fullwidth">
                <div class="fullwidth login_top_text">
                    Sed molestie ultricies risus, ut vulputate elit vehicula eget. Nunc est mauris, pulvinar nec sem vitae, laoreet eleifend nisi. Fusce commodo tempus massa vel tempus. Cras id felis eu sapien fringilla gravida. Sed id enim vitae urna sodales viverra in at tellus.
                </div>
                <div class="fullwidth">
                    <div class="form_480">
                        <div class="fullwidth">
                            <?php echo $this->Form->create('User',array("class" => "m-t") ); ?>
                                
                                <div class="form-group sm79right">
                                	<div class="l_label">User Name</div>
                                    <?php echo $this->Form->input('username',array('type' => 'email','required' => true,'placeholder' => 'Username','class'=>'form-control','label' => false,'div' => false,'error' => false)); ?>
                                </div>
                                
                                <div class="form-group sm79right">
                                	<div class="l_label">Password</div>
                                     <?php echo $this->Form->input('password',array('type' => 'password', 'required' => true, 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false)); ?>
                                </div>
                                <div class="form-group sm79right kmsi">
                                	<div class="l_label">&nbsp;</div>
                                     <?php echo $this->Form->input('keep me signed in',array('type' => 'checkbox', 'required' => false, 'placeholder' => '','class'=>'form-control','label' => false,'div' => false)); ?> keep me signed in                                </div>
                                <div class="form-group sm79right">
                                    
                                        <button type="submit" class="btn btn-primary block full-width m-b f-right">Login</button>
                    				<span class="forget_p">
                                    	Forgot Password
                                        <a href="<?php echo $this->Html->url(array("controller"=>"users","action" => "forgotpassword","admin" => false));?>">Click here</a>
                                    </span>
                                </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
