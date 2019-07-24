@extends('layouts.master')

@section('title', '')

@section('custom_css')

<link rel="stylesheet" href="/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">

@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<form action="{{ isset($booked_tour) ? route('book-tours.update', ['id' => $booked_tour->id]) : route('book-tours.store') }}" method="POST" role="form">
				@csrf
				@if(isset($booked_tour))
					@method('PUT')
				@endif
				<div class="box-body">
					<div class="row">
						<div class="col-sm-6">
							
							{{-- CUSTOMER DETAILS --}}
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group @error('name') has-error @enderror">
			                            <label for="name">{{ __('Name') }} </label>
			                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($booked_tour) ? $booked_tour->customer->name :  old('name') }}"placeholder="Enter Name">
			                        
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
			                            <input type="email" class="form-control" id="email" name="email" value="{{ isset($booked_tour) ? $booked_tour->customer->email : old('email') }}" placeholder="Enter Email">

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
			                          <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address">{{ isset($booked_tour) ? $booked_tour->customer->address : old('address') }}</textarea>
			                        
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
			                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ isset($booked_tour) ? $booked_tour->customer->contact_number : old('contact_no') }}" placeholder="Enter Contact #">

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
			                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ isset($booked_tour) ? $booked_tour->customer->nationality : old('nationality') }}" placeholder="Enter Nationality">

			                            @error('nationality')
			                                <span class="help-block">
			                                    {{ $message }}
			                                </span>
			                            @enderror
			                        </div>
								</div>
							</div>

							{{-- BOOKING --}}
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group @error('no_of_person') has-error @enderror">
										<label for="">{{ __('No. of person') }}</label>
										<input type="number" class="form-control" name="no_of_person" placeholder="Number of person" value="{{ isset($booked_tour) ? $booked_tour->no_of_persons : old('no_of_person') }}">

										@error('no_of_person')
											<span class="help-block">
												{{ $message }}
											</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group @error('tour_date') has-error @enderror">
										<label for="">{{ __('Date of tour') }}</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" name="tour_date" value="{{ isset($booked_tour) ? $booked_tour->date_of_tour : old('tour_date') }}" id="tour_date" placeholder="Date of tour">
										</div>

										@error('tour_date')
											<span class="help-block">
												{{ $message }}
											</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-4">
									<div class="bootstrap-timepicker">
						                <div class="form-group @error('pick_time') has-error @enderror">
						                  <label>{{ __('Pick up time') }}</label>

						                  <div class="input-group">
						                    <div class="input-group-addon">
						                      <i class="fa fa-clock-o"></i>
						                    </div>
						                    <input type="text" name="pick_time" class="form-control timepicker" value="{{ isset($booked_tour) ? $booked_tour->pick_up_time : old('pick_time') }}">
						                  </div>
						                </div>
						              </div>
								</div>

								<div class="col-sm-12">
									<div class="form-group @error('pick_address') has-error @enderror">
			                          <label for="pick_address">{{ __('Pick up address') }} </label>
			                          <textarea type="text" class="form-control" id="pick_address" name="pick_address" placeholder="Ex : San Roque Proper Street, Talisay City, Cebu">{{ isset($booked_tour) ? $booked_tour->pick_up_address : old('pick_address') }}</textarea>
			                        
			                            @error('pick_address')
			                                <span class="help-block">
			                                    {{ $message }}
			                                </span>
			                            @enderror
			                        </div>
								</div>
							</div>
							
							{{-- BUTTON --}}
							<div class="row">
								<div class="col-sm-6">
									<button type="submit" class="btn btn-primary btn-flat">{{ isset($booked_tour) ? __('Update') : __('Save')}}</button>
									<a href="{{ route('book-tours.index')}}" class="btn btn-danger btn-flat">Cancel</a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Title</th>
										<th>Description</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($tours as $tour)
										<tr>
											<td>
												<label>
													<input type="radio" name="tour_package" value="{{ $tour->id }}" class="@error('tour_package') has-error @enderror" {{ isset($booked_tour) && $booked_tour->tour_id == $tour->id ? 'checked' : '' }}>
												</label>

												@error('tour_package')
													<span class="help-block">
														{{ $message }}
													</span>
												@enderror
											</td>
											<td>{{ $tour->title}}</td>
											<td>{{ $tour->description}}</td>
											<td>
												<a href="" class="btn btn-primary btn-sm btn-flat">View Details</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('custom_js')
<script src="/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
	
	$(function(){

		//Date picker
		$('#tour_date').datepicker({

			autoclose : true,
			format : 'yy-mm-dd'
		})

		//Timepicker
	    $('.timepicker').timepicker({
	      showInputs: false,
	      timeFormat : 'HH:mm:ss'
	    })
	})
</script>

@endsection