@extends('layouts.master')

@section('title', '')

@section('content')
  
  @include('layouts.message')

  <div class="row justify-content-center">
    <div class="col-md-8">
      
          <div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-md-6">
                    <h3 class="box-title"></h3>
                </div>
                <div class="col-md-6">
                  <div class="pull-right">
                    <a href="{{ route('tour-packages.create') }}" class="btn btn-primary btn-flat">
                      <i class="fa fa-plus"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Description</th>
                    <th>Rate</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($tourPackages as $tour)
                      <tr>
                        <td>{{ $tour->description }}</td>
                        <td>{{ number_format($tour->rate, 2) }}</td>
                        <td>
                          <form action="{{ route('tour-packages.destroy', ['id' => $tour->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('tour-packages.edit', ['id' => $tour->id]) }}" class="btn btn-primary btn-sm btn-flat">
                              <i class="fa fa-edit"></i>
                            </a>
                            <button type="submit" class="btn btn-danger btn-sm btn-flat">
                              <i class="fa fa-trash"></i>
                            </button>
                          </form>
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
