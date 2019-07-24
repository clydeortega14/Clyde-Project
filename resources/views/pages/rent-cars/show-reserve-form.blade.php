@extends('layouts.master')

@section('title', '')

@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="box box-primary">
			<div class="box-header"></div>

			 <form action="{{ isset($rent) ? route('update.reservation', ['id' => $rent->id]) : route('post.reservation') }}" method="POST" role="form">
            @csrf

            <div class="box-body">
              
              {{-- CUSTOMER DETAILS --}}
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group @error('name') has-error @enderror">
                        <label for="name">{{ __('Fullname') }} </label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($rent) ? $rent->customer->name : old('name') }}" placeholder="Enter Fullname" required>
                    
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
                      <input type="email" class="form-control" id="email" name="email" value="{{ isset($rent) ? $rent->customer->email : old('email') }}" placeholder="Enter Email">

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
                    <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>{{ isset($rent) ? $rent->customer->address : old('address') }}</textarea>
                  
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
                        <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ isset($rent) ? $rent->customer->contact_number : old('contact_no') }}" placeholder="Enter Contact #" required>

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
                        <input type="text" class="form-control" id="nationality" name="nationality" value="{{ isset($rent) ? $rent->customer->nationality : old('nationality') }}" placeholder="Enter Nationality">

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
                <div class="col-sm-6">
                  <div class="form-group @error('car_id') has-error @enderror">
                      <label for="car_id">{{ __('Select Car') }} </label>
                      <select type="text" class="form-control" id="car_id" name="car_id" required>
                      <option value="">N/A</option>
                        @foreach($cars as $car)
                          <option value="{{ $car->id }}" {{ isset($rent) && $car->id == $rent->car_id ? 'selected' : '' }}>{{ $car->model }} ( {{ $car->no_of_setters }} )</option>
                        @endforeach
                      </select>
                  
                      @error('car_id')
                          <span class="help-block">
                              {{ $message }}
                          </span>
                      @enderror

                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group @error('destination_id') has-error @enderror">
                      <label for="destination_id">{{ __('Select Destination') }} </label>
                      <select type="text" class="form-control" id="destination_id" name="destination_id" required>
                      <option value="">N/A</option>
                        @foreach($destinations as $destination)
                          <option value="{{ $destination->id }}" {{ isset($rent) && $destination->id == $rent->destination_id ? 'selected' : '' }}>{{ $destination->destination }} ( {{ number_format($destination->rate, 2) }} )</option>
                        @endforeach
                      </select>
                  
                      @error('destination_id')
                          <span class="help-block">
                              {{ $message }}
                          </span>
                      @enderror

                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group @error('pick_up_date') has-error @enderror">
                    <label>{{ __('Pick up date') }}</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="pick_up_date" class="form-control pull-right" value="{{ isset($rent) ? $rent->pick_up_date : old('pick_up_date') }}" id="datepicker" data-date-format="yyyy-mm-dd">
                    </div>

                      @error('pick_up_date')
                          <span class="help-block">
                              {{ $message }}
                          </span>
                      @enderror
                    
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group @error('drop_off_date') has-error @enderror">
                      <label>{{ __('Drop off date') }}</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="drop_off_date" class="form-control pull-right" value="{{ isset($rent) ? $rent->drop_off_date : old('drop_off_date') }}" id="datepicker2" data-date-format="yyyy-mm-dd">
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
                      <textarea type="text" class="form-control" id="pick_up_address" name="pick_up_address" placeholder="Hotel/Airport/Mall" required>{{ isset($rent) ? $rent->pick_up_address : old('pick_up_address') }}</textarea>
                  
                      @error('pick_up_address')
                          <span class="help-block">
                              {{ $message }}
                          </span>
                      @enderror
                  </div>
                </div>
                
                @if(isset($rent))
                  <div class="col-sm-4">
                    <div class="form-group @error('status') has-error @enderror">
                        <label for="status">{{ __('Status') }} </label>
                        <select type="text" class="form-control" id="status" name="status" required>
                        <option>N/A</option>
                          @foreach($rentStatus as $status)
                              <option value="{{ $status->id }}" {{ $status->id == $rent->status_id ? 'selected' : ''}}>{{ $status->status }}</option>
                          @endforeach
                        </select>
                    
                        @error('status')
                            <span class="help-block">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>
                  </div>
                @endif
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat">{{ isset($rent) ? 'Update' : 'Save'}}</button>
              <a href="{{ route('rent.list') }}" class="btn btn-danger btn-flat">Cancel</a>
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

	 dPicker('#datepicker'); // PICK UP DATE
   dPicker('#datepicker2') // DROP OFF DATE

    function dPicker(select)
    {
      $(select).datepicker({
          autoclose: true,
          dateFormat : 'yy-mm-dd'
      })

    }

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
          title: $.trim($(this).text()), // use the element's text as the event title
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
      events    : ajaxEventData(),
      eventClick: function(event, element) {

        alert('click')

        $('#calendar').fullCalendar('updateEvent', event);
      }

    })

    /* Random Events function */

    function ajaxEventData()
    {
      let myEvents = [] // declares empty array

      $.ajax({

        url : '/event-list-data',
        async: false,
        method : `GET`,
        success: function (res) {

            $.each(res, function(event, value){

             let x = { //declare object variable with default properties

                title          : value.customer.name,
                start          : value.pick_up_date,
                end            : value.drop_off_date,
                allDay         : true,
                classNames     : value.status.class
              }

              myEvents.push(x) // add new array

            })
        },
        error : function(error) {

          console.log(error)
        }
      })

      return myEvents
    }

  })
</script>
@endsection