<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
        <?/*?><ol class="breadcrumb">
            <li> <a href="index.html">Home</a> </li>
        </ol><?*/?>
    </div>
    <div class="col-lg-2">
    	<a style="margin-top:20px;" href="<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'admin_addservice', $cleanerid, $serviceproviderid)); ?>" class="btn btn-primary control-label pull-right">Add</a>
    </div>
</div>
<?php //echo $this->element('admin/breadcrumb',array('Listings'=>$Listings)); ?>
<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins"> 
                <!-- <div class="formAdmin"> -->
                <div class="ibox-content">
					<table  width="100%" id="list" align="center"></table>
					<div id="pager" ></div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<div id="dialog-confirm" title="Delete Cleaner Service?" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure You want to delete this Service?
	</p>
</div>

<script type="text/javascript">
	$Grid	= $("#list");
	$(document).ready(function() {
		$("#list").jqGrid({
			url: '<?php echo $this->Html->url(array("controller" => "cleaner", "action" => "admin_CServicelist",  $cleanerid, $serviceproviderid)); ?>',
			datatype: "json",
			mtype: 'GET',
			colNames: ['S No','Service Name', 'Main Category', 'Sub Category', 'Unit Cost', 'Unit Price', 'Edit', 'Delete'],
			colModel: [
				{name:'id',index:'id',width:3,align:'center',stype:'text',sorttype:'int',sortable:false}, 
				{name: 'service_name', index: 'service_name', width: 10, align: 'left', stype: 'text', sortable: true},
				{name: 'category_name', index: 'category_name', width: 10, align: 'left', stype: '', sortable: true},
				{name: 'category_name', index: 'category_name', width: 10, align: 'left', stype: '', sortable: true},
				{name: 'unit_cost', index: 'unit_cost', width: 4, align: 'right', stype: '', sortable: true},
				{name: 'unit_price', index: 'unit_price', width: 4, align: 'right', stype: '', sortable: true},
				{name: 'edit', index: 'edit', width: 3, align: 'center', stype: '', sortable: false, search: false},
				{name: 'delete', index: 'delete', width: 3, align: 'center', stype: '', sortable: false, search: false}
			],
			pager: jQuery('#pager'),
			rowNum:50,
			rowList: [5, 10, 50, 100, 200],
			sortname: 'CleanerService.id',
			sortorder: 'asc',
			viewrecords: true,
			gridview: true,
			hidegrid: false,
			multiselect: false,
			height: "100%",
			autowidth: true,
			shrinkToFit:true,
			width : '100%'
		});
		$("#list").jqGrid('navGrid', '#pager', {edit: false, add: false, del: false, search: false, refresh: true});
	});
		
	$( window ).resize(function() {
	 	$Grid.setGridWidth($(".admin_content_block").width());
	});
		
		
	function changeUserStatus(id,status){
		URL = '<?php echo $this->Html->url(array("controller" => "customers","action" => "changestatus"));?>';
		$.ajax({
			url : URL,
			type: "POST",
			data : ({id:id,status:status}),
			beforeSend: function (XMLHttpRequest) {
				
			},
			complete: function (XMLHttpRequest, textStatus) {
				
			},
			success : function(data){
				$("#list").trigger("reloadGrid");
			}
		});
	}
		
	function servicedelete(id){
		$( "#dialog-confirm" ).dialog({
			resizable: false,
	      	height:160,
	      	modal: true,
	     	buttons: {
	     		"Delete Service": function() {
	     			$(this).dialog("close");
					URL = '<?php echo $this->Html->url(array("controller" => "cleaner","action" => "deleteservice"));?>';
					$.ajax({
						url : URL,
						type: "POST",
						data : ({id:id}),
						beforeSend: function (XMLHttpRequest) {
							
						},
						complete: function (XMLHttpRequest, textStatus) {
							
						},
						success : function(data){
							$("#list").trigger("reloadGrid");
						}
					});
	        	},
		        Cancel: function() {
		          $(this).dialog("close");
		        }
	      	}
	    });
	}
</script> 