
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">            
            <div class="ibox float-e-margins">                
                <!-- <div class="formAdmin"> -->                
                <div class="ibox-content">
                    <div class="pull-right">
<!--						<input type="button" class="btn btn-primary" onclick="window.location.href = '<?php //echo $this->Html->url(array("controller" => "TeamMembers","action" => "memberadd", "admin" => true));?>'" value="Add Member">-->
                    </div>	 
                    <div style="clear:both"></div>
					<table  width="100%" id="list" align="center"></table>
                    <div id="pager" ></div>

                    <div class="hr-line-dashed"></div>
                    <input type="hidden" name="checkAll" id="checkAll" value="0" autocomplete="OFF" />
                    <input type="hidden" name="user_ids" id="user_ids" />
<!--                    <input type="button" class="btn btn-primary" onclick="validate()" id="sendMail" name="sendMail" value="Delete Selected">-->
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$Grid = $("#list");

	$(function() {

		$("#list").jqGrid({
			url: '<?php echo $this->Html->url(array("controller" => "team_members", "action" => "admin_membergrid")); ?>',
			datatype: "json",
			mtype: "POST",
			colNames: ['Name', 'Name JPN', 'Designation', 'Designation JPN', 'Action'],
			colModel: [
				{
					name: 'name',
					index: 'name',
					jsonmap: 'cell.name',
					width: 30,
					align: 'left',
					stype: 'text',
					sortable: true,
					search: true
				},
				{
					name: 'name_jpn',
					index: 'name_jpn',
					jsonmap: 'cell.name_jpn',
					width: 30,
					align: 'left',
					stype: 'text',
					sortable: true,
					search: true
				},
				{
					name: 'designation',
					index: 'designation',
					jsonmap: 'cell.designation',
					width: 10,
					align: 'center',
					stype: 'text',
					sortable: true,
					search: true
				},
				{
					name: 'designation_jpn',
					index: 'designation_jpn',
					jsonmap: 'cell.designation_jpn',
					width: 30,
					align: 'center',
					stype: 'text',
					sortable: true,
					search: false,
				},
				{name: 'action', index: '', width: 20, align: 'center', stype: '', sortable: false, search: false, formatter: getIcons, jsonmap: 'cell.status'}
			],
			jsonReader: {
				repeatitems: false, root: "rows"
			},
			height: 'auto',
			toppager: false,
			pager: $("#pager"),
			rowNum: 10,
			rowList: [5, 10, 50, 100, 200],
			viewrecords: true,
			rownumbers: true,
			sortname: "name",
			sortorder: "asc",
			gridview: true,
			hidegrid: false,
			height: "100%",
					autowidth: true,
			shrinkToFit: true,
			multiselect: true,
			multiboxonly: true,
			beforeSelectRow: function(rowid, e) {
				var iCol = $.jgrid.getCellIndex(e.target);
				return (iCol >= "5") ? false : true;
			},
			onCellSelect: function(rowid, iCol, cellcontent, e) {
			},
			onSortCol: function(index, iCol, sortorder) {
				$('#UserSortOn').val(index + ':' + sortorder);
			},
			onSelectRow: function(rowid, status, e) {
				//console.log(rowid+','+status+','+e);
				var prevData = $('#user_ids').val();
				if (prevData != '') {
					var prevArr = prevData.split(',');
					if (status !== false) {
						prevArr.push(rowid);
					} else {
						prevArr.splice($.inArray(rowid, prevArr), 1);
					}
					$('#user_ids').val(prevArr.join(','));
				} else if (status !== false) {
					$('#user_ids').val(rowid);
				}
			}
		}).navGrid("#pager",
				{refresh: true, add: false, edit: false, del: false, search: false},
		{}, // settings for edit
				{}, // settings for add
				{}, // settings for delete
				{sopt: ["cn"]} // Search options. Some options can be set on column level
		);
		$("#list").filterToolbar({autosearch: true, searchOnEnter: false});
		$("#gview_list > .ui-jqgrid-titlebar").hide();
		$('.ui-pg-input').css('min-width', '50px');
		$('.ui-pg-input').css('padding', '0');
		$('.ui-pg-input').css('margin', '0');
		$('.ui-pg-input').css('height', '20');
		$('.ui-search-toolbar div input').css('width', '99%');

	});
	function onMultiselect() {
		var grid = $("#list");

		$("#cb_list").click(function(e) {

			$("#user_ids").val("");
			grid.jqGrid('resetSelection');

			if ($("#checkAll").val() == "0") {

				var ids = grid.getDataIDs();
				for (var i = 0, il = ids.length; i < il; i++) {
					grid.jqGrid('setSelection', ids[i], true, e);
				}
				$(this).prop("checked", true);
				$("#checkAll").val("1");
			} else {
				$(this).prop("checked", false);
				$("#checkAll").val("0");

			}



		});
	}
	$(window).resize(function() {
		$Grid.setGridWidth($(".admin_content_block").width());
	});

	$(document).ready(function() {
		onMultiselect();

	});

	function validate() {
		var users;
		//users = $("#list").jqGrid('getGridParam', 'selarrrow');
		users = $("#user_ids").val();
		if (users == '') {
			//alert('Please select users.');
			bootbox.alert("Please select users.", function(r) {
			});
			return false;
		} else {
			userMultipleDelete(users);
			return true;
			//$("#user_ids").val(users);
			//$("#form_sendMail").submit();
		}

	}

	function changeUserStatus(id, status) {
		URL = '<?php echo $this->Html->url(array("controller" => "users", "action" => "changestatus")); ?>';
		$.ajax({
			url: URL,
			type: "POST",
			data: ({id: id, status: status}),
			success: function(data) {
				$("#list").trigger("reloadGrid");
			}
		});
	}

	function userDelete(id) {
		return false;
		bootbox.confirm("Are you sure you want to Delete selected Team Members ?", function(r) {

			if (r == true) {
				URL = '<?php echo $this->Html->url(array("controller" => "TeamMembers", "action" => "deleteUser")); ?>';
				$.ajax({
					url: URL,
					type: 'POST',
					data: ({id: id}),
					success: function(data) {
						jQuery("#list").trigger("reloadGrid");
					}
				});
			}
		});


	}
	function userMultipleDelete(ids) {
	return false;
		bootbox.confirm("Are you sure you want to Delete selected Team Members ?", function(r) {
			//Example.show("Confirm result: "+result);
			if (r == true) {


				URL = '<?php echo $this->Html->url(array("controller" => "TeamMembers", "action" => "deleteUser")); ?>';
				$.ajax({
					url: URL,
					type: 'POST',
					data: ({ids: ids}),
					success: function(data) {
						jQuery("#list").trigger("reloadGrid");
					}
				});
			}
		});
	}

	function getIcons(cellvalue, opts, rowObj) {
		var src = (cellvalue == '1' ? 'clrEmable' : 'clrDisable'), id = rowObj.id;
		return '&nbsp;&nbsp;&nbsp;<a onclick="editUser(' + id + ')" title="Edit User"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle fa-lg" onclick="userDelete(' + id + ')" title="Delete User"></i>';
	}

	function editUser(id) {
		var url = "<?php echo $this->Html->url(array('action' => 'admin_memberedit'), true); ?>/" + id;
		//alert(url);return;
		window.top.location = url;
	}

	function submitExportForm() {
		$('#UserAdminExportForm').submit();
	}
</script> 