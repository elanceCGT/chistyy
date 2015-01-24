<?php
echo $this->Html->css(
	array(
		'../js/fullcalendar/fullcalendar.css',
		//'../js/fullcalendar/fullcalendar.print.css'
    )
);
echo $this->Html->script(
	array(
		'../js/fullcalendar/lib/moment.min.js',
		'../js/fullcalendar/lib/jquery.min.js',
		'../js/fullcalendar/fullcalendar.min.js'
    )
);
?>
<style type="text/css">.fc-ltr .fc-axis { height: 50px; } </style>
<script>

function loadevents(){

	URL = "<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'showschedule'));?>";
	$.ajax(
		{
			url : URL,
			type: "POST",
			dataType: 'json',
			data : ({test: "test"}),
			beforeSend: function (XMLHttpRequest) {
				
			},
			complete: function (XMLHttpRequest, textStatus) {
				
			},
			success : function(data){
				console.log(data);
				//allevents = data;
				//calendar.fullCalendar('refetchEvents');
				$('#calendar').fullCalendar('addEventSource', data);
			}
		}
	);
}

var calendar
var allevents
$(document).ready(function() {
	/*
		date store today date.
		d store today date.
		m store current month.
		y store current year.
	*/
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	/*
		Initialize fullCalendar and store into variable.
		Why in variable?
		Because doing so we can use it inside other function.
		In order to modify its option later.
	*/
	
	calendar = $('#calendar').fullCalendar({
		/*
			header option will define our calendar header.
			left define what will be at left position in calendar
			center define what will be at center position in calendar
			right define what will be at right position in calendar
		*/
		header:
		{
			left: 'prev,next today',
			center: 'title',
			right: 'agendaDay,agendaWeek,month'
		},
		//defaultView option used to define which view to show by default, for example we have used agendaWeek.
		defaultView: 'agendaWeek',
		timezone: 'local',

		businessHours:{
			start: '09:00', // a start time (9am in this example)
			end: '18:00', // an end time (6pm in this example)
			dow: [0, 1, 2, 3, 4, 5, 6 ]
		},

		minTime: '9:00',
		maxTime: '18:00',
		axisFormat: 'H(:mm)',
		disableDragging: true,
		slotDuration: '01:00:00',
		contentHeight: '50',

		eventLimit: 4, // If you set a number it will hide the itens
		eventLimitText: "View More", // Default is `more` (or "more" in the lang you pick in the option)

		height: 'auto',
		//selectable:true will enable user to select datetime slot selectHelper will add helpers for selectable.
		selectable: true,
		selectHelper: true,

		firstHour: 8,
		//editable: true allow user to edit events.
		editable: true,
		/*
			when user select timeslot this option code will execute.
			It has three arguments. Start,end and allDay.
			Start means starting time of event.
			End means ending time of event.
			allDay means if events is for entire day or not.
		*/

		select: function(start, end, allDay){
			//console.log(start);
			//console.log(end);
			//console.log((end-start)/(1000*60*60*24));
			var myDate = new Date();
			//How many days to add from today?
			var daysToAdd = -1;
			myDate.setDate(myDate.getDate());

			if (start < myDate){
				//TRUE Clicked date smaller than today + daysToadd
				alert("You cannot book on this day!");
				calendar.fullCalendar('unselect');
				return false;
			}  

			var startdt = start._d;
			var enddt = end._d;

			var startdate = startdt.getFullYear() + "-" + startdt.getMonth()+1 + "-" + startdt.getDate();
			var enddate = enddt.getFullYear() + "-" + enddt.getMonth()+1 + "-" + enddt.getDate();

			var starttime = startdt.getHours() + ":" + startdt.getMinutes() + ":" + startdt.getSeconds();
			var endtime = enddt.getHours() + ":" + enddt.getMinutes() + ":" + enddt.getSeconds();

			$("#BookingAvaliableDate").val(startdate);
			$("#BookingHourStart").val(starttime);
			$("#BookingHourEnd").val(endtime);

			$("#BtnModal").trigger("click");
			//$('#DivModal').modal('show');
			//$("#DivModal").modal();
			//after selection user will be promted for enter title for event.
			var title;
			//var title = prompt('Enter Avaliablity Of Cleaner');
			/* if title is enterd calendar will add title and event into fullCalendar. */
			if (title)
			{
				calendar.fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end/*,
						allDay: allDay*/
					},
					true // make the event "stick"
				);
			}
			//calendar.fullCalendar('unselect');
			
		},
		events: {
			<?php /*?>url: 'http://192.168.1.2.192/fullcalendar-2.2.5/demos/php/get-events.php?start=2014-10-26&end=2014-12-07&_=1421650875119',<?php */?>
			url: "<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'showschedule'));?>",
			error: function() {
				$('#script-warning').show();
			},
			timeFormat: 'H(:mm)'
		},
		eventClick: function(event, element){
			//console.log(event);
		}
		//events is the main option for calendar. for demo we have added predefined events in json object.
		<?php /*?>eventSources: "<?php echo $this->Html->url(array('controller' => 'cleaner', 'action' => 'showschedule'));?>"<?php */?>
		//eventSources: allevents
	});
	//loadevents();
	//calendar.fullCalendar('refetchEvents');
	//$("#start_time").datetimepicker();
	//$("#end_time").datetimepicker();
});

function UpdateSchedule(){

	var URL = '<?php echo $this->Html->url(array("controller" => "Cleaner","action" => "updateschedule"));?>';
	var avaliabledate = $("#BookingAvaliableDate").val();
	var starttime = $("#BookingHourStart").val();
	var endtime = $("#BookingHourEnd").val();
	var avaliablestatus = $("input[type='radio'][name='AvaliablityStatus']:checked").val();

	$.ajax({
		url: URL,
		type: "POST",
		data: ({ avaliabledate:avaliabledate, starttime:starttime, endtime:endtime, avaliablestatus:avaliablestatus }),
		beforeSend: function (XMLHttpRequest) {
			
		},
		complete: function (XMLHttpRequest, textStatus) {
			
		},
		success : function(data){
			calendar.fullCalendar('refetchEvents');
		}
	});
}

</script>

<div class="fullwidth">
    <div id='calendar'></div>



    <button type="button" id="BtnModal" class="btn btn-primary" data-toggle="modal" data-target="#DivModal" data-whatever="@mdo" style="display:none;">Open modal for @mdo</button>

    <div class="modal fade" id="DivModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">Please Select the Status</h4>
                </div>
          
                <div class="modal-body" style="float:none;">
                    <form>
                        
                        <?php echo $this->Form->input('Booking.avaliable_date',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
                        echo $this->Form->input('Booking.hour_start',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
                        echo $this->Form->input('Booking.hour_end',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-3">
                                        <label for="message-text" class="control-label">
                                            <input type="radio" value="Y" name="AvaliablityStatus" />&nbsp;Avaliable
                                        </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="message-text" class="control-label">
                                            <input type="radio" value="Y" name="AvaliablityStatus" />&nbsp;Not Avaliable
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div style="clear:both;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="UpdateSchedule();">Save</button>
                </div>

            </div>
        </div>
    </div>
</div>
