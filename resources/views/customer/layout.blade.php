<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Support System</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

@include('navbar')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('admin.partials.sidebar')
        </div>

        <div class="col-md-9 py-2">
            @yield('content')
        </div>
    </div>

</div>

<script src="{{ asset('/assets/js/bootstrap.bundle.min.js') }}"> </script>
<script src="{{ asset('/assets/js/jquery.min.js') }}"> </script>
</body>
</html>
