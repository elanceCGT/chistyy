<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->
                

                <div class="ibox-content">
                	<div class="pull-right">
	                	<input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $this->Html->url(array('admin' => true, 'controller' => 'Faqs', 'action' => 'add',$cat_id)) ?>'" value="Add FAQ">
	                </div> 
                	<div class="pull-right">
	                	<input type="button" class="btn btn-primary" onclick="window.location.href='<?php echo $this->Html->url(array('admin' => true, 'controller' => 'FaqCategories', 'action' => 'index')); ?>'" value="Back">
	                	&nbsp;&nbsp;&nbsp; 
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
			url: '<?php echo $this->Html->url(array("admin" => true, "controller" => "Faqs", "action" => "faq_list",$cat_id)); ?>',
			datatype: "json",
			mtype: 'GET',
			colNames: ['S.No.', 'Title','Title JPN', /* 'Created', 'Updated',*/ 'Action'],
			colModel: [
				{name: 'id', index: 'id', width: 8, align: 'center', sorttype: 'int', stype: '', sortable: false},
				{name: 'title', index: 'Faq.title', width: 30, align: 'left', stype: 'text', sortable: true},
				{name: 'title_jpn', index: 'Faq.title_jpn', width: 30, align: 'left', stype: 'text', sortable: true},
				/*{name: 'created', index: 'Faq.created', width: 30, align: 'left', stype: 'text', sortable: false},
				{name: 'updated', index: 'Faq.updated', width: 30, align: 'left', stype: 'text', sortable: false},*/
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
			width: 1040,
			ignoreCase: true
		});

		jQuery("#list").jqGrid('navGrid', '#pager', {edit: false, add: false, del: false, search: false, refresh: true});

		jQuery("#list").jqGrid('filterToolbar', {stringResult: true, searchOnEnter: true});

	});
	function deletecat(uId, status)
	{
		var myheading = 'Faq';
		var demos = {};
		$(document).on("click", "a[data-bb_" + uId + "]", function(e) {
			e.preventDefault();
			var type = $(this).data("bb_" + uId + "");

			if (typeof demos[type] === 'function') {
				demos[type]();
			}
		});

		bootbox.confirm("Are you sure ? You want to delete this " + myheading + " ?", function(result) {
			if (result){
				changestatus(uId, status);
			}
		});
	}
	function changestatus(catId, status){
		$.ajax({
			type: "POST",
			async: false,
			url: '<?php echo $this->Html->url(array("controller" => "Faqs", "action" => "changestatus", 'admin' => true)); ?>',
			data: {Id: catId, Status: status},
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
