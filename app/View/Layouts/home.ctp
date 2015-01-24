<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=0.0" name="viewport" />
<title><?php echo $this->fetch('title'); ?></title>
<?php echo $this->element("css-js"); ?>
<style>.clickbt{cursor:pointer;}</style>
</head>

<body>

<div class="main_container">
	<div class="content">
    	<div class="map_div">
        	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d114487.43121630451!2d73.03054325000001!3d26.27035275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1417479072284" class="homemapimg" frameborder="0" style="border:0">
            </iframe>
    		<div class="home_header"><?php echo $this->element('header_home'); ?></div>
            <div class="rightbox" data-toggle="modal" data-target="#myModal">CREATE YOUR PIN</div>
    	</div>
      	
        <?php  echo $this->fetch('content');?>
    </div>
</div>
<?php echo $this->element('footer'); ?>
</body>
</html>
