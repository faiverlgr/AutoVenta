<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">   
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        @yield('styles')
        <title>Vmisoft</title>
    </head>
    <body class="hold-transition skin-blue layout-boxed sidebar-mini">
        <div id="vmisoft">
            @yield('wrapper')
        </div>
        <script src="{{asset('js/app.js')}}"></script>
        @yield('scripts')
    </body>
</html>
