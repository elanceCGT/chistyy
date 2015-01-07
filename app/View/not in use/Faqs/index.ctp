<div class="aboutusmain">
    <div class="aboutusmain_top">
        <div class="container">
            <div class="col-md-12 aboutusmain_top_title">FAQ's</div>
        </div>
    </div>
    <div class="faqbuttom">
        <div class="container">
            <div class="col-md-8 col-sm-7 col-xs-12 faqbuttom_left premimum_pad" >
				<?php
//prd($FaqList);
				foreach ($FaqList as $k => $v)
				{
					?>
					<div class="accordion_example1 " style="display:none"   id="faqCData_<?php echo $v["FaqCategory"]["id"]; ?>">
						<?php
						foreach ($v["Faq"] as $ks => $vs)
						{
							//pr($ks);
							//pr($vs);
							?>
							<!-- Section 1 -->
							<div class="accordion_in" id="<?php echo $vs["id"]; ?>">
								<div class="acc_head"><?php echo $vs[langField("title")]; ?></div>
								<div class="acc_content"> 

									<?php /* <div class="faqtabtextdiv">Etiam in fringilla dolor, eu varius nunc. Donec ac ipsum ac elit malesuada commodo condimentum quis nulla. Nam eget augue leo. Mauris felis orci, sollicitudin a lacus porta, aliquam ornare tellus. Nam felis nibh, tempor eget velit in, bibendum pellentesque libero. Nulla molestie dolor ac est posuere malesuada.</div>
									  <div class="faqtabtextdiv">Etiam in fringilla dolor, eu varius nunc. Donec ac ipsum ac elit malesuada commodo condimentum quis nulla. Nam eget augue leo. Mauris felis orci, sollicitudin a lacus porta, aliquam ornare tellus. Nam felis nibh, tempor eget velit in, bibendum pellentesque libero. Nulla molestie dolor ac est posuere malesuada.</div>
									 */ ?>

									<div class="faqtabtextdiv bordernone"><?php echo $vs[langField("content")]; ?></div>
								</div>
							</div>
							<?php
						}
						?>

					</div>    
					<?php
				}
				?>






            </div>
            <div class="col-md-4 col-sm-5 col-xs-12 faqbuttom_right premimum_pad2">
                <div class="faqbuttom_righttitle">Subjects</div>

                <div class="faqbuttom_rightmenu">
                    <ul id="faqCatDiv">
						<?php
						foreach ($FaqList as $k => $v)
						{
							?>
							<li style="cursor:pointer" id="faqCat_<?php echo $v["FaqCategory"]["id"]; ?>" rel="<?php echo $v["FaqCategory"]["id"]; ?>" >
							<?php echo $v["FaqCategory"]["title"]; ?> 
								<span class="faqbuttom_rightfirst_nu"><?php echo count($v["Faq"]); ?></span>
							</li>
							<?php
						}

						/*
						  ?>
						  <li >
						  Account Settings
						  <span class="faqbuttom_rightfirst_nu">5</span>
						  </li>
						  <li class="active">
						  Billing & Payment
						  <span class="faqbuttom_rightfirst_nu">6</span>
						  </li>
						  <li >
						  Copyrights & Legal
						  <span class="faqbuttom_rightfirst_nu">4</span>
						  </li>
						  <li >
						  What technology to be used
						  <span class="faqbuttom_rightfirst_nu">4</span>
						  </li>
						  <li>
						  How to started
						  <span class="faqbuttom_rightfirst_nu">15</span>
						  </li>
						  <li>
						  What technology to be used
						  <span class="faqbuttom_rightfirst_nu">4</span>
						  </li>
						 */
						?>
                    </ul>
                </div>
            </div>
        </div> 
    </div>
</div>

<script type="text/javascript">

	$(document).ready(function() {

		$("#faqCatDiv li").click(function() {

			var id = $(this).attr("rel");

			$("#faqCatDiv li").removeClass("active");

			$(this).addClass("active");

			$(".accordion_example1").hide();

			$("#faqCData_" + id).show();

		});

		$("#faqCatDiv li:first").trigger("click");

	});
</script>