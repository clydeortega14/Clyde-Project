@extends('layouts.master')

@section('title', '')

@section('content')
  
  @include('layouts.message')

  <div class="row">
    <div class="col-md-4">
      <div class="box box-primary">
          <form role="form" action="{{ isset($tour) ? route('tour-packages.update', ['id' => $tour->id]) : route('tour-packages.store')}}" method="POST">
            @csrf
            @if(isset($tour))
              @method('PUT')
            @endif
            <div class="box-body">
              
              <div class="form-group @error('title') has-error @enderror">
                  <label for="title">{{ __('Title of tour') }} </label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ isset($tour) ? $tour->title : old('title') }}" required>
              
                  @error('title')
                      <span class="help-block">
                          {{ $message }}
                      </span>
                  @enderror
              </div>

              <div class="form-group @error('description') has-error @enderror">
                  <label for="description">{{ __('Description') }} </label>
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required>{{ isset($tour) ? $tour->description : old('description') }}</textarea>
              
                  @error('description')
                      <span class="help-block">
                          {{ $message }}
                      </span>
                  @enderror
              </div>

              @if(isset($tour))
                  <div class="form-group @error('available') has-error @enderror">
                      <label for="available">{{ __('Status') }} </label>
                      <select type="combobox" class="form-control" id="available" name="available" required>
                          <option value="1" {{ $tour->available == 1 ? 'selected' : '' }}>Active</option>
                          <option value="0" {{ $tour->available == 0 ? 'selected' : '' }} >Deactivate</option>
                      </select>
                  
                      @error('available')
                          <span class="help-block">
                              {{ $message }}
                          </span>
                      @enderror
                  </div>
              @endif
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat">{{ isset($tour) ? 'Update' : 'Save'}}</button>
              
              <a href="{{ route('tour-packages.index') }}" class="btn btn-danger btn-flat">Cancel</a>
            </div>
        </form>
      </div>
      
    </div>
    <div class="col-md-8">
      
          <div class="box">
            <div class="box-header"></div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Available</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($tourPackages as $tour)
                      <tr>
                        <td>{{ $tour->title }}</td>
                        <td>{{ $tour->description}}</td>
                        <td>
                          <span class="{{ $tour->available == true ? 'label label-success' : 'label label-danger'}}">{{ $tour->available == 1 ? 'YES' : 'NO'}}</span>
                        </td>
                        <td>
                         
                            <a href="{{ route('tour-packages.edit', ['id' => $tour->id]) }}" class="btn btn-primary btn-sm btn-flat">
                              <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('tour-packages.show', ['id' => $tour->id]) }}" class="btn btn-info btn-sm btn-flat">
                               View More
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
