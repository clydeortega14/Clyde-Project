@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Create User</h3>
            </div>
            <div class="box-body">
                <form role="form" action="{{ route('user.store')}}" method="POST">
                    @csrf
                      <div class="box-body">
                        
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">{{ __('Name') }} </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"placeholder="Enter Name">
                        
                            @error('name')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">

                            @error('email')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('username') has-error @enderror">
                          <label for="username">{{ __('Username') }} </label>
                          <input type="text" class="form-control" id="username" name="username" value="{{ old('email') }}" placeholder="Enter Userame">
                        
                            @error('username')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('role') has-error @enderror">
                            <label for="role">{{ __('Role') }} </label>
                            <select type="combobox" class="form-control" id="role" name="role">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role['id'] }}">{{ $role['display_name'] }}</option>
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
                            <input type="password" class="form-control" id="password" name="password" placeholder="**********">

                            @error('password')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('password_confirmation') has-error @enderror">
                            <label for="confirm_pass">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_pass" name="password_confirmation" placeholder="**********">

                            @error('password_confirmation')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                      </div>
                  <!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-flat">Create User</button>
                        <a href="{{ route('users') }}" class="btn btn-danger btn-flat">Cancel</a>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection