<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
    </div>
    <div class="col-lg-2">
    	<a style="margin-top:20px;" href="<?php echo $this->Html->url(array('controller' => 'category', 'action' => 'admin_addmain')); ?>" class="btn btn-primary control-label pull-right">Add</a>
    </div>
</div>
<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">   
            <div class="ibox float-e-margins"> 
                <div class="ibox-content">
					<table  width="100%" id="list" align="center"></table>
					<div id="pager" ></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialog-confirm" title="Delete Category?" style="display:none;">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure You want to Delete this Category?
	</p>
</div>

<script type="text/javascript">
	$Grid	= $("#list");
	$(document).ready(function() {
		$("#list").jqGrid({
			url: '<?php echo $this->Html->url(array("controller" => "category", "action" => "admin_maincategorylist")); ?>',
			datatype: "json",
			mtype: 'GET',
			colNames: ['S No','Category', 'No of Sub Category', 'Status', 'Edit', 'Delete'],
			colModel: [
				{name:'id',index:'id',width:3,align:'center',stype:'text',sorttype:'int',sortable:false}, 
				{name: 'Category', index: 'category_name', width: 40, align: 'left', stype: 'text', sortable: true},
				{name: 'subcatcnt', index: 'subcatcnt', width: 5, align: 'center', stype: '',sortable: false, search: false},
				{name: 'status', index: 'status', width: 2, align: 'center', stype: '',sortable: false, search: false},
				{name: 'action', index: 'action', width: 2, align: 'center', stype: '', sortable: false, search: false},
				{name: 'delete', index: 'delete', width: 2, align: 'center', stype: '', sortable: false, search: false}
			],
			pager: jQuery('#pager'),
			rowNum:50,
			rowList: [5, 10, 50, 100, 200],
			sortname: 'id',
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
</script> 