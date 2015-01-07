<script type="text/javascript">
	$(document).ready(function() {
		// Signup modal
		$("#signupOpen").click(function() {
			$.ajax({
				url: '<?php echo $this->Html->url(array("controller" => "users", "action" => "signup"), true); ?>',
				type: "GET",
				success: function(data) {
					$("#signin").html(data);
					$("#signin").modal('show');
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
		});

		//Signup cancel button
		$("#signin").on("click", "#signupcancelbutton", function() {
			$("#signin").html("");
			$("#signin").modal('hide');
		});

		//Singup form sumbit
		$("#signin").on("submit", "#SigupForm", function() {
			$(this).ajaxSubmit({
				beforeSubmit: validateSignup,
				success: function(rd) {
					try {
						var resData = $.parseJSON(rd);
						if (resData.status == 0) {
							alert(resData.msg);
						}
					} catch (e) {
						$("#signin").html(rd);
						$("#signin").modal('show');
					}
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
			return false;
		});

		// TODO::
		function validateSignup() {}

		//Login modal 
		$("#loginOpen").click(function() {
			$.ajax({
				url: '<?php echo $this->Html->url(array("controller" => "users", "action" => "login"), true); ?>',
				type: "GET",
				success: function(data) {
					$("#login").html(data);
					$("#login").modal('show');
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
		});

		$("#login").on("submit", "#LoginForm", function() {
			$(this).ajaxSubmit({
				beforeSubmit: validateLogin,
				success: function(rd) {
					try {
						var resData = $.parseJSON(rd);
						if (resData.status == 0) {
							alert(resData.msg);
						} else {
							window.top.location = resData.redirect_uri;
						}
					} catch (e) {
						$("#login").html(rd);
						$("#login").modal('show');
					}
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
			return false;
		});

		//TODO ::
		function validateLogin() {
		}

		//CreatePin button/link
		$(".createPin").click(function() {
			<?php if (!empty($GlobalViewData['UserID'])){ ?>
				createPin();
			<?php } else { ?>
				$("#loginOpen").click();
			<?php } ?>
		});

		//CreatePin Modal
		function createPin(loc) {
			loc = (!loc) ? 1 : loc;
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller' => 'pins', 'action' => 'addpin')) ?>',
				type: "GET",
				data: {loc_type:loc},
				success: function(data) {
					$("#myModal").html(data);
					$("#myModal").modal('show');
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
		}
		
		//Submit pin data
		$("#myModal").on("submit", "#AddPinForm", function() {
			$(this).ajaxSubmit({
				beforeSubmit: validateAddPin,
				success: function(rd) {
					try {
						var resData = $.parseJSON(rd);
						if (resData.status) {
							if (resData.status==1){
								$("#myModal").html("");
								$("#myModal").modal('hide');
							}
							alert(resData.msg);
						}
					} catch (e) {
						$("#myModal").html(rd);
						$("#myModal").modal('show');
					}
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
			return false;
		});

		//TODO::
		function validateAddPin() {}
		
		//change location type 
		$("#myModal").on("change", "#location_type", function(){
			createPin($(this).val());
		});
		
		//Add Product model
		$(".premimum_pad2").on("click", "#addproductOpen", function() {
            var pin_id = $(".premimum_pad2").find("#storeshopid").val();
            
			$.ajax({
				url: '<?php echo $this->Html->url(array("controller" => "products", "action" => "add"), true); ?>',
				type: "GET",
                data: {pin_id:pin_id},
				success: function(data) {
					$("#popup_addproduct").html(data);
					$("#popup_addproduct").modal('show');
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
		});
        
        //Edit Product model
		$(".editproductOpen").click(function() {
            var proId =  $(this).attr('id');
            
            $.ajax({
				url: '<?php echo $this->Html->url(array("controller" => "products", "action" => "add"), true); ?>',
				type: "GET",
                data: {pro_id:proId},
				success: function(data) {
					$("#popup_addproduct").html(data);
					$("#popup_addproduct").modal('show');
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
		});

		//submit form product add
		$("#popup_addproduct").on("submit", "#AddProduct", function() {
			$(this).ajaxSubmit({
				success: function(rd) {
					try {
						var resData = $.parseJSON(rd);
						if (resData.status == 0) {
							alert(resData.msg);
						}else{
                            $("#popup_addproduct").modal('hide');
                            location.reload();
                        }
					} catch (e) {
						$("#popup_addproduct").html(rd);
						$("#popup_addproduct").modal('show');
					}
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
			return false;
		});
		
        //Add Review model
		$(".pinD").on("click","#add-review-btn", function() {
            var shopid = $(".pinD").find("#storeshopid").val();
            
			$.ajax({
				url: '<?php echo $this->Html->url(array("controller" => "reviews", "action" => "add"), true); ?>',
				type: "GET",
                data: {shop_id:shopid},
				success: function(data) {
					$("#popup_add_review").html(data);
					$("#popup_add_review").modal('show');
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
		});
        
        //submit form review add
		$("#popup_add_review").on("submit", "#AddReview", function() {
			$(this).ajaxSubmit({
				success: function(rd) {
					try {
						var resData = $.parseJSON(rd);
						if (resData.status == 0) {
							alert(resData.msg);
						}else{
                            $("#popup_add_review").modal('hide');
                        }
					} catch (e) {
						$("#popup_add_review").html(rd);
						$("#popup_add_review").modal('show');
					}
				},
				error: function(xhr) {
					ajaxErrorCallback(xhr);
				}
			});
			return false;
		});
        
		//click on change password checkbox
		$("#UserChangePassword").change(function() {
			if ($(this).is(":checked")) {
				$("#UserPassword").attr("required", true);
				$("#UserConfirmPassword").attr("required", true);
			} else {
				$("#UserPassword").attr("required", false);
				$("#UserConfirmPassword").attr("required", false);
				$("#UserPassword").val("");
				$("#UserConfirmPassword").val("");
			}
		}); 
		
		$("#myModal").on("click", "#getpre", function(){
			window.location = '<?php echo $this->Html->url(array("controller"=>"otherpages", "action"=>"get_premium")); ?>';
		});
        
         
	});
    
	
	function ajaxErrorCallback(xhr) {
		alert("Opps! something went wrong.");
	}
	
	function getGeoLoc(){
		var geocoder = new google.maps.Geocoder();
		var add = $('#PinAddress').val();
		geocoder.geocode({'address': add}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var major_lat = results[0].geometry.location.lat().toFixed(6);
				var major_lng = results[0].geometry.location.lng().toFixed(6);

				$('#PinLat').val(major_lat);
				$('#PinLong').val(major_lng);
				
			} else {
				if ($.trim(add)) {
					alert("Lat and long cannot be found.");
				}
				$('#PinLat').val('');
				$('#PinLong').val('');
			}
		});
	}
</script>
