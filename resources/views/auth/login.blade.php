<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vmisoft</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            background: #ffffff url("img/photo5.jpg") no-repeat center;
            background-size: cover;
            -moz-background-size: cover;
            -webkit-background-size: cover;
            -o-background-size: cover;;
        }
        .row{
            margin-top: 15em;
        }
    </style>

    </head>

    <body>  
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="http://localhost/larajquery/public" class="navbar-brand">
                        Sistema
                    </a>
                </div> 
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h4>Acceso a la aplicación</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('login')}}">
                                {{ csrf_field() }}      
                                
                                <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                                    <label for="Usuario">Usuario</label>
                                    <input class="form-control" type="text" name="user" value="faiver">
                                    {!! $errors->first('user', '<span class="help-block">:message</span>') !!}
                                </div>
                                
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="Contraseña">Contraseña</label>
                                    <input class="form-control" type="password" name="password" value="secret">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Acceder</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>



        
                

