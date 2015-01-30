	<style type="text/css">
	.ourserviceli ul li {
		margin-right: 13px;
	}
	</style>
	<div class="block3toptitle">
    <span><img src="<?php echo $this->webroot?>img/lineimg.png"></span>
	<div class="block3toptitletext">Services</div>
	<span><img src="<?php echo $this->webroot?>img/lineimg.png"></span>
   </div>
   <div class="container">	
		<div class="ourserviceli">
			<ul >
				<?php foreach($services as $k=>$v){ ?>
				<li style="margin-bottom:10px;"><img src="<?php echo $this->webroot?>img/homeslide2img.jpg" />
				  <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle"><?php echo $v['Service']['service_name'];?></div>
				   <a href="" class="homeknowmore">Know More<span><img src="<?php echo $this->webroot?>img/morearrowimg.png"></span></a>
				 </div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>		