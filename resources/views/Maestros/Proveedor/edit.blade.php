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
            <h1>Editar Proveedor</h1>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <a href="/proveedor"><button class="btn btn-succes">Listado</button></a>
                    </div>
                    <div class="box-body">
                        {!!Form::model($proveedor, ['route' => ['proveedor.update', $proveedor->id], 'method' => 'PATCH'])!!}
                        {{Form::token()}}
                        
                        <div class="form-group">
                            <label for="codprov">Codigo *</label>
                            <input disabled type="text" name="codprov" class="form-control" value="{{$proveedor->codprov}}">
                        </div>
                        <div class="form-group">
                            <label for="nit">Nit</label>
                            <input type="text" name="nit" class="form-control" value="{{$proveedor->nit}}">
                        </div>
                        <div class="form-group">
                            <label for="razons">Razon Social *</label>
                            <input type="text" name="razons" class="form-control" value="{{$proveedor->razons}}">
                        </div>
                        <div class="form-group">
                            <label for="sigla">Sigla</label>
                            <input type="text" name="sigla" class="form-control" value="{{$proveedor->sigla}}">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección *</label>
                            <input type="text" name="direccion" class="form-control" value="{{$proveedor->direccion}}">
                        </div>
                        <div class="form-group">
                            <label for="telefono1">Teléfono1</label>
                            <input type="text" name="telefono1" class="form-control" value="{{$proveedor->telefono1}}">
                        </div>
                        <div class="form-group">
                            <label for="telefono2">Teléfono2</label>
                            <input type="text" name="telefono2" class="form-control" value="{{$proveedor->telefono2}}">
                        </div>
                        <div class="form-group">
                            <label for="mail">Email</label>
                            <input type="email" name="email" class="form-control" value="{{$proveedor->email}}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                            <button class="btn btn-sm btn-danger" type="reset">Cancelar</button>
                        </div>
                        {!!Form::close()!!}
                    </div>
                    <!-- /.box-body -->
                </div>
              <!-- /.box -->
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