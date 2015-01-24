<div class="innerheader">
	<div class="container">
		<div class="fullwidth">
        	<div class="main_logo">
        		<a href="<?php echo $urlHome; ?>">
        			<?php echo $this->Html->image('../images/main_logo.png',array('alt' => ''  ));?>
        		</a>
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
							<a href="<?php echo $urlSinup; ?>"><?php echo __('SIGNUP'); ?></a>
						</li>
						<li >
							<a href="<?php echo $urlLogin; ?>"><?php echo __('LOGIN'); ?></a>
						</li>
						<li >
							<a href="<?php echo $urlHelp; ?>"><?php echo __('HELP'); ?></a>
						</li>
						<li >
							<a href="<?php echo $urlService; ?>"><?php echo __('SERVICES'); ?></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="menu_cover">
				<div class="menu_block">
					<ul class="menus">				
						<li >
							<a href="<?php echo $urlService; ?>"><?php echo __('SERVICES'); ?></a>
						</li>
                        <li >
							<a href="<?php echo $urlHelp; ?>"><?php echo __('HELP'); ?></a>
						</li>
                        <li >
							<a href="<?php echo $urlLogin; ?>"><?php echo __('LOGIN'); ?></a>
						</li>
                        <li >
							<a href="<?php echo $urlSinup; ?>"><?php echo __('SIGNUP'); ?></a>
						</li>
                        <li class="active">
							<a href="<?php echo $urlHome; ?>"><?php echo __('HOME'); ?></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div> 
</div>