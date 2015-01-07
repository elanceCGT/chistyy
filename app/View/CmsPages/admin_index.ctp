<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
        <?/*?><ol class="breadcrumb">
            <li> <a href="index.html">Home</a> </li>
        </ol><?*/?>
    </div>
    <div class="col-lg-2">
    	<!-- <a style="margin-top:20px;" href="<?php //echo $this->Html->url(array('controller' => 'cms_pages', 'action' => 'admin_add')); ?>" class="btn btn-primary control-label pull-right">Add</a> -->
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

<script type="text/javascript">
	$Grid	= $("#list");
	$(document).ready(function() {
		$("#list").jqGrid({
			url: '<?php echo $this->Html->url(array("controller" => "CmsPages", "action" => "cmslistgrid")); ?>',
			datatype: "json",
			mtype: 'GET',
			colNames: ['S No','Title', 'Description', 'Action'],
			colModel: [
				{name:'id',index:'id',width:20,align:'center',stype:'text',sorttype:'int',sortable:false}, 
				{name: 'title', index: 'title', width: 40, align: 'left', stype: 'text', sortable: true},
				{name: 'description', index: 'description', width: 100, align: 'left', stype: '', sortable: true},
				{name: 'action', index: '', width: 20, align: 'center', stype: '', sortable: false, search: false}
			],
			pager: jQuery('#pager'),
			rowNum:10,
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
	
	
	function changeCmsStatus(id,status){
	
		URL = '<?php echo $this->Html->url(array("controller" => "CmsPages","action" => "changestatus"));?>';
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

	function deleteCmspage(id){
	
		bootbox.confirm("Are you sure you want to Delete selected User ?", function(r) {
			if (r == true ) {
				URL = '<?php echo $this->Html->url(array("controller" => "CmsPages","action" => "delete"));?>';
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
			}
		});
	}
	
</script> 