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
            <h1>Clientes</h1>
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
                    <h3>Editar Cliente<a href="/proveedor"><button class="btn btn-md btn-succes pull-right">Listado</button></a></h3>
                </div>
                <div class="box-body">
                    <div class="col col-md-6 col-md-offset-3">
                        {!!Form::model($cliente, ['route' => ['cliente.update', $cliente->id], 'method' => 'PATCH'])!!}
                        {{Form::token()}}
                            <div class="form-group">
                                <label for="codprov">Codigo *</label>
                                <input disabled type="text" name="codprov" class="form-control" value="{{$cliente->codprov}}">
                            </div>
                            <div class="form-group">
                                <label for="nit">Nit</label>
                                <input type="text" name="nit" class="form-control" value="{{$cliente->nit}}">
                            </div>
                            <div class="form-group">
                                <label for="razons">Razon Social *</label>
                                <input type="text" name="razons" class="form-control" value="{{$cliente->razons}}">
                            </div>
                            <div class="form-group">
                                <label for="sigla">Sigla</label>
                                <input type="text" name="sigla" class="form-control" value="{{$cliente->sigla}}">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección *</label>
                                <input type="text" name="direccion" class="form-control" value="{{$cliente->direccion}}">
                            </div>
                            <div class="form-group">
                                <label for="telefono1">Teléfono1</label>
                                <input type="text" name="telefono1" class="form-control" value="{{$cliente->telefono1}}">
                            </div>
                            <div class="form-group">
                                <label for="telefono2">Teléfono2</label>
                                <input type="text" name="telefono2" class="form-control" value="{{$cliente->telefono2}}">
                            </div>
                            <div class="form-group">
                                <label for="mail">Email</label>
                                <input type="email" name="email" class="form-control" value="{{$cliente->email}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-sm btn-danger" type="reset">Cancelar</button>
                            </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.footer')
</div>
@endsection