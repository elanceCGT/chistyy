<div class="aboutusmain">
    <?php /*?>
    <div class="aboutusmain_top">
        <div class="container">
            <div class="col-md-12 aboutusmain_top_title"><?php echo $title_for_layout; ?></div>
        </div> 
    </div>
    <?php */?>
    <div class="faqbuttom">
        <div class="container">
            <div class="middle-box text-center loginscreen  animated fadeInDown">
                <div>
                    <div>
                        <h1 class="logo-name">
                            <?/*?>Booking<?*/?>
                            <img alt="image" id="profileImgSmall" class="" src="<?php echo $this->webroot."/img/logo_img.png"; ?>" />
                        </h1>
                    </div>

                    <h3>Welcome to Booking</h3>                    
                    <p>&nbsp</p> 

                    <?php echo $this->Form->create('User',array("class" => "m-t") ); ?>
                        
                        <div class="form-group">
                            <?php echo $this->Form->input('username',array('type' => 'email','required' => true,'placeholder' => 'Username','class'=>'form-control','label' => false,'div' => false,'error' => false)); ?>
                        </div>
                        
                        <div class="form-group">
                             <?php echo $this->Form->input('password',array('type' => 'password', 'required' => true, 'placeholder' => 'Password','class'=>'form-control','label' => false,'div' => false)); ?>
                        </div>
                        
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <a href="<?php echo $this->Html->url(array("controller"=>"users","action" => "forgot","admin" => false));?>">
                            <small>Forgot password?</small>
                        </a>

                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>