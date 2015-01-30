<?php 
$link = '';
 $link = $this->Session->read('Auth.User.id') !='' ? "customers/addbooking": "users/login"  ; 
?>
<div class="fullwidth block2">
	<div class="container">
		<div class="blue_band">Book a <span>Cleaning</span> Anytime 
		<a class="a1" href="<?php echo $this->webroot.$link?>">book</a> 
		<a class="a2" href="<?php echo $this->webroot?>services/services">See All Services</a></div>
	</div>
</div>
<div class="fullwidth block3">
  <div class="container">
   <div class="block3toptitle">
    <span><img src="img/lineimg.png"></span>
	<div class="block3toptitletext">Popular Services</div>
	<span><img src="img/lineimg.png"></span>
   </div>
   <div class="block3text">Quisque non diam sit amet tellus malesuada elementum. Aenean a mauris ante. Nullam eget suscipit dui. Sed consequat,suscipit semper, risus elit tempor sapien, quis volutpat elit leo ut tortor.</div>
   <div id="slider1">
		<a class="buttons prev" href="#"><img src="img/leftarrow.png"></a>
		<div class="viewport">
			<ul class="overview">
				<?php foreach($services as $k => $v){ if($k<=5) { ?>
				<li><img src="<?php echo $this->webroot?>img/homesliderimg1.jpg" />
				  <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle"><?php echo $v['Service']['service_name']; ?></div>
				   <a href="" class="homeknowmore">Know More<span><img src="<?php echo $this->webroot?>img/morearrowimg.png"></span></a>
				 </div>
				</li>
				<?php } } ?>
				<!-- <li><img src="img/homesliderimg1.jpg" />
				 <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle">CArpet Cleaning</div>
				   <a href="" class="homeknowmore">Know More<span><img src="img/morearrowimg.png"></span></a>
				 </div>
				</li>
				<li><img src="img/homesliderimg1.jpg" />
				 <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle">duct cleaning</div>
				   <a href="" class="homeknowmore">Know More<span><img src="img/morearrowimg.png"></span></a>
				 </div>
				</li>
				<li><img src="img/homesliderimg1.jpg" />
				 <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle">HouseKeeping</div>
				   <a href="" class="homeknowmore">Know More<span><img src="img/morearrowimg.png"></span></a>
				 </div>
				</li>
				<li><img src="img/homesliderimg1.jpg" />
				 <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle">HouseKeeping</div>
				   <a href="" class="homeknowmore">Know More<span><img src="img/morearrowimg.png"></span></a>
				 </div>
				</li>
				<li><img src="img/homesliderimg1.jpg" />
				 <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle">HouseKeeping</div>
				   <a href="" class="homeknowmore">Know More<span><img src="img/morearrowimg.png"></span></a>
				 </div>
				</li> -->
				
			</ul>
		</div>
		<a class="buttons next" href="#"><img src="img/rightarrowimg.png"></a>
	</div>
	<div class="block3toptitle">
    <span><img src="img/lineimg.png"></span>
	<div class="block3toptitletext">Other Services</div>
	<span><img src="img/lineimg.png"></span>
   </div>
  
		<div class="ourserviceli">
			<ul >
				<?php foreach($services as $k => $v){ if($k>5 && $k <= 7) { ?>
				<li><img src="img/homeslide2img.jpg" />
				  <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle"><?php echo $v['Service']['service_name'];?></div>
				   <a href="" class="homeknowmore">Know More<span><img src="<?php echo $this->webroot?>img/morearrowimg.png"></span></a>
				 </div>
				</li>
				<!-- <li><img src="img/homeslide2img.jpg" />
				 <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle">snow removal</div>
				   <a href="" class="homeknowmore">Know More<span><img src="img/morearrowimg.png"></span></a>
				 </div>
				</li>
				<li><img src="img/homeslide2img.jpg" />
				 <div class="homesliderimgtextdiv">
				   <div class="homesliderimgtextdivtitle">insect removal</div>
				   <a href="" class="homeknowmore">Know More<span><img src="img/morearrowimg.png"></span></a>
				 </div>
				</li> -->
				<?php } }?>
				
				
				
			</ul>
		</div>
		
		<div class="homeviewallbuttonouter">
		 <!-- <button class="homeviewallbutton">View all services</button> -->
		 <a class="homeviewallbutton" href="<?php echo $this->webroot?>services/services">View all services</a></div>
		</div>
		
  </div>
