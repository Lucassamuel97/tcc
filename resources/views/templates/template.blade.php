<!DOCTYPE html>
<html>
<head>
    <title>Crud com laravel</title>
    <link rel="stylesheet" type="text/css" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
	 @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
     @endif

	@yield('content')		
	<script src="{{url('assets/js/javascript.js')}}"> </script>
</body>
</html>