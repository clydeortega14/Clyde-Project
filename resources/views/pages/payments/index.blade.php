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
            				<a href="{{ route('payments.create') }}" class="btn btn-primary btn-flat">
            					<i class="fa fa-plus"></i>
            				</a>
            			</div>
            		</div>
            	</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="payments" class="table table-bordered table-striped">
                <thead>
	                <tr>
                      <th>ID</th>
	                  <th>Customer Name</th>
                      <th>Payment Amount</th>
	                  <th>Partial Payment</th>
	                  <th>Balance</th>
	                  <th>Status</th>
	                  <th></th>
	                </tr>
                </thead>
                <tbody>
	               
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
		</div>
	</div>
@endsection

@section('custom_js')

<script type="text/javascript">
	$(function(){

        /* PAYMENTS DATATABLE */
        paymentLists()

        function paymentLists(){

            $('#payments').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                processing : true,
                serverSide : true,
                ajax : `/get-payments-data`,
                columns : [

                    { data : 'id'},
                    { data : 'customer', name : 'customer.name'},
                    { data : 'payment_amount'},
                    { data : 'partial_pay'},
                    { data : 'balance'},
                    { data : 'status'},
                    { data : 'action'},
                ]
            })
        }
	})
</script>
@endsection