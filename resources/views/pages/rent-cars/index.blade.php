@extends('layouts.master')

@section('title', '')

@section('content')

<div class="row">
  
  @include('layouts.message')

	<div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
        	<div class="row">
        		<div class="col-md-6">
          			<h3 class="box-title"></h3>
        		</div>
        		<div class="col-md-6">
        			<div class="pull-right">
        				<a href="{{ route('book.reservation') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i></a>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="box-body">
          <table id="rent-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Contact Number</th>
                  <th>Selected Car</th>
                  <th>Pick Up address</th>
                  <th>Pick up date</th>
                  <th>Drop off date</th>
                  <th>Status</th>
                  <th>Action</th>
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

		initRent()

		function initRent(){

			$('#rent-table').DataTable({

				    'paging'      : true,
		      	'lengthChange': false,
		      	'searching'   : true,
		      	'ordering'    : true,
		      	'info'        : true,
		      	'autoWidth'   : false,
		      	processing: true,
		      	serverSide : true,
		      	ajax : `/rent-list-data`,
		      	columns : [
		      		{data : 'id'},
		      		{data : 'customer', name : 'customer.name'},
		      		{data : 'contact', name : 'customer.contact_number'},
		      		{data : 'car', name : 'car.model'},
		      		{data : 'pick_up_address', name : 'pick_up_address'},
		      		{data : 'pick_up_date', name: 'pick_up_date'},
		      		{data : 'drop_off_date', name : 'drop_off_date'},
		      		{data : 'status', name : 'status.status'},
		      		{data : 'action', name : 'action'},
		      	]
			})
		}

	})
</script>

@endsection