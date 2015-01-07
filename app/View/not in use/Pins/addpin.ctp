<div class="modal-dialog pinpopup">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title pintext" id="myModalLabel"><?php echo __('CREATE YOUR PIN'); ?></h4>
		</div>
		<?php
		if ($location_type == '3')
		{
			echo $this->render("_addpin_shop", false);
		}
		elseif ($location_type == '2')
		{
			echo $this->render("_addpin_event", false);
		}
		else
		{
			echo $this->render("_addpin_facility", false);
		}
		?>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$(".inp_datepicker").datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
		});

		$(".inp_time").mask('00:00');

		$("#PinImage").change(function() {
			$(this).closest(".popupbrowsemaindiv").find("#path").text($(this).val());
		});

		$(".pinimage_pre").fileupload({
			url: '<?php echo $this->Html->url(array("controller"=>"pins", "action"=>"pinimageupload")) ?>',
			formData: {},
			add: function(e, data) {
				var ok = true;
				var uploadFile = data.files[0];
				if (!(/(\.|\/)(png|jpg|jpeg)$/i).test(uploadFile.name)) {
					ok = false;
					var topParEle = $(this).closest('.pinpopupinput');
					topParEle.find('.error-message').remove();
					topParEle.append('<div class="error-message">Invalid File type. Allowed types: JPG, JPEG, PNG</div>');
					topParEle.find('#path').text("Upload Image");
				} else {
					$(this).closest('.pinpopupinput').find('.error-message').remove();
				}
				if (ok) {
					data.submit();
				}
			},
			progress: function(e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(this).closest(".pinpopupinput").find(".file-upload-progressbar").css('width', progress + '%');
			},
			done: function(e, data) {
				$(this).closest(".pinpopupinput").find(".file-upload-progressbar").css('width', 0 + '%');
				var topParEle = $(this).closest('.pinpopupinput');
				var rsp = $.parseJSON(data.result);
				if (rsp.status==0){
					alert(rsp.msg);
				} else {
					var i = rsp.data.new, 
					o = rsp.data.org;
					var d = $("#PinUploadedImages").val();
					var iv = (d.length) ? d.split(',') : [];
					iv.push(i);
					$("#PinUploadedImages").val(iv.join(","));
					var ele;
					ele = '<div class="pinpopupinput pre_img_wrap">';
					ele += '<div class="pinpopup2inputimg"><img src="<?php echo $this->webroot; ?>img/popupimg1.png"></div>';
					ele += '<div class="pinpopup2inputext">'+o+'<span class="img_remove" data-img="'+i+'"><img src="<?php echo $this->webroot; ?>img/popupimgcrossimg.png"></span></div>';
					ele +='</div>';
					topParEle.before(ele);
					topParEle.find('#path').text("Upload Image");
					uploadMaxSet(5);
				}
			}
		});
		
		$("#myModal").on("click", ".img_remove", function(){
			var d = $(this).attr('data-img'), imgval, i;
			i = $("#PinUploadedImages").val();
			imgval = ((i.length) ? i.split(',') : []);
			var idx = $.inArray(d, imgval);
			if (idx!=-1){
				imgval.splice(idx, 1);
			}
			$("#PinUploadedImages").val(imgval.join(","));
			$(this).closest(".pre_img_wrap").remove();
			 uploadMaxSet(5);
		});
	});
	function uploadMaxSet(v){
		var d = $("#PinUploadedImages").val(); 
		var i = [];
		if (d.length){
			i = d.split(',');
		}
		if (i.length>=v){
			$("#PinImage").attr("disabled", true);
		} else {
			$("#PinImage").attr("disabled", false);
		}
	}
</script>
<style type="text/css">
	.file-upload-progressbar-wrap{
		float: left;
		width: 100%;
	}
	.file-upload-progressbar{
		float: left;
		width: 0%;
		height: 3px;
		background: #1ab394;
	}
</style>
