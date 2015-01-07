<!-- Admin Side Forms -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                
               
                <div class="ibox-content">
                    <table  width="100%" id="list" align="center">
					</table>
					<div id="pager" ></div>
                    
                </div>
                    
                <!-- </div> -->
            </div>
        
            
            
        </div>
    </div>
</div>

<script type="text/javascript">
	
	$Grid	= $("#list");
	
	$(function() {

		$("#list").jqGrid({
			url: '<?php echo $this->Html->url(array("controller" => "reviews", "action" => "grid")); ?>',
			datatype: "json",
			mtype: 'GET',
			colNames: ['S No','Pin', 'User','rating','description','created' , 'Action'],
			colModel: [
				{name:'id',index:'id',width:10,align:'center',stype:'text',sorttype:'int',sortable:false}, 
				{name: 'title', index: 'title', width: 30, align: 'left', stype: 'text', sortable: false},
				{name: 'subject', index: 'subject', width: 30, align: 'left', stype: 'text', sortable: false},
                {name: 'rating', index: 'rating', width: 10, align: 'left', stype: 'text', sortable: false},
                {name: 'description', index: 'description', width: 50, align: 'left', stype: 'text', sortable: false},
				{name: 'modified', index: 'modified', width: 20, align: 'center', stype: 'text', sortable: false, formatter : 'date', formatoptions : {newformat : 'd/m/Y'}},
				{name: 'action', index: '', width: 10, align: 'center', stype: '', sortable: false, search: false}
			],
			pager: jQuery('#pager'),
			rowNum:10,
			rowList: [5, 10, 50, 100, 200],
			sortname: 'Review.id',
			sortorder: 'asc',
			viewrecords: true,
			gridview: true,
			hidegrid: false,
			multiselect: false,
			height: "100%",
			autowidth: true,
			shrinkToFit:true,
		});

		$("#list").jqGrid('navGrid', '#pager', {edit: false, add: false, del: false, search: false, refresh: true});

	});
	
	$( window ).resize(function() {
	 	$Grid.setGridWidth($(".admin_content_block").width());
	});
	
	
	function changeCmsStatus(id,status){
	
	URL = '<?php echo $this->Html->url(array("controller" => "email_contents","action" => "changestatus"));?>';
	
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

</script> 