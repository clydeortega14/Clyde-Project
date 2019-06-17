<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Notification Server</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/DataTables-1.10.16/css/dataTables.bootstrap4.css') }} ">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/DataTables-1.10.16/css/jquery.dataTables.css') }} "> --}}

</head>
<body>
    <div id="app">
        @guest

        @else
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm"> 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="navbar-brand" href="#">IACCS CONSOLE</a></li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> Menu <span class="caret"></span></a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="nav-item">
                                    <a href="{{ route('users')}}" class="dropdown-item"><i class="fa fa-user fa-fw"></i> Users </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="{{ url('/cars') }}" class="dropdown-item"><i class="fa fa-car fa-fw"></i> Cars </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Notifications</a></li>
                    </ul>
                    <!-- Right Side Of Navbar -->

                    <!-- Authentication Links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"> <i class="fa fa-user fa-fw"></i> Profile </a>
                                <a class="dropdown-item" href="#"> <i class="fa fa-cog fa-fw"></i> Settings</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        @endguest

        <main class="py-4">
            @yield('content')
        </main>
    </div>

     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.js')}}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.16/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.js')}}"></script>

    @yield('custom_js')
</body>
</html>
