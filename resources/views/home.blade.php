@extends ('layouts.admin')
@section ('wrapper')
<div id="app" class="wrapper">
    <!-- Main Header // BARRA HORIZONTAL include('layouts.partials.header')-->
    @include('layouts.partials.home.header')
    <!-- /.Main Header -->
    <!-- Main Header // BARRA VERTICAL include('layouts.partials.menu')-->
    @include('layouts.partials.home.menu')
    <!-- /.Main Header -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Bienvenido
                <small>Usuario: {{ auth()->user()->user }}</small>
            </h1>
        </section>
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            
            <div class="col-md-4 col-md-offset-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Salida</h3>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-danger">Salir</button>
                        </form>
                    </div>
                </div>  
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- Main Footer -->
    @include('layouts.footer')
    <!-- /.Main Footer -->
</div>
    <!-- /.content-wrapper -->
@endsection
