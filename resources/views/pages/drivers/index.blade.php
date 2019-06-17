@extends('layouts.master')

@section('title', '')

@section('content')

@include('layouts.message')

<div class="row justify-content-center">
	<div class="col-md-12">
		
	    <div class="box">
	        <div class="box-header">
	        	<div class="row">
	        		<div class="col-md-6">
	          			<h3 class="box-title"></h3>
	        		</div>
	        		<div class="col-md-6">
	        			<div class="pull-right">
	        				<a href="{{ route('drivers.create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i></a>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	          <table id="example2" class="table table-bordered table-striped">
	            <thead>
	                <tr>
	                  <th>Name</th>
	                  <th>Address</th>
	                  <th>Contact No</th>
	                  <th>Action</th>
	                </tr>
	            </thead>
	            <tbody>
					@foreach($drivers as $driver)
						<tr>
							<td>{{ $driver->name }}</td>
							<td>{{ $driver->address }}</td>
							<td>{{ $driver->contact_no }}</td>
							<td>
								<form action="{{ route('drivers.destroy', ['id' => $driver->id]) }}" method="POST">
									@csrf
								    @method('DELETE')
								<a href="{{ route('drivers.edit', ['id' => $driver->id]) }}" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" title="Edit">
									<i class="fa fa-edit"></i>
								</a>
									<button type="submit" class="btn btn-danger btn-sm btn-flat" data-toggle="tooltip" title="Remove">
										<i class="fa fa-trash"></i> 
									</button>
								</form>
							</td>
						</tr>
					@endforeach
	            </tbody>
	          </table>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

@endsection