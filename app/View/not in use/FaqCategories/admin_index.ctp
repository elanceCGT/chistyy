<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->
                <div class="ibox-content">
                	<div class="pull-right">
	                	<input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $this->Html->url(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'add')); ?>'" value="Add Category">
	                </div> 
                	  
	                <div style="clear:both"></div>
					<table  width="100%" id="list" align="center"></table>
					<div id="pager" ></div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(function() {
		$("#list").jqGrid({
			url: '<?php echo $this->Html->url(array("admin" => true, "controller" => "FaqCategories", "action" => "faqcat_list")); ?>',
			datatype: "json",
			mtype: 'GET',
			colNames: ['S.No.', 'Title', 'Title JPN' , /*'Created', 'Updated',*/ 'Manage','Action'],
			colModel: [
				{name: 'id', index: 'id', width: 8, align: 'center', sorttype: 'int', stype: '', sortable: true},
				{name: 'title', index: 'title', width: 30, align: 'left', stype: 'text', sortable: false},
				{name: 'title_jpn', index: 'title_jpn', width: 30, align: 'left', stype: 'text', sortable: false},
				
				/*{name: 'created', index: 'created', width: 30, align: 'left', stype: 'text', sortable: false},
				{name: 'updated', index: 'updated', width: 30, align: 'left', stype: 'text', sortable: false},*/
				
				{name: 'manage', index: 'manage', width: 10, align: 'center', stype: '', sortable: false},
				{name: 'status', index: 'status', width: 20, align: 'center', stype: '', sortable: false},
			],
			pager: jQuery('#pager'),
			rowNum: 10,
			rowList: [10, 20, 30],
			sortname: 'id',
			sortorder: 'asc',
			viewrecords: true,
			gridview: true,
			loadonce: false,
			multiselect: false,
			hidegrid: false,
			height: "100%",
			width: 1050,
			ignoreCase: true
		});

		jQuery("#list").jqGrid('navGrid', '#pager', {edit: false, add: false, del: false, search: false, refresh: true});

		jQuery("#list").jqGrid('filterToolbar', {stringResult: true, searchOnEnter: true});

	});
	function deletecat(uId, status)
	{
		var myheading = 'Category';
		var demos = {};
		$(document).on("click", "a[data-bb_" + uId + "]", function(e) {
			e.preventDefault();
			var type = $(this).data("bb_" + uId + "");

			if (typeof demos[type] === 'function') {
				demos[type]();
			}
		});
		bootbox.confirm("Are you sure ? You want to delete this " + myheading + " ?", function(result) {

			if (result)
			{
				changestatus(uId, status);
			}
		});
	}
	function changestatus(catId, status)
	{
		$.ajax({
			type: "POST",
			async: false,
			url: '<?php echo $this->Html->url(array("controller" => "FaqCategories", "action" => "changestatus", 'admin' => true)); ?>',
			data: {catId: catId, Status: status},
			success: function(retData)
			{
				$("#list").trigger("reloadGrid");
			},
			error: function() {
				alert("Error occured while changing status.");
			}
		});
	}
	

</script>
