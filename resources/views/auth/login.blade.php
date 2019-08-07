@extends('layouts.log-reg')


@section('title', 'Login')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login Form</h3>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Username">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="checkbox">
                                <label>Remember me</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success form-control mb-3">Login</button>
                        <div class="text-center">
                            <p>Don't have an account? <a href="{{ url('register') }}">Sign Up</a> </p>
                            <p><a href="">Forgot your password? </a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection