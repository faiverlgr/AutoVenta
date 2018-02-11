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
                        <h3>Crear Agencia<a href="/agencia"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                    </div>
                        <div class="box-body">
                            <div class="col col-md-8 col-md-offset-2">
                                {!!Form::open(array('url'=>'agencia', 'method'=>'POST', 'autocompleted'=>'off', 'id'=>'myForm'))!!}
                                {{Form::token()}}
                                <div class="form-group">    
                                    <label for="codage">Codigo *</label>
                                    <input type="text" name="codage" class="numeric form-control" value="{{old('codage')}}">
                                </div>
                                <div class="form-group">    
                                    <label for="nitage">Nit</label>
                                    <input type="text" name="nitage" class="numeric form-control" value="{{old('nitage')}}">
                                </div>
                                <div class="form-group">
                                    <label for="nit">Nombre *</label>
                                    <input onkeyup="May(this)" type="nombre" name="nombre" class="text form-control" value="{{old('nombre')}}">
                                </div>
                                <div class="form-group">
                                    <label for="nomrepre">Representante Legal *</label>
                                    <input onkeyup="May(this)" type="text" name="nomrepre" class="text form-control" value="{{old('nomrepre')}}">
                                </div>
                                <div class="form-group">
                                    <label for="docrepre">Documento Representante *</label>
                                    <input type="text" name="docrepre" class="numeric form-control" value="{{old('docrepre')}}">
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección *</label>
                                    <input onkeyup="May(this)" type="text" name="direccion" class="text form-control" value="{{old('direccion')}}">
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Barrio *</label>
                                    <input type="text" name="barrio" class="text form-control" value="{{old('barrio')}}">
                                </div>
                                <div class="form-group">
                                    <label for="telefono1">Teléfono1</label>
                                    <input type="text" name="telefono1" class="numeric form-control" value="{{old('telefono1')}}">
                                </div>
                                <div class="form-group">
                                    <label for="telefono2">Teléfono2</label>
                                    <input type="text" name="telefono2" class="numeric form-control" value="{{old('telefono2')}}">
                                </div>
                                <div class="form-group">
                                    <label for="mail">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                </div>
                                {!!Form::close()!!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>
    @section('scripts')
    <script>
        $(".text").keyup(function(){
            this.value = this.value.toUpperCase();
        });
        
        $(".numeric").numeric();

//        $(document).ready(function(){

    </script>
    @endsection
@endsection