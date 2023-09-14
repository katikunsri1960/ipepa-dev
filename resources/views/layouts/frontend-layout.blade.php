<!doctype html>
<html lang="en" dir="ltr">
  <head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('unsri_icon.png')}}" />

		<!-- TITLE -->
		<title>{{ config('app.name', 'Laravel') }}</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- BOOTSTRAP CSS -->
		<link id="style" href="{{asset('assets-new/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{asset('assets-new/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets-new/css/plugins.css')}}" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<!--- FONT-ICONS CSS -->
		<link href="{{asset('assets-new/css/icons.css')}}" rel="stylesheet"/>
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
        <div id="loading-overlay">
            <div id="loading-spinner"></div>
        </div>
		<!-- BACKGROUND-IMAGE -->
		<div>

			<!-- GLOABAL LOADER -->
			<div id="global-loader">
				<img src="{{asset('assets-new/images/loader.svg')}}" class="loader-img" alt="Loader">
			</div>
			<!-- /GLOABAL LOADER -->
            @yield('content')


		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->

		<!-- JQUERY JS -->
		<script src="{{asset('assets-new/js/jquery.min.js')}}"></script>

        <!-- BOOTSTRAP JS -->
        <script src="{{asset('assets-new/plugins/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('assets-new/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		<!-- SPARKLINE JS -->
		<script src="{{asset('assets-new/js/jquery.sparkline.min.js')}}"></script>

		<!-- CHART-CIRCLE JS -->
		<script src="{{asset('assets-new/js/circle-progress.min.js')}}"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="{{asset('assets-new/plugins/p-scroll/perfect-scrollbar.js')}}"></script>

		<!-- INPUT MASK JS -->
		<script src="{{asset('assets-new/plugins/input-mask/jquery.mask.min.js')}}"></script>

        <!-- Color Theme js -->
        <script src="{{asset('assets-new/js/themeColors.js')}}"></script>

        <!-- swither styles js -->
        <script src="{{asset('assets-new/js/swither-styles.js')}}"></script>

        <!-- CUSTOM JS -->
        <script src="{{asset('assets-new/js/custom.js')}}"></script>
        @stack('js')

	</body>
</html>
