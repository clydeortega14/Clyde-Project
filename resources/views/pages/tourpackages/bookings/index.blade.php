@extends('layouts.master')

@section('title', '')

@section('content')

@include('layouts.message')

<div class="row">
	<div class="col-md-12">
	    <div class="box">
	        <div class="box-header">
	        	<div class="row">
	        		<div class="col-md-6">
	          			<h3 class="box-title"></h3>
	        		</div>
	        		<div class="col-md-6">
	        			<div class="pull-right">
	        				<a href="{{ route('book-tours.create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i><span> Book Now</span></a>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	          <table id="example2" class="table table-bordered table-striped">
	            <thead>
	                <tr>
	                  <th>Customer</th>
	                  <th>Contact Number</th>
	                  <th>Date of Tour</th>
	                  <th></th>
	                </tr>
	            </thead>
	            <tbody>
					@foreach($tours as $tour)
						<tr>
							<td>{{ $tour->customer->name}}</td>
							<td>{{ $tour->customer->contact_number}}</td>
							<td>{{ $tour->date_of_tour }}</td>
							<td>
								<a href="{{ route('book-tours.edit', ['id' => $tour->id]) }}" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" title="Edit">
									<i class="fa fa-edit"></i> 
								</a> |

								<a href="" class="btn btn-warning btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Manage Payment">
									<i class="fa fa-money"></i>
								</a> |

								<button type="button" class="btn btn-danger btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Remove">
									<i class="fa fa-trash"></i> 
								</a>
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