@extends ('layouts.admin')
@section ('wrapper')
<div class="wrapper">
    <!-- Main Header // BARRA HORIZONTAL include('layouts.partials.header')-->
    @include('layouts.partials.home.header')
    <!-- /.Main Header -->
    <!-- Main Header // BARRA VERTICAL include('layouts.partials.menu')-->
    @include('layouts.partials.home.menu')
    <!-- /.Main Header -->
    <!-- Content Wrapper. Contains page content -->
    <div id="app" class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Articulos</h1>
        </section>
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3>Listado<a href="articulo/create"><button class="btn btn-succes pull-right">Crear un nuevo item</button></a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col col-md-8 col-md-offset-2">                    
                        {!! Form::open(array('url'=>'/articulo','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="searchText" placeholder="Buscar por nombre..." value="{{$searchText}}">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </span>
                            </div>
                        </div>
                        {{Form::close()}}
                        <table class="table table-condensed table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">Prov</th>
                                    <th style="width: 5%">Linea</th>
                                    <th style="width: 5%">Articulo</th>
                                    <th style="width: 50%">Nombre</th>
                                    <th style="width: 10%">Precio</th>
                                    <th style="width: 25%">.:.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articulos as $arti)
                                <tr>
                                    <td>{{ $arti->codprov }}</td>
                                    <td>{{ $arti->codcate }}</td>
                                    <td>{{ $arti->codarti }}</td>
                                    <td>{{ $arti->nombre }}</td>
                                    <td>{{ $arti->vneto }}</td>
                                    <td>
                                        <a href="{{URL::action('ArticuloController@edit', $arti->id)}}"><button class="btn btn-xs btn-info">Editar</button></a>
                                        @if($arti->estado == 0)
                                        <a href="" data-target="#modal-delete-{{$arti->id}}" data-toggle="modal"><button class="btn btn-xs btn-danger">Inactivo</button></a>
                                        @else
                                        <a href="" data-target="#modal-delete-{{$arti->id}}" data-toggle="modal"><button class="btn btn-xs btn-success">Activo</button></a>
                                        @endif
                                    </td>
                                </tr>
                                @include('maestros.articulo.modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$articulos->render()}}
                <!-- /.box-body -->
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