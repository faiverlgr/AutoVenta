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
            <h1>Categorias</h1>
            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </section>
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">            
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Editar Categoria<a href="/categoria"><button class="btn btn-md btn-succes pull-right">Listado</button></a></h4>
                </div>
                <div class="box-body">
                    <div class="col col-md-6 col-md-offset-3">
                        {!!Form::model($categoria, ['route' => ['categoria.update', $categoria->id], 'method' => 'PATCH'])!!}
                        {{Form::token()}}
                        <div class="form-group">                        
                            <label for="codprov">Proveedor *</label>
                            <div class="row">
                                <div class="col col-md-3">
                                    <input disabled class="form-control" type="text" value="{{ $categ->codprov }}">
                                </div>
                                <div class="col col-md-8">
                                    <input disabled class="form-control"type="text" value="{{ $categ->razons }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="codcate">Categoria *</label>
                            <input disabled type="text" name="codcate" class="form-control" value="{{ $categ->codcate }}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $categ->nombre }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            {{--  <pre>
                @   {{ $proveedores }}
            </pre>  --}}
        </section>
        <!-- /.content -->
    </div>
    <!-- Main Footer -->
    @include('layouts.footer')
    <!-- /.Main Footer -->
</div>
    <!-- /.content-wrapper -->
    @section('scripts')
    <script>            

    </script>
    <!-- Select2 -->
    @endsection
@endsection