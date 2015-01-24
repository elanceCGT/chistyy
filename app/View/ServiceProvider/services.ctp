<div class="fullwidth">
    <div class=" col-md-12 aboutusmain_top_title">
        <div class=" col-md-12 aboutusmain_top_title">
			<div class="f-left">
            	<div class="subb_title">
					<?php echo $title_for_layout;?>
                </div>
            </div>
            <div class="f-right">
            	<a href="<?php echo $this->Html->url(array('controller' => 'serviceprovider', 'action' => 'addservice')); ?>" class="btn btn-primary control-label pull-right">
            		<?php echo $this->Html->image('../images/add_shape.png',array('alt' => ''  ));?> Add New Service
            	</a>
        </div>
        </div>
    </div>
</div>
<div class="fullwidth">
	<div class="grid_mc">        
        <div class="row">
            <div class="col-md-1 grid_subb_title">S No.</div>
            <div class="col-md-2 grid_subb_title">Service Name</div>
            <div class="col-md-2 grid_subb_title">Main Category</div>            
            <div class="col-md-2 grid_subb_title">Sub Category</div>
            <div class="col-md-2 grid_subb_title">Unit Cost</div>
            <div class="col-md-2 grid_subb_title">Unit Price</div>
            <div class="col-md-1 grid_subb_title">Action</div>
        </div>

        <?php for ($i=0; $i<count($Services); $i++) {?>
	        <div class="row">
	            <div class="col-md-1">
	                <?php echo ($i+1)?>
	            </div>
	            <div class="col-md-2">
	                <?php echo $Services[$i]['Service']['service_name']?>
	            </div>
	            <div class="col-md-2">
	                <?php echo $Services[$i]['Category']['category_name']?>
	            </div>
	            <div class="col-md-2">
	                <?php echo $Services[$i]['SubCategory']['category_name']?>
	            </div>
	            <div class="col-md-2">
	                <?php echo $Services[$i]['ServiceProviderService']['unit_cost']?>
	            </div>
	            <div class="col-md-2">
	                <?php echo $Services[$i]['ServiceProviderService']['unit_price']?>
	            </div>
	            <div class="col-md-1">
	                <div class="form-inline">
	        			<a href="<?php echo $this->Html->url(array('controller' => 'serviceprovider', 'action' => 'editservice',$Services[$i]['ServiceProviderService']['id'])); ?>" class=""><span class="glyphicon blue" aria-hidden="true"></span></a>
	                    <a href="<?php echo $this->Html->url(array('controller' => 'serviceprovider', 'action' => 'deleteservice',$Services[$i]['ServiceProviderService']['id'])); ?>" class="" onclick="return confirmAction()" ><span class="glyphicon grey" aria-hidden="true"></span></a>
	                </div>
	            </div>
	        </div>
        <?php }?>
	</div>
</div>


		<div id="dialog-confirm" title="Delete Cleaner?" style="display:none;">
   		 <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure You want to Delete Cleaner?</p>
		</div>
<script type="application/javascript">
	function confirmAction(){
		var confirmed 	=	confirm("Are you sure? This will delete this service.");
		return confirmed ;
	}
</script>