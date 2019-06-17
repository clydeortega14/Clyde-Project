@extends('layouts.master')

@section('title', 'Main')

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
        				<a href="{{ route('cars.create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i></a>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                  <th>Brand</th>
                  <th>Model</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
               
               @foreach($cars as $car)
					<tr>
						<td>{{ $car->brand}}</td>
						<td>{{ $car->model}}</td>
						<td>
							<span class="{{ $car->available == true ? 'label label-success' : 'label label-danger'}}">{{ $car->available == true ? 'Available' : 'Not Available'}}
							<span>
						</td>
						<td>
							<form action="{{ route('car.destroy', ['id' => $car->id]) }}" method="POST">
								@csrf
								@method('DELETE')
							<a href="{{ route('cars.edit', ['id' => $car->id]) }}" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" title="Edit">
								<i class="fa fa-edit"></i>
							</a>
								<button class="btn btn-danger btn-sm btn-flat" data-toggle="tooltip" title="Remove">
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