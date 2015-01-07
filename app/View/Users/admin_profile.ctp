<style type="text/css">
	.img_div1 {
		border: 1px solid #CCCCCC;
		border-radius: 3px;
		height: 100px;
		overflow: hidden;
		padding: 2px;
		width: 100px;
	}
</style>
<?php // echo $this->element('admin/breadcrumb',array('Listings'=>$Listings)); ?>



<?php echo $this->element('admin/admin_profile_pic'); ?>

<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight"> 
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                

                <div class="ibox-content">

					<?php
					echo $this->Form->create('User', array("class" => "form-horizontal formAdmin col-lg-10"));
					?>
					<div class="form-group <?php echo $this->Form->isFieldError('password') ? "has-error" : ""; ?>"><label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<?php
							echo $this->Form->input('password', array('type' => 'password', 'value' => '', 'placeholder' => 'Password', 'class' => 'form-control',
								'label' => false, 'div' => false, 'required' => false,
								'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
							));
							?>
						</div>
					</div>
					<div class="hr-line-dashed"></div>

					<div class="form-group <?php echo $this->Form->isFieldError('confirm_password') ? "has-error" : ""; ?>"><label class="col-sm-2 control-label">Confirm Password</label>
						<div class="col-sm-10">
							<?php
							echo $this->Form->input('confirm_password', array('type' => 'password', 'value' => '', 'placeholder' => 'Confirm Password',
								'class' => 'form-control', 'label' => false, 'div' => false, 'required' => false,
								'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))
							));
							?>
						</div>
					</div>
					<div class="hr-line-dashed"></div>

					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" type="reset">Cancel</button>
							<button class="btn btn-primary" type="submit">Save changes</button>
						</div>
					</div>

					<?php
					echo $this->Form->end();
					?>

                    <div class="col-lg-2" >
						<div class="img_div1">
							<?php
							//echo $this->webroot;
							$imgPathSmall = "";
							$imgPathBig = "";
							$userImage = $this->Session->read('Auth.User.image');
							if (!empty($userImage) && ( file_exists(WWW_ROOT . "images/user/big/" . $userImage) ))
							{
								$imgPathBig = $this->webroot . "images/user/big/" . $userImage;
								$imgPathSmall = $this->webroot . "images/user/small/" . $userImage;
							}
							else
							{
								$imgPathBig = $imgPathSmall = $this->webroot . "img/admin/No-Image-Basic.png";
							}
							?>

                            <img src="<?php echo $imgPathBig; ?>" id="UserImages" alt="Responsive image">

						</div>


                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

