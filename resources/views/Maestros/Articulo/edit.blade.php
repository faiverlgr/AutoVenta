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
            <h1>Articulos</h1>
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
                    <div class="col col-md-10 col-md-offset-1">
                        {!!Form::model($articulo, ['route' => ['articulo.update', $articulo->id], 'method' => 'PATCH'])!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="codprov">codprov</label>
                                    <input id="codprov" readonly type="text" name="codprov" class="form-control" value="{{old('codprov')}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="#">Nombre</label>
                                    <input id="razons" readonly type="text" name="razons" class="form-control" value="{{old('razons')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="codprov">Codcate</label>
                                    <input id="codcate" readonly type="text" name="codcate" class="form-control" value="{{old('codcate')}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label" for="nomcate">Nombre</label>
                                    <input id="nombre" readonly type="text" name="nomcate" class="form-control" value="{{old('nomcate')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" for="codarti">Codigo *</label>
                                    <input id="codarti" readonly onchange="uneCodigo()" type="text" name="codarti" class="form-control" value="{{old('codarti')}}" required>
                                </div>
                            </div>
                            <div class="col col-md-10">
                                <div class="form-group">
                                    <label class="control-label" for="nombre">Nombre*</label>
                                    <input type="text" name="nomartic" class="form-control" value="{{old('nomartic')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="nombrec">Nombre abreviado</label>
                                    <input type="text" name="nomarti" class="form-control" value="{{old('nomarti')}}">
                                </div>
                            </div>                            
                        </div>                            
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="vcosto">Valor costo *</label>
                                    <input id="vcosto" onblur="fvalor()" type="number" name="vcosto" class="form-control" step="0.01" value="{{old('vcosto')}}" required style="padding: 6px 4px 6px 8px">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="pmargen">Marg*</label>
                                    <input id="pmargen" onblur="fvalor()" type="number" step="0.01" name="pmargen" class="form-control" value="{{old('pmargen')}}" required style="padding: 6px 4px 6px 8px">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="vneto">Valor</label>
                                    <input id="valor" name="valor" type="number" readonly class="form-control" value="{{old('valor')}}" style="padding: 6px 4px 6px 8px">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="vneto">Valor neto *</label>
                                    <input id="vneto" name="vneto" onblur="ftotal()" type="number" step="0.01" class="form-control" value="{{old('vneto')}}" required style="padding: 6px 4px 6px 8px">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="piva">Iva *</label>
                                    <input id="piva" onblur="ftotal()" type="number" step="0.01" name="piva" class="form-control" value="{{old('piva')}}" required style="padding: 6px 4px 6px 8px">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="venta">Venta</label>
                                    <input id="vtotal" name="vtotal" type="number" readonly class="form-control" value="{{old('vtotal')}}" style="padding: 6px 4px 6px 8px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="minimo">Mínimo *</label>
                                    <input type="number" name="minimo" class="form-control" value="{{old('minimo')}}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="maximo">Máximo *</label>
                                    <input type="number" name="maximo" class="form-control" value="{{old('maximo')}}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="embalaje">Embalaje *</label>
                                    <input type="number" name="embalaje" class="form-control" value="{{old('embalaje')}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="unidad">Unidad</label>
                                    <input type="text" name="unidad" class="form-control" value="{{old('unidad')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cbarras">Código de barras</label>
                                    <input type="text" name="cbarras" class="form-control" value="{{old('cbarras')}}">
                                </div>
                            </div>
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
@endsection