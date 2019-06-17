@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="box">
            <div class="box-header">
            	<div class="row">
            		<div class="col-md-6">
            			<h3 class="box-title">Edit User</h3>
            		</div>
            		<div class="col-md-6">
            			<div class="pull-right">
            				<form role="form" action="{{ route('user.update.status', ['id' => $user->id]) }}" method="POST">
            					@csrf
	            				<button type="submit" class="btn {{ $user->active == true ? 'btn btn-danger' : 'btn-success'}} btn-flat">{{ $user->active == true ? 'Deactivate' : 'Activate'}}</button>
	            			</form>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="box-body">
                <form role="form" action="{{ route('user.update', ['id' => $user->id])}}" method="POST">
                    @csrf
                      <div class="box-body">
                        
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">{{ __('Name') }} </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" {{ $user->active == false ? 'disabled' : '' }} placeholder="Enter Name">
                        
                            @error('name')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" {{ $user->active == false ? 'disabled' : '' }} placeholder="Enter email">

                            @error('email')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('username') has-error @enderror">
                          <label for="username">{{ __('Username') }} </label>
                          <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" {{ $user->active == false ? 'disabled' : '' }} placeholder="Enter Userame">
                        
                            @error('username')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('role') has-error @enderror">
                            <label for="role">{{ __('Role') }} </label>
                            <select type="combobox" class="form-control" id="role" name="role" {{ $user->active == false ? 'disabled' : '' }}>
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role['id'] }}" {{ $role->id == $user->role_id ? 'selected' : ''}}>{{ $role['display_name'] }}</option>
                                @endforeach
                            </select>

                            @error('role')
                                <span class="help-block">
                                   {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('password') has-error @enderror">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control" id="password" name="password" {{ $user->active == false ? 'disabled' : '' }} placeholder="**********">

                            @error('password')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('password_confirmation') has-error @enderror">
                            <label for="confirm_pass">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_pass" name="password_confirmation" {{ $user->active == false ? 'disabled' : '' }} placeholder="**********">

                            @error('password_confirmation')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                      </div>
                  <!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-flat" {{ $user->active == false ? 'disabled' : ''}} >Update</button>
                        <a href="{{ route('users') }}" class="btn btn-danger btn-flat">Cancel</a>
                      </div>
                </form>
            </div>
        </div>
	</div>
</div>
@endsection

@section('custom_js')
<script>
	
	$(document).ready(function(){

		$('#updateStatus').on('click', function(e){

			e.preventDefault();
			let id = $(this).attr('rel');

			swal({

				title : "Are you sure?",
				text : "You will not be able to recover this data",
				icon : "warning",
				buttons : true,
				dangerMode : true

			}).then((isConfirm) => {

				if(isConfirm){

					axios.post(`/user/update-status/${id}`, {

						_token : $('meta[name="csrf-token"]').attr('content')

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
					})
				}
			});
		});

	});
</script>
@endsection