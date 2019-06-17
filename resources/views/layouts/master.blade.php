<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Laravel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  @include('layouts.partials.styles')

</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

	  @include('layouts.partials.header')


	  @include('layouts.partials._sidebar')

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">

	  	<section class="content-header">@yield('content-header')</section>

	   	<section class="content">
	   		
	    	@yield('content')

	   	</section>
	  </div>

	  <!-- /.content-wrapper -->
	</div>
<!-- ./wrapper -->

@include('layouts.partials.scripts')

</body>
</html>
