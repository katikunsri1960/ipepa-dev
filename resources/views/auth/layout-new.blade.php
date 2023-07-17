<!doctype html>
<html lang="en" dir="ltr">
  <head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('unsri_icon.png')}}" />

         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- TITLE -->
		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- BOOTSTRAP CSS -->
		<link id="style" href="{{asset('assets-new/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{asset('assets-new/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets-new/css/plugins.css')}}" rel="stylesheet"/>

		<!--- FONT-ICONS CSS -->
		<link href="{{asset('assets-new/css/icons.css')}}" rel="stylesheet"/>

	</head>

	<body class="login-img">

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

	</body>
</html>
