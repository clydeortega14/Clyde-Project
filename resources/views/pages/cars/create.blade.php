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
                <form role="form" action="{{ route('car.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        
                        <div class="form-group @error('brand') has-error @enderror">
                            <label for="brand">{{ __('Brand') }} </label>
                            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}"placeholder="Enter Brand" required>
                        
                            @error('brand')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="form-group @error('model') has-error @enderror">
                            <label for="model">{{ __('Model') }}</label>
                            <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" placeholder="Enter Model" required>

                            @error('model')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('plate_no') has-error @enderror">
                          <label for="plate_no">{{ __('Plate No.') }} </label>
                          <input type="text" class="form-control" id="plate_no" name="plate_no" value="{{ old('plate_no') }}" placeholder="Enter Plate No" required>
                        
                            @error('plate_no')
                                <span class="help-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group @error('max_person') has-error @enderror">
                            <label for="max_person">{{ __('Max Person') }}</label>
                            <input type="number" min="1" class="form-control" id="max_person" name="max_person" value="1" required>

                            @error('max_person')
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
                        <a href="{{ route('cars') }}" class="btn btn-danger btn-flat">Cancel</a>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection