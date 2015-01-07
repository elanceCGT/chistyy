<?php
$cakeDescription = __d('cake_dev', __(SITE_NAME));
?>
<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo 'Chistyy ';//$cakeDescription ?>:
			<?php echo $this->fetch('title'); ?>        
		</title>

		<?php
		echo $this->Html->css(
			array('admin/bootstrap.min.css',
				'admin/bootstrap-tagsinput',
				'admin/font-awesome.css',
				'admin/admin_include_css.css',
				'admin/animate.css',
				'admin/main_style.css',
				'admin/jqGrid/ui.jqgrid',
				'admin/jquery-ui'
			)
		);

		echo $this->Html->script(
			array('admin/jquery-1.10.2',
				'admin/bootstrap.min',
				'admin/jquery.metisMenu',
				'admin/jquery.slimscroll.min',
				'admin/inspinia',
				'admin/pace.min',
				'admin/jquery-ui/js/jquery-ui-1.10.4',
				'admin/ckeditor/ckeditor',
				'admin/ckeditor/adapters/jquery',
				'admin/jqGrid/i18n/grid.locale-en',
				'admin/jqGrid/jquery.jqGrid.min',
				'admin/jqGrid/jquery.jqGrid.min',
				'admin/taginput/bootstrap-tagsinput.min',
				'admin/bootbox.min',
                'admin/browser_issue',
			)
		);

		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
	</head>
	<?php
	$currUserId = $this->Session->read('Auth.User.id');
	$currType = $this->Session->read('Auth.User.user_type');

	//if(isset($currUserId) && !empty($currUserId) && $currType=='0'){ 
	if (isset($currUserId) && isset($currType) && in_array($currType, array('0')))
	{
		?>
		<body>
			<div id="container">

				<div id="wrapper">
					<?php echo $this->element('admin/sidemenu'); ?>

					<div id="page-wrapper" class="gray-bg">
						<?php echo $this->element('admin/header'); ?>                    

						<?php //echo $this->element('admin/breadcrumb', array('Listings' => $Listings)); ?>

						<?php echo $this->Session->flash(); ?>
						<?php echo $this->fetch('content'); ?>

						<?php echo $this->element('admin/footer'); ?>
					</div>

				</div>


			</div>
			<?php //echo $this->element('sql_dump'); ?>
		</body>
		<?php
	}
	elseif (!isset($currUserId) || empty($currUserId))
	{
		?>
		<body class="gray-bg">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>            
			<?php //echo $this->element('sql_dump');  ?>
		</body>
	<?php } ?>
</html>
