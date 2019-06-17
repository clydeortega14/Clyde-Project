@extends('layouts.master')

@section('title', 'Users')

@section('content-header')
	<h1>
        Users
  	</h1>
  	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  	</ol>
@endsection

@section('content')
	
	@include('layouts.message')

	<div class="row justify-content-center">
		<div class="col-md-12">
			
          <div class="box">
            <div class="box-header">
            	<div class="row">
            		<div class="col-md-6">
              			<h3 class="box-title">Users Lists</h3>
            		</div>
            		<div class="col-md-6">
            			<div class="pull-right">
            				<a href="{{ route('user.create') }}" class="btn btn-primary btn-flat">Add user</a>
            			</div>
            		</div>
            	</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="user-table" class="table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th>Name</th>
	                  <th>Email</th>
	                  <th>Role</th>
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

<script>
	

	$(function(){


		$('#user-table').DataTable({
			'paging'      : true,
	      	'lengthChange': false,
	      	'searching'   : true,
	      	'ordering'    : true,
	      	'info'        : true,
	      	'autoWidth'   : false,
			processing    : true,
			serverSide    : true,
			ajax          : '/users/data',
			columns       : [

				{ data : 'name', name: 'name'},
				{ data : 'email', name: 'email'},
				{ data : 'roles', name: 'roles'},
				{ data : 'status', name: 'status'},
				{ data : 'action', name: 'action'},
			]
		});

	});

	function deleteUser(id)
	{

		swal({

			title : "Are you sure?",
			text : "You will not be able to recover this data",
			icon : "warning",
			buttons : true,
			dangerMode : true

		}).then((willDelete) => {

			if(willDelete){

				axios.post(`/user/delete/${id}`, {

					_token : $('meta[name="csrf-token"]').attr('content'),
					
				}).then(res => {

					swal({

					  title: "Success!",
					  text: res.success,
					  icon: "success",
					  button: "Ok",
					});

					location.reload();

				}).catch(error => {

					console.log(error);
				});

				
			}else{

				swal({

				  title: "Abort",
				  text: "you abort the mission",
				  icon: "Info",
				  button: "Ok",
				});
			}
		
		});	
	}
</script>	
@endsection