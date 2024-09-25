<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Support System</title>
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

@include('navbar')

<div class="container">
    <div class="row py-2">
        <div class="col-md-6 m-auto">

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email Address">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <button class="btn btn-success">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('/assets/js/bootstrap.bundle.min.js') }}"> </script>
<script src="{{ asset('/assets/js/jquery.min.js') }}"> </script>
</body>
</html>

