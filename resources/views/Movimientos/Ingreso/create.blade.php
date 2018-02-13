@extends ('layouts.admin')
@section ('wrapper')
<div id="app" class="wrapper">
    <!-- Main Header // BARRA HORIZONTAL include('layouts.partials.header')-->
    @include('layouts.partials.home.header')
    <!-- Main Header // BARRA VERTICAL include('layouts.partials.menu')-->
    @include('layouts.partials.home.menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3>Crear Ingreso<a href="/ingreso"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                </div>
                    <div class="box-body">
                        {!!Form::open(array('url'=>'ingreso','method'=>'POST','autocompleted'=>'off'))!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                <div class="form-group">    
                                    <label fr="codprov">Proveedor *</label>
                                    <select name="idproveedor" id="idproveedor" class="form-control">
                                        @foreach($proveedores as $item)
                                        <option value="{{$item->id}}">{{$item->razons}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">    
                                    <label for="anoper">Periodo</label>
                                    <input readonly type="text" name="anoper" class="form-control" value="{{$periodos->anoper}}-{{$periodos->mesper}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="form-group">    
                                            <label for="articulo">Articulo</label>
                                            <select name="piarticulo" class="form-control" id="piarticulo">
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
@endsection