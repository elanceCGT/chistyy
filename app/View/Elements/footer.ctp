<div class="footer_container">
	<div class="fotercoverdi">
     <div class="fotercoverdiijnner">
    	<div class="ptc" style="cursor:pointer" onclick="javascript:window.location = '<?php
			echo $this->Html->url(array("controller" => "terms-&-conditions"));
			?>'">
        	Terms  &  Conditions
        </div> 
        <div class="copyr">
        	<div class="copyr">© 2014 DMR.co.Ltd. All Rights Reserved.</div>
        </div>
        <div class="icon">
        	<div class="iconm"><img src="<?php echo $this->webroot."img/"?>Shape-f.png"/></div>
            <div class="iconm"><img src="<?php echo $this->webroot."img/"?>Shape-gp.png" class="socialLinks"/></div>
            <div class="iconm"><img src="<?php echo $this->webroot."img/"?>Shape-tt.png" class="socialLinks"/></div>
        </div>
        </div>
    </div>
</div>

<?php echo $this->element("popups");?>
