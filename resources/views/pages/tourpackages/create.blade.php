@extends('layouts.master')

@section('title', '')

@section('content')

<div class="row">
	<div class="col-md-4">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Create</h3>
          </div>
          <form role="form" action="{{ route('tour-packages.store')}}" method="POST">
            @csrf
            <div class="box-body">

              <div class="form-group @error('description') has-error @enderror">
                  <label for="description">{{ __('Description') }} </label>
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required>{{ old('description') }}</textarea>
              
                  @error('description')
                      <span class="help-block">
                          {{ $message }}
                      </span>
                  @enderror
              </div>

              <div class="form-group @error('rate') has-error @enderror">
                  <label for="rate">{{ __('Description') }} </label>
                  <input type="number" min="0" step="0.01" class="form-control" id="rate" name="rate" value="{{ old('rate') }}" placeholder="0.00" required>
              
                  @error('rate')
                      <span class="help-block">
                          {{ $message }}
                      </span>
                  @enderror
              </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-success btn-flat">Submit</button>
              
              <a href="{{ route('tour-packages.index') }}" class="btn btn-danger btn-flat">Cancel</a>
            </div>
            
          </form>
        </div>
    </div>
</div>

@endsection