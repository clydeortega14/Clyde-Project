@extends('layouts.master')

@section('title', '')

@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="box box-primary">
			<div class="box-header"></div>

			<form action="#" method="POST" role="form">
				@csrf
				<div class="box-body">

					{{-- CUSTOMER DETAILS --}}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group @error('name') has-error @enderror">
	                            <label for="name">{{ __('Name') }} </label>
	                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name" required>
	                        
	                            @error('name')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror

	                        </div>
						</div>

						<div class="col-sm-6">
							<div class="form-group @error('email') has-error @enderror">
	                            <label for="email">{{ __('Email') }}</label>
	                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">

	                            @error('email')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror
	                        </div>
						</div>

						<div class="col-sm-12">
							<div class="form-group @error('address') has-error @enderror">
	                          <label for="address">{{ __('Address') }} </label>
	                          <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>{{ old('address') }}</textarea>
	                        
	                            @error('address')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror
	                        </div>
						</div>

						<div class="col-sm-6">
							<div class="form-group @error('contact_no') has-error @enderror">
	                            <label for="contact_no">{{ __('Contact#') }}</label>
	                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ old('contact_no') }}" placeholder="Enter Contact #" required>

	                            @error('contact_no')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror
	                        </div>
						</div>

						<div class="col-sm-6">
							<div class="form-group @error('nationality') has-error @enderror">
	                            <label for="nationality">{{ __('Nationality') }}</label>
	                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality') }}" placeholder="Enter Nationality" required>

	                            @error('nationality')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror
	                        </div>
						</div>
					</div>
					
					{{-- FOR RESERVATION --}}
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group @error('car_id') has-error @enderror">
	                            <label for="car_id">{{ __('Select Car') }} </label>
	                            <select type="text" class="form-control" id="car_id" name="car_id" required>
									<option>N/A</option>
									@foreach($cars as $car)
										<option value="{{ $car->id }}">{{ $car->model }} ( {{ $car->no_of_setters }} )</option>
									@endforeach
	                            </select>
	                        
	                            @error('car_id')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror

	                        </div>
						</div>

						<div class="col-sm-4">
							<div class="form-group @error('pick_up_date') has-error @enderror">
				                <label>{{ __('Pick up date') }}</label>

				                <div class="input-group date">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input type="text" name="pick_up_date" class="form-control pull-right" {{ old('pick_up_date') }} id="datepicker">
				                </div>

				                @error('pick_up_date')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror
				                
				              </div>
						</div>

						<div class="col-sm-4">
							<div class="form-group @error('drop_off_date') has-error @enderror">
				                <label>{{ __('Drop off date') }}</label>

				                <div class="input-group date">
					                <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                </div>
					                <input type="text" name="drop_off_date" class="form-control pull-right" value="{{ old('drop_off_date') }}" id="datepicker2">
				                </div>

				             	@error('drop_off_date')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror  
				            </div>
						</div>

						<div class="col-sm-12">
							<div class="form-group @error('pick_up_address') has-error @enderror">
	                          	<label for="pick_up_address">{{ __('Pick up address') }} </label>
	                          	<textarea type="text" class="form-control" id="pick_up_address" name="pick_up_address" placeholder="Hotel/Airport/Mall" required>{{ old('pick_up_address') }}</textarea>
	                        
	                            @error('pick_up_address')
	                                <span class="help-block">
	                                    {{ $message }}
	                                </span>
	                            @enderror
	                        </div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="col-md-8">
		<div class="box box-primary">
	        <div class="box-body no-padding">
	          <!-- THE CALENDAR -->
	          <div id="calendar"></div>
	        </div>
	        <!-- /.box-body -->
      </div>
	</div>
</div>

@endsection

@section('custom_js')

<script type="text/javascript">

	$('#datepicker').datepicker({
      	autoclose: true
    })

    $('#datepicker2').datepicker({
      	autoclose: true
    })

    // FOR CALENDAR
</script>

<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    : [
        {
          title          : 'All Day Event',
          start          : new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        {
          title          : 'Long Event',
          start          : new Date(y, m, d - 5),
          end            : new Date(y, m, d - 2),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },
        {
          title          : 'Meeting',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'Lunch',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 14, 0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'Birthday Party',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 22, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
@endsection