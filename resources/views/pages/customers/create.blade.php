@extends('layouts.master')

@section('title', '')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Create</h3>
            </div>
            <div class="box-body">
                <form role="form" action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">{{ __('Name') }} </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"placeholder="Enter Name" required>
                        
                            @error('name')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">

                            @error('email')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('address') has-error @enderror">
                          <label for="address">{{ __('Address') }} </label>
                          <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>{{ old('address') }}</textarea>
                        
                            @error('address')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('contact_no') has-error @enderror">
                            <label for="contact_no">{{ __('Contact#') }}</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact #" required>

                            @error('contact_no')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('nationality') has-error @enderror">
                            <label for="nationality">{{ __('Nationality') }}</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter Nationality" required>

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
                        <a href="{{ route('customers.index') }}" class="btn btn-danger btn-flat">Cancel</a>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection