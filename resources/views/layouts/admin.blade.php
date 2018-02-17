<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="https://cdn.jsdelivr.net/gh/atatanasov/gijgo@1.8.0/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <title>Vmisoft</title>
        @yield('styles')
    </head>
    <body class="hold-transition skin-blue layout-boxed sidebar-mini">
        <div id="vmisoft">
            @yield('wrapper')
        </div>
        <script src="{{asset('js/app.js')}}"></script>
        
        @yield('scripts')
        <script src="https://cdn.jsdelivr.net/gh/atatanasov/gijgo@1.8.0/dist/combined/js/gijgo.min.js" type="text/javascript"></script>        
    </body>
</html>
    <!--
        BODY TAG OPTIONS:
        =================
        Apply one or more of the following classes to get the
        desired effect
        |---------------------------------------------------------|
        | SKINS         | skin-blue                               |
        |               | skin-black                              |
        |               | skin-purple                             |
        |               | skin-yellow                             |
        |               | skin-red                                |
        |               | skin-green                              |
        |---------------------------------------------------------|
        |LAYOUT OPTIONS | fixed                                   |
        |               | layout-boxed                            |
        |               | layout-top-nav                          |
        |               | sidebar-collapse                        |
        |               | sidebar-mini                            |
        |---------------------------------------------------------|
    -->
