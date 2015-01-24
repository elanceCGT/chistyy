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
<script>
var calendar
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
		
		calendar = $('#calendar').fullCalendar(
		{
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
			/*
				defaultView option used to define which view to show by default,
				for example we have used agendaWeek.
			*/
			defaultView: 'agendaWeek',
			timezone: 'local',
			minDate: new Date(),

			businessHours:{
				start: '09:00', // a start time (9am in this example)
				end: '18:00', // an end time (6pm in this example)
				dow: [0, 1, 2, 3, 4, 5, 6 ]
			},
			minTime: '9:00',
			maxTime: '18:00',
			slotMinutes: '60',
			height: 'auto',

			/*
				selectable:true will enable user to select datetime slot
				selectHelper will add helpers for selectable.
			*/
			selectable: true,
			selectHelper: true,
			/*
				when user select timeslot this option code will execute.
				It has three arguments. Start,end and allDay.
				Start means starting time of event.
				End means ending time of event.
				allDay means if events is for entire day or not.
			*/
			select: function(start, end, allDay)
			{
				var check = $.fullCalendar.formatDate(start,'yyyy-MM-dd');
			    var today = $.fullCalendar.formatDate(new Date(),'yyyy-MM-dd');
			    if(check < today){

			    }else{

					var startdt = start._d;
					var enddt = end._d;

					var startdate = startdt.getFullYear() + "-" + startdt.getMonth()+1 + "-" + startdt.getDate();
					var enddate = enddt.getFullYear() + "-" + enddt.getMonth()+1 + "-" + enddt.getDate();

					var starttime = startdt.getHours() + ":" + startdt.getMinutes() + ":" + startdt.getSeconds();
					var endtime = enddt.getHours() + ":" + enddt.getMinutes() + ":" + enddt.getSeconds();

					$("#BookingAvaliableDate").val(startdate);
					$("#BookingHourStart").val(starttime);
					$("#BookingHourEnd").val(endtime);

					//console.log(end._d);
					$("#BtnModal").trigger("click");
					//$('#DivModal').modal('show');
					//$("#DivModal").modal();
					/*
						after selection user will be promted for enter title for event.
					*/
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
					calendar.fullCalendar('unselect');
				}
			},
			/*
				editable: true allow user to edit events.
			*/
			/*editable: true,*/
			editable: false,
			/*
				events is the main option for calendar.
				for demo we have added predefined events in json object.
			*/
			<?php /*events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]*/ ?>
			events: '<?php echo $this->Html->url(array("controller" => "serviceprovider", "action" => "bookings"));?>'
		});
	//calendar.fullCalendar('refetchEvents');
	//$("#start_time").datetimepicker();
	//$("#end_time").datetimepicker();
});

</script>
<div class="aboutusmain">
	<div class="faqbuttom">
		<div class="container">
			<div id='calendar'></div>



			<button type="button" id="BtnModal" class="btn btn-primary" data-toggle="modal" data-target="#DivModal" data-whatever="@mdo" style="display:none;">Open modal for @mdo</button>

			<div class="modal fade" id="DivModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="exampleModalLabel">Manage Schedule For Cleaner(s)</h4>
						</div>
			      
					    <div class="modal-body" style="float:none;">
					        <form>
					        	
					        	<?php echo $this->Form->input('Booking.avaliable_date',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
					        	echo $this->Form->input('Booking.hour_start',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));
					        	echo $this->Form->input('Booking.hour_end',array('type' => 'hidden', 'required' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label'))));?>

					        	<?php /*?>
					        	<div class="row">
					        		<div class="col-lg-4">
					        			<div class="form-group">
											<label for="recipient-name" class="control-label">Date:</label>
											<div id="startdate" class="input-append">
												<input data-format="hh:mm:ss" type="text"></input>
												<span class="add-on">
													<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
												</span>
											</div>
										</div>
					        		</div>
					        	</div>

					        	<div class="row">
					        		<div class="col-lg-4">
							        	<div class="form-group">
											<label for="recipient-name" class="control-label">Start Time:</label>
											<div id="start_time" class="input-append">
												<input data-format="hh:mm:ss" type="text"></input>
												<span class="add-on">
													<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
												</span>
											</div>
										</div>
					        		</div>
					        		<div class="col-lg-4">
							        	<div class="form-group">
											<label for="recipient-name" class="control-label">End Time:</label>
											<div id="end_time" class="input-append">
												<input data-format="hh:mm:ss" type="text"></input>
												<span class="add-on">
													<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
												</span>
											</div>
										</div>
					        		</div>
					        	</div>
					        	<?php */?>

					        	<div class="row">
					        		<div class="col-lg-12">
										<div class="form-group">
											<label for="message-text" class="control-label">Select Cleaner:</label>
											<?php echo $this->Form->input('Cleaner.service_provider_id',array('type' => 'select','class'=>'form-control','label' => false,'div' => false,'required' => false,'options' => $UserListArr, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'control-label')) )); ?>
										</div>
									</div>
								</div>

					        </form>
					    </div>
					    <div style="clear:both;"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save</button>
						</div>

			    	</div>
			  	</div>
			</div>
		</div>
    </div>
</div>