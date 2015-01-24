<!--/*------------------- CSS -------------------*/-->
<!--/*ui-css*/-->
<?php
echo $this->Html->css(
	array(
		'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800',
		'screenui',
		'component',
		'jquery.selectbox',
		'smk-accordion',
		'nanoscroller',
		'tinycarousel',
		'main',
		'bootstrap.min',
		'datepicker',
		'bootstrap-datetimepicker.min',
        'jRating.jquery',
		'mycustom',
		'admin/jquery-ui',
		
    )
);
?>
<!--/*------------------- CSS-ENDS -------------------*/-->
<!--/*------------------- JS -------------------*/-->
<!--/*main-js*/-->
<?php
echo $this->Html->script(
	array(
		'jquery-1.7.2.min',
		'jquery.selectbox-0.2',
		'smk-accordion',
		'jquery.nanoscroller',
		//'main',
		'jquery.tinycarousel',
		'modernizr.custom',
		'jquery.dlmenu',
		'jquery.form',
		'bootstrap.min',
		'bootstrap-datepicker',
		'bootstrap-datetimepicker.min',
		'jquery.mask.min',
		'admin/jquery-ui/js/jquery-ui-1.10.4',
		'jQueryFileUpload/vendor/jquery.ui.widget',
		'jQueryFileUpload/jquery.fileupload',
		'jQueryFileUpload/jquery.iframe-transport',
        'jquery.tubular.1.0',
        'admin/bootbox.min',
        'jRating.jquery'
	)
);

echo $this->fetch('css');
echo $this->fetch('script');
?>

<?php /*?><script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script><?php */?>

<script type="text/javascript">
	$(function() {
		//$(".mod_select_box").selectbox();
		//$(".LOCATIONbutten").selectbox();
	});
	
	//document.getElementById("browseimg2").addEventListener("change", function() {
	//    
	//    console.log("change", document.getElementById("browseimg2").files[0].name)  
	//   
	//	var value = document.getElementById("browseimg2").files[0].name;
	//	//alert(value);
	//	$('#path').html(value);
	//	});	
</script>

<script type="text/javascript">
	$(document).ready(function() {
		//$(".accordion_example1").smk_Accordion({closeAble: true});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		//$('#slider1').tinycarousel();
	});
</script>
<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});
	</script>

<!--/*------------------- JS-ENDS -------------------*/-->

<style>
	.clickbt{
		cursor: pointer;
	}
</style>