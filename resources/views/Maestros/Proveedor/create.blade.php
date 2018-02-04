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
            <h1>Proveedores</h1>
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
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3>Nuevo Proveedor<a href="/proveedor"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                </div>
                    <div class="box-body">
                        <div class="col col-md-6 col-md-offset-3">
                            {!!Form::open(array('url'=>'proveedor','method'=>'POST','autocompleted'=>'off'))!!}
                            {{Form::token()}}
                            <div class="form-group">    
                                <label for="codprov">Codigo *</label>
                                <input tabindex="-1" type="text" name="codprov" class="form-control" placeholder="Codigo.." value="{{old('codprov')}}">
                            </div>
                            <div class="form-group">
                                <label for="nit">Nit</label>
                                <input type="text" name="nit" class="form-control" placeholder="Nit.." value="{{old('nit')}}">
                            </div>
                            <div class="form-group">
                                <label for="razons">Razon Social *</label>
                                <input type="text" name="razons" class="form-control" placeholder="Razon social.."value="{{old('razons')}}">
                            </div>
                            <div class="form-group">
                                <label for="sigla">Sigla</label>
                                <input type="text" name="sigla" class="form-control" placeholder="Sigla.." value="{{old('sigla')}}">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección *</label>
                                <input type="text" name="direccion" class="form-control" placeholder="Dirección.." value="{{old('direccion')}}">
                            </div>
                            <div class="form-group">
                                <label for="telefono1">Teléfono1</label>
                                <input type="text" name="telefono1" class="form-control" placeholder="Teléfono1.." value="{{old('telefono1')}}">
                            </div>
                            <div class="form-group">
                                <label for="telefono2">Teléfono2</label>
                                <input type="text" name="telefono2" class="form-control" placeholder="Teléfono2.." value="{{old('telefono2')}}">
                            </div>
                            <div class="form-group">
                                <label for="mail">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Correo electrónico.." value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                            </div>
                            {!!Form::close()!!}
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
              <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Main Footer -->
    @include('layouts.footer')
    <!-- /.Main Footer -->
</div>
    <!-- /.content-wrapper -->
@endsection