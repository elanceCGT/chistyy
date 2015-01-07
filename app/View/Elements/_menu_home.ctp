<div class="header_container">
    <div class="menus">
        <div class="cd">
            <div class="leftmenu">
                <ul >
                    <li class="active">
						<a href="<?php echo $urlHome; ?>"><?php echo __('HOME'); ?></a>
					</li>
                    <li >
						<a href="<?php echo $urlGetPremium; ?>"><?php echo __('GET PREMIUM'); ?></a>
					</li>
                    <li >
						<a href="#"><?php echo __('FAVORITE'); ?></a>
					</li>
                    <li >
						<a href="<?php echo $urlFaqs; ?>"><?php echo __('FAQ'); ?></a>
					</li>
                </ul>
            </div>
            <div class="responsive_menu">
				<div class="dl-menuwrapper" id="dl-menu">
					<button class="dl-trigger"> 
						<span class="responsiveclass"> 
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span> 
						</span> 
					</button>
					<ul class="dl-menu">
						<li class="active">
							<a href="<?php echo $urlHome; ?>"><?php echo __('HOME'); ?></a>
						</li>
						<li >
							<a href="<?php echo $urlGetPremium; ?>"><?php echo __('GET PREMIUM'); ?></a>
						</li>
						<li >
							<a href="#"><?php echo __('FAVORITE'); ?></a>
						</li>
						<li >
							<a href="<?php echo $urlFaqs; ?>"><?php echo __('FAQ'); ?></a>
						</li>
					</ul>
				</div>
			</div>
            <div class="logo">Xtremap</div>
            <div class="rightmenu">
                <div class="reft">
					<div class="hedderlan">
						<div class="english">ENGLISH</div>
						<div class="日本語">日本語</div>
					</div>
					<div class="hedderlanright">   
						<div class="im"><img src="<?php echo $this->webroot . "img/" ?>top_f.png"/></div>
						<div class="mg"><img src="<?php echo $this->webroot . "img/" ?>top_gp.png"/></div>
						<?php echo $this->element("_menu_user"); ?>
					</div>   
                </div>
            </div>
        </div>
    </div>
    <div class="search">
		<select class="LOCATIONbutten"><option>Location  Type</option></select>
		<select class="LOCATIONbutten"><option>Sports  Type</option></select>
		<div class="searcdiv">
            <input type="search" placeholder="SEARCH LOCATION" class="searchtextbox">
            <div class="searchimg"><img src="<?php echo $this->webroot . "img/" ?>search7.png"></div>
		</div>
    </div>
</div>