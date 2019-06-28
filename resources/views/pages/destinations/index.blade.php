@extends('layouts.master')

@section('title', '')

@section('content')

@include('layouts.message')

<div class="row">

	<div class="col-md-4">
		<div class="box box-primary">
			<div class="box-header"></div>
			<div class="box-body">
				<form role="form" action="{{ isset($destination) ? route('destinations.update', ['id' => $destination->id ]) : route('destinations.store') }}" method="POST">
			    	@csrf
					@if(isset($destination))
						@method('PUT')
					@endif
				    <div class="modal-body">
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group @error('destination') has-error @enderror">
		                            <label for="destination">{{ __('Destination') }} </label>
		                            <input type="text" class="form-control" id="destination" name="destination" value="{{ isset($destination) ? $destination->destination : old('destination') }}" placeholder="Destination" required>
		                        
		                            @error('destination')
		                                <span class="help-block">
		                                    {{ $message }}
		                                </span>
		                            @enderror

		                        </div>

		                        <div class="form-group @error('rate') has-error @enderror">
		                            <label for="rate">{{ __('Rate') }} </label>
		                            <input type="number" step="any" class="form-control" id="rate" name="rate" value="{{ isset($destination) ? $destination->rate :  old('rate') }}" placeholder="Enter rate" required>
		                        
		                            @error('rate')
		                                <span class="help-block">
		                                    {{ $message }}
		                                </span>
		                            @enderror

		                        </div>
							</div>
						</div>
				    </div>

				    <div class="modal-footer">
				        <button type="submit" class="btn btn-primary btn-flat">{{ isset($destination) ? __('Update') : __('Submit') }}</button>
				        <a href="{{ route('destinations.index') }}" class="btn btn-danger btn-flat">Cancel</a>
				    </div>
			  	</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header"></div>
			<div class="box-body">
				<table id="destinations-table" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                  <th>ID</th>
		                  <th>Destination</th>
		                  <th>Rate</th>
		                  <th></th>
		                </tr>
	                </thead>
	                <tbody>
		               
	                </tbody>
              	</table>
			</div>
		</div>
	</div>
</div>

@endsection

@section('custom_js')
<script>
	
	$(function(){

		$('#destinations-table').DataTable({

			'paging'      : true,
	      	'lengthChange': false,
	      	'searching'   : true,
	      	'ordering'    : true,
	      	'info'        : true,
	      	'autoWidth'   : false,
	      	processing : true,
	      	serverSide : true,
	      	ajax : `/get-destinations`,
	      	columns : [

	      		{data : 'id'},
	      		{data : 'destination'},
	      		{data : 'rate'},
	      		{data : 'action'},
	      	]
		})
	})
</script>

@endsection