<?php $cakeDescription = __d('cake_dev', __(SITE_NAME)); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta content="width=device-width, initial-scale=0.0" name="viewport" />
		<title><?php echo $cakeDescription ?> : <?php echo __($title_for_layout); ?></title>
		<?php echo $this->element('css-js'); ?>
	</head>
	<body>
		<?php 
			if ($GlobalViewData['Controller']=='index' && $GlobalViewData['Action']=='index') {
				//the header element will called from the index view file
			} else {
				echo $this->element('header'); 
			}
		?>	
		<div class="main_container">
			<?php echo $this->fetch('content'); ?>
		</div>
		<?php //echo $this->element('footer'); ?>	
	</body>
</html>