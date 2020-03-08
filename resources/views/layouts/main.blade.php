<html>
<head>
    <title>App Name - @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    .list .row:nth-of-type(odd) {
        background: #e0e0e0;
    }
    .list .row:nth-of-type(even) {
        background: #FFFFFF;
    }
    .list .row {
        min-height: 45px;
    }
</style>
<body>
@section('sidebar')

@show

<div class="container pt-4">
    @yield('content')
</div>
</body>
</html>