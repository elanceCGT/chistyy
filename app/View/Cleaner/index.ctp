
<div class="fullwidth">
    <div class=" col-md-12 aboutusmain_top_title">
        <div class=" col-md-12 aboutusmain_top_title">
			<div class="f-left">
            	<div class="subb_title">
					<?php echo $title_for_layout;?>
                </div>
            </div>
            <div class="f-right">
            	<a href="<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'add')); ?>" class="btn btn-primary control-label pull-right"><img src="images/add_shape.png" border="0" class="add_shape" /> Add New Cleaner</a>
        </div>
        </div>
    </div>
</div>
<div class="fullwidth">
	<div class="grid_mc">        
        <div class="row">
            <div class="col-md-1 grid_subb_title">S No.</div>
            <div class="col-md-2 grid_subb_title">Name</div>            
            <div class="col-md-5 grid_subb_title">Service Name</div>
            <div class="col-md-2 grid_subb_title">Contact Number</div>
            <div class="col-md-2 grid_subb_title">Action</div>
        </div>
        <?php for ($i=0; $i<count($UserList); $i++) { //prd($UserList);?>
        <div class="row">
            <div class="col-md-1">
                <?php echo ($i+1)?>
            </div>
            <div class="col-md-2">
                <?php echo $UserList[$i]['Cleaner']['first_na']." ".$UserList[$i]['Cleaner']['last_na']?>
            </div>
            <div class="col-md-5">
                Services
            </div>
            <div class="col-md-2">
                <?php echo $UserList[$i]['Cleaner']['phone_no']?>
            </div>            
            <div class="col-md-2">
                <div class="form-inline">
                	<?php if($UserList[$i]['User']['user_status']=="0"){?>
        				<a href="<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'changestatus','id'=>$UserList[$i]['User']['id'],'status'=>1)); ?>" class=""><span class="glyphicon green" aria-hidden="true"></span></a>
                        
                    <?php }elseif($UserList[$i]['User']['user_status']=="1"){?>
                    	<a href="<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'changestatus','id'=>$UserList[$i]['User']['id'],'status'=>0)); ?>" class=""><span class="glyphicon red" aria-hidden="true"></span></a>
        			<?php }?>
        			<a href="<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'edit',$UserList[$i]['User']['id'])); ?>" class=""><span class="glyphicon blue" aria-hidden="true"></span></a>                   
                    
                    <a href="<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'delete','id'=>$UserList[$i]['User']['id'])); ?>" class="" onclick="return confirmAction()" ><span class="glyphicon grey" aria-hidden="true"></span></a>
                    
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
		var confirmed 	=	confirm("Are you sure? This will delete cleaner.");
		return confirmed ;
	}
</script>