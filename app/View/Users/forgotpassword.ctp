
<div class="middle-box text-center loginscreen  animated fadeInDown">
<?php echo $this->Session->flash();?>
    <div>
        <div> <h1 class="logo-name">Chistyy</h1> </div>
        <h3>Welcome to Chistyy.com</h3>                    
        <p>&nbsp</p> 
        <div style="width:40%; margin:0 auto; margin-bottom:70px">       
        <?php	echo $this->Form->create('User',array("class" => "") );	?>
            <div class="form-group">
            	<?php
			        echo $this->Form->input('username',array("error" => array( "class" => "error-message" ),'type' => 'text','required' => true,'placeholder' => 'Email','class'=>'form-control','label' => false,'div' => false,'error' => false));
			     ?>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>

            <a href="<?php echo $this->Html->url(array("controller"=>"users","action" => "login","admin" => true));?>"><!-- <small>Login Form</small> --></a>            
        <?php echo $this->Form->end();	?>
        </div>
    </div>
</div>

 
