<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title_for_layout;?></h2>
        <?/*?><ol class="breadcrumb">
            <li> <a href="index.html">Home</a> </li>
        </ol><?*/?>
    </div>
    <div class="col-lg-2">
    	<a style="margin-top:20px;" href="<?php echo $this->Html->url(array('controller' => 'category', 'action' => 'admin_add')); ?>" class="btn btn-primary control-label pull-right">Add</a>
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

<div id="dialog-confirm" title="Delete Category?" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure You want to Delete Category?</p>
</div>

<script type="text/javascript">
	$Grid	= $("#list");
	$(document).ready(function() {
		$("#list").jqGrid({
			url: '<?php echo $this->Html->url(array("controller" => "booking", "action" => "admin_categorylist")); ?>',
			datatype: "json",
			mtype: 'GET',
			//colNames: ['S No','Category', 'No of Service', 'Add New Service', 'Status', 'Edit', 'Delete'],
			colNames: ['S No','Category', 'Status', 'Edit', 'Delete'],
			colModel: [
				{name:'id',index:'id',width:4,align:'center',stype:'text',sorttype:'int',sortable:false}, 
				{name: 'Category', index: 'category_name', width: 40, align: 'left', stype: 'text', sortable: true},
				{name: 'status', index: 'status', width: 6, align: 'center', stype: '',sortable: false, search: false},
				//{name: 'servicecount', index: 'servicecount', width: 10, align: 'center', stype: '',sortable: false, search: false},								
				//{name: 'newservice', index: 'newservice', width: 4, align: 'center', stype: '',sortable: false, search: false},
				{name: 'action', index: 'action', width: 4, align: 'center', stype: '', sortable: false, search: false},
				{name: 'delete', index: 'delete', width: 4, align: 'center', stype: '', sortable: false, search: false}
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
	
	
	function changeCategoryStatus(id,status){
	
		URL = '<?php echo $this->Html->url(array("controller" => "category","action" => "changestatus"));?>';
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
	
	function categorydelete(id){
	
		$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:160,
      modal: true,
      buttons: {
        "Delete Category": function() {
          $( this ).dialog( "close" );
					URL = '<?php echo $this->Html->url(array("controller" => "category","action" => "delete"));?>';
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
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
	}

</script> 