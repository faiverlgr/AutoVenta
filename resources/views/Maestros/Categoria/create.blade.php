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
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">            
            <div class="box box-info">
                <div class="box-header with-border">
                    <h4>Nueva Categoria<a href="/categoria"><button class="btn btn-md btn-succes pull-right">Listado</button></a></h4>
                </div>
                <div id="app" class="box-body">
                    <div class="col col-md-6 col-md-offset-3">
                        {!!Form::open(array('name'=>'form', 'url'=>'categoria', 'method'=>'POST', 'autocompleted'=>'off'))!!}
                        {{Form::token()}}
                        <div class="form-group">                        
                            <label for="codprov">Proveedor *</label>
                            <div class="row">
                                <div class="col col-md-3">                            
                                    <select class="form-control" name="codprov" id="selector" onchange="myFunction()">
                                        @foreach($proveedores as $prov)
                                        <option value="{{$prov->codprov}}">{{$prov->codprov}}</option>
                                        <option hidden value="{{$prov->razons}}">{{$prov->razons}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-md-9">
                                    <input disabled id="detalle" class="form-control"type="text" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="codcate">Categoria *</label>
                            <input type="text" id="codcate" name="codcate" onchange="uneCodigo()" class="form-control" placeholder="Categoria.." value="{{old('codcate')}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre *</label>
                            <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>
                        <input name="validaCate" id="validaCate"></input>
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
        function myFunction(){
            desc=form.selector.options[form.selector.selectedIndex+1].value;
            $('#detalle').val(desc);
        };

        function uneCodigo(){
            var valor1 = document.getElementById('selector').value;
            var valor2 = document.getElementById('codcate').value;
            document.getElementById('validaCate').value = valor1+valor2;
        };
        
    </script>
    <!-- Select2 -->
    @endsection
@endsection