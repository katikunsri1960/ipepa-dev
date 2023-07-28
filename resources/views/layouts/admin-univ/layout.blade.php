<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- FAVICON -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('unsri_icon.png')}}" />

    <title>{{ config('title', 'Universitas Sriwijaya') }}</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('assets/fontawesome6/css/all.min.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('assets/fontawesome6/css/fontawesome.min.css')}}"> --}}
    <link href="{{asset('assets/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> --}}
    <!-- Toastr style -->
    <link href="{{asset('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <style>
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 9999;
        }

        #loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 3px solid #fff;
            border-top-color: #ff7f00;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
    @stack('css')

</head>

<body>

    <div id="wrapper">

        @include('layouts.admin-univ.partial.sidebar')

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">{{auth()->user()->name}}</span>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>

            {{-- @include('layouts.admin-univ.partial.breadcrumb') --}}

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                        <!-- <div class="ibox float-e-margins">
                            <div class="ibox-content text-center p-md">
                                <h1>TEST TEXT</h1>
                            </div>
                        </div> -->
                    </div>
                </div>

            </div>

            @include('layouts.admin-univ.partial.footer')

        </div>
    </div>



    <!-- Mainly scripts -->
    <script src="{{asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    {{-- <script src="{{asset('assets/fontawesome6/js/fontawesome.min.js')}}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{asset('assets/js/plugins/dataTables/datatables.min.js')}}"></script>
    @stack('scripts')

    <!-- Custom and plugin javascript -->
    <script src="{{asset('assets/js/inspinia.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pace/pace.min.js')}}"></script>

    <script src="{{asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>


</body>

</html>
