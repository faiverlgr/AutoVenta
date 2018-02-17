@extends ('layouts.admin')
@section ('wrapper')
<div id="app" class="wrapper">
    @include('layouts.partials.home.header')
    @include('layouts.partials.home.menu')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Ingresos</h1>
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
        <section class="content container-fluid">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3>Crear Ingreso<a href="/ingreso"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                </div>
                    <div class="box-body">
                        {!!Form::open(array('url'=>'ingreso','method'=>'POST','autocompleted'=>'off'))!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">    
                                    <label fr="codprov">Proveedor *</label>
                                    <select name="idproveedor" id="idproveedor" class="form-control select2-container">
                                        @foreach($proveedores as $item)
                                        <option value="{{$item->id}}">{{$item->razons}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                                <div class="form-group">    
                                    <label for="anoper">Periodo</label>
                                    <input readonly type="text" name="anoper" class="form-control" value="{{$periodos->anoper}}-{{$periodos->mesper}}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                                <div class="form-group">    
                                    <label for="fecha">Fecha</label>
                                    <input id="datepicker" type="text" name="fecha" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                                <div class="form-group">    
                                    <label for="numdoc">Documento</label>
                                    <input type="text" name="numdoc" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="articulo">Articulo</label>
                                            <select name="piarticulo" id="piarticulo" class="form-control">
                                                @foreach($articulos as $art)
                                                    <option value="{{ $art->id }}">{{ $art->nomartic }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
    <script>
        $('#datepicker').datepicker();
    </script>
@endsection
@endsection