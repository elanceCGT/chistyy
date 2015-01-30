<div class="leftmenus">
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
					<a href="<?php echo $urlDashboard; ?>"><?php echo __('DASHBOARD'); ?></a>
				</li>
				<li >
					<a href="<?php echo $urlProfile; ?>"><?php echo __('PROFILE'); ?></a>
				</li>
				<li >
					<a href="<?php echo $urlCreateBooking; ?>"><?php echo __('ALL JOBS'); ?></a>
				</li>
				<li >
					<a href="<?php echo $urlChabgepassword; ?>"><?php echo __('CHANGE PASSWORD'); ?></a>
				</li>
				<li >
					<a href="<?php echo $urlLogout; ?>"><?php echo __('LOGOUT'); ?></a>
				</li>
				
			</ul>
        </div>
    </div>

    <ul class="menu">
		<li class="active">
			<a href="<?php echo $urlDashboard; ?>"><?php echo __('DASHBOARD'); ?></a>
		</li>
		<li >
			<a href="<?php echo $urlCreateBooking; ?>"><?php echo __('ALL JOBS'); ?></a>
		</li>
		<li >
			<a href="<?php echo $urlProfile; ?>"><?php echo __('PROFILE'); ?></a>
		</li>
		<li >
			<a href="<?php echo $urlChabgepassword; ?>"><?php echo __('CHANGE PASSWORD'); ?></a>
		</li>
		<li >
			<a href="<?php echo $urlLogout; ?>"><?php echo __('LOGOUT'); ?></a>
		</li>
	</ul>
</div>