@extends('layouts.master')

@section('title', '')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Edit</h3>
            </div>
            <div class="box-body">
                <form role="form" action="{{ route('drivers.update', ['id' => $driver->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">{{ __('Name') }} </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $driver->name }}"placeholder="Enter Name" required>
                        
                            @error('name')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="form-group @error('address') has-error @enderror">
                          <label for="address">{{ __('Address') }} </label>
                          <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>{{ $driver->address }}</textarea>
                        
                            @error('address')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $driver->email }}" placeholder="Enter Email">

                            @error('email')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('contact_no') has-error @enderror">
                            <label for="contact_no">{{ __('Contact#') }}</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $driver->contact_no }}" placeholder="Enter Contact #" required>

                            @error('contact_no')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('gender') has-error @enderror">
                            <label>{{ __('Gender') }}</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="male" {{ $driver->gender == 'male' ? 'checked' : ''}}>
                                    {{ __('Male') }}
                                </label>

                                <label>
                                    <input type="radio" name="gender" value="female" {{ $driver->gender == 'female' ? 'checked' : ''}}>
                                    {{ __('Female') }}
                                </label>
                            </div>

                            @error('gender')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('birthdate') has-error @enderror">
                            <label class="birthdate">{{ __('Birthdate') }}</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $driver->birthdate }}">

                            @error('birthdate')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('nationality') has-error @enderror">
                            <label for="nationality">{{ __('Nationality') }}</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $driver->nationality }}" placeholder="Enter Nationality" required>

                            @error('nationality')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
                  <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-flat">Submit</button>
                    <a href="{{ route('drivers.index') }}" class="btn btn-danger btn-flat">Cancel</a>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection