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
            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
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
        <section class="content container-fluid">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3>Nuevo<a href="/cliente"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                </div>
                    <div class="box-body">
                        <div class="col-md-8 col-md-offset-2">
                            {!!Form::open(array('url'=>'cliente','method'=>'POST','autocompleted'=>'off'))!!}
                            {{Form::token()}}
                            <div class="form-group">    
                                <label for="tipdoc">Tipo documento *</label>
                                <select name="tipdoc" id="tipdoc" autofocus>
                                    <option value="1">Cédula</option>
                                    <option value="2">Nit</option>
                                </select>
                            </div>
                            <div class="form-group">    
                                <label for="nrodoc">Documento *</label>
                                <input type="text" name="nrodoc" class="numeric form-control" value="{{old('nrodoc')}}" >
                            </div>
                            <div class="form-group">
                                <label for="nit">Nombre *</label>
                                <input type="text" id="nombres" name="nombres" class="text form-control" value="{{old('nombres')}}">
                            </div>
                            <div class="form-group">
                                <label for="nit">Apellido *</label>
                                <input type="text" id="apellidos" name="apellidos" class="text form-control" value="{{old('apellidos')}}">
                            </div>
                            <div class="form-group">
                                <label for="razons">Razon Social *</label>
                                <input type="text" name="razons" class="text form-control" value="{{old('razons')}}">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección *</label>
                                <input type="text" name="direccion" class="text form-control" value="{{old('direccion')}}">
                            </div>
                            <div class="form-group">
                                <label for="idciudad">Ciudad</label>
                                <select name="idciudad" id="idciudad" class="form-control">
                                    <option value="1">BOGOTA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telefono1">Teléfono1 *</label>
                                <input type="text" id="telefono1" name="telefono1" class="numeric form-control" value="{{old('telefono1')}}">
                            </div>
                            <div class="form-group">
                                <label for="telefono2">Teléfono2</label>
                                <input type="text" id="telefono2" name="telefono2" class="numeric form-control" value="{{old('telefono2')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" name="email" class="form-control" value="{{old('email')}}">
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
@section('scripts')
<script>
    //convierte a mayúsculas
    $(".text").keyup(function(){
        this.value = this.value.toUpperCase();
    });
    //campos tipo numérico
    $(".numeric").numeric();
    //rellena ceros a la izquierda
    $("input.llena2").blur(function(){
        var n = this.value.toString();
        while(n.length < 2)
            n = "0" + n;
        this.value = n;
    });
</script>
@endsection
@endsection