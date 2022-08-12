<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FEEDER UNSRI | Login</title>
    <link rel="icon" sizes="32x32" href="{{asset('unsri_icon.png')}}" type="image/png">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

     <!-- Toastr style -->
     <link href="{{asset('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

     <!-- Gritter -->
     <link href="{{asset('assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <style>
        .vertical-align {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body class="gray-bg">

    @yield('content')

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