</div>
<div class="fullwidth block4">
 <div class="container">
   <div class="blockbox1">
    <div class="blockbox1img"><img src="img/homeboxuserimg.png"></div>
	<div class="blockbox1tite">professional</div>
	<div class="blockbox1text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra </div>
   </div>
   <div class="blockbox1 blockbox2">
    <div class="blockbox1img"><img src="img/homeumberla.png"></div>
	<div class="blockbox1tite">Safety</div>
	<div class="blockbox1text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra </div>
   </div>
   <div class="blockbox1 blockbox3">
    <div class="blockbox1img"><img src="img/homeboxuserimg3.png"></div>
	<div class="blockbox1tite">Quality</div>
	<div class="blockbox1text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra </div>
   </div>
   <div class="blockbox1 blockbox4 ">
    <div class="blockbox1img"><img src="img/homesettingimg.png"></div>
	<div class="blockbox1tite">Easy</div>
	<div class="blockbox1text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc viverra </div>
   </div>
 </div>
</div>
<div class="fullwidth block5">
   <div class="container">
     <div class="block5title">How it works ?</div>
	 <div class="block5content">
	  <div class="block5contentfirst">
	   <div class="block5contentfirstimg"><img src="img/homehowitworksimg1.png"></div>
	   <div class="block5contentfirsttext">Select the date & time.</div>
	  </div>
	  <div class="block5contentfirstarrow"><img src="img/homehowarrow1.png"></div>
	   <div class="block5contentsecond">
	   <div class="block5contentfirstimg"><img src="img/homehowitworksimg1.png"></div>
	   <div class="block5contentfirsttext">We’ll confirm your appointment</div>
	  </div>
	  <div class="block5contentfirstarrow2"><img src="img/homehowarrow2.png"></div>
	   <div class="block5contentthird">
	   <div class="block5contentfirstimg"><img src="img/homehowitworksimg1.png"></div>
	   <div class="block5contentfirsttext">Our expert’s will work</div>
	  </div>
	  <div class="block5contentfirstarrow"><img src="img/homehowarrow1.png"></div>
	   <div class="block5contentfourth">
	   <div class="block5contentfirstimg"><img src="img/homehowitworksimg1.png"></div>
	   <div class="block5contentfirsttext">You will enjoy</div>
	  </div>
	 </div>
   </div>
</div>
<div class="fullwidth block6">
    <div class="container">
	 <div class="block6inner">
	   <div class="block6left"><img src="img/homemobiimg.png"></div>
	   <div class="block6right">
	      <div class="block6right_title">Neque porro quisquam est qui</div>
		  <div class="block6right_text">Morbi lacinia elit nec sem pulvinar, et congue sem consectetur. Vestibulum pretium feug-iat risus vitae vestibulum. Integer ultrices, odio vitae porta condimentum, tellus quam imperdiet massa, nec tincidunt velit eros non erat. </div>
		  <div class="block6right_adds">
		   <div class="block6right_addsfirst"><img src="img/homeaddimg1.png"></div>
		   <div class="block6right_addsfirst"><img src="img/homeaddimg2.png"></div>
		   <div class="block6right_addsfirst"><img src="img/homeaddimg3.png"></div>
		  </div>
	   </div>
	 </div>  
	</div>
</div>
<div class="fullwidth block7">
  <div class="container">
     <div class="block7_left">
	  <div class="block7_lefttitle">More About Us</div>
	  <div class="block7_leftext">Quisque luctus hendrerit ullamcorper. Sed eu posuere magna, vel euismod eros. Duis at porta libero. Pellentesque varius est non ante pellentesque, id hendrerit dolor congue. Sed eu posuere magna, vel euismod eros. Duis at porta libero.  </div>
	  <div class="block7_leftredmore">Read More</div>
	 </div>
	 <div class="block7_left">
	  <div class="block7_lefttitle">About Our Team</div>
	  <div class="block7_leftext">Quisque luctus hendrerit ullamcorper. Sed eu posuere magna, vel euismod eros. Duis at porta libero. Pellentesque varius est non ante pellentesque, id hendrerit dolor congue. Sed eu posuere magna, vel euismod eros. Duis at porta libero.  </div>
	  <div class="block7_leftredmore">Read More</div>
	 </div>
  </div>	 
</div>