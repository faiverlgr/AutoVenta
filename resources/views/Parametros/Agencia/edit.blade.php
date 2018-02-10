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
            <h1>Agencias</h1>
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
                    <h3>Editar Agencia<a href="/agencia"><button class="btn btn-md btn-succes pull-right">Listado</button></a></h3>
                </div>
                <div class="box-body">
                    <div class="col col-md-6 col-md-offset-3">
                        {!!Form::model($agencia, ['route' => ['agencia.update', $agencia->id], 'method' => 'PATCH'])!!}
                        {{Form::token()}}
                            <div class="form-group">    
                                <label for="codage">Codigo *</label>
                                <input type="text" readonly name="codage" class="form-control" value="{{ $agencia->codage }}">
                            </div>
                            <div class="form-group">    
                                <label for="nitage">Nit</label>
                                <input type="text" name="nitage" class="form-control" value="{{ $agencia->nitage }}">
                            </div>
                            <div class="form-group">
                                <label for="nit">Nombre *</label>
                                <input type="nombre" name="nombre" class="form-control" value="{{ $agencia->nombre }}">
                            </div>
                            <div class="form-group">
                                <label for="nomrepre">Representante Legal *</label>
                                <input type="text" name="nomrepre" class="form-control" value="{{ $agencia->nomrepre }}">
                            </div>
                            <div class="form-group">
                                <label for="docrepre">Documento Representante *</label>
                                <input type="text" name="docrepre" class="form-control" value="{{ $agencia->docrepre }}">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección *</label>
                                <input type="text" name="direccion" class="form-control" value="{{ $agencia->direccion }}">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Barrio *</label>
                                <input type="text" name="barrio" class="form-control" value="{{ $agencia->barrio }}">
                            </div>
                            <div class="form-group">
                                <label for="telefono1">Teléfono1</label>
                                <input type="text" name="telefono1" class="form-control" value="{{ $agencia->telefono1 }}">
                            </div>
                            <div class="form-group">
                                <label for="telefono2">Teléfono2</label>
                                <input type="text" name="telefono2" class="form-control" value="{{ $agencia->telefono2 }}">
                            </div>
                            <div class="form-group">
                                <label for="mail">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $agencia->email }}">
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