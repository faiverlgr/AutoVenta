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
            <h1>Ajsutes</h1>
        </section>
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3>Listado<a href="ajusten/create"><button class="btn btn-succes pull-right">Nuevo</button></a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col col-md-10 col-md-offset-1">
                        {!! Form::open(array('url'=>'/ajuste','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchText" placeholder="Buscar por nombre de concepto..." value="{{$searchText}}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </span>
                                </div>
                            </div>
                        {{Form::close()}}
                        <table class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 15px">Id.</th>
                                <th style="width: 100px">Tipo</th>
                                <th style="width: 100px">Concepto</th>
                                <th style="width: 35px">Fecha</th>
                                <th style="width: 50px">Costo</th>
                                <th style="width: 50px">Iva</th>
                                <th style="width: 50px">Venta</th>
                                <th style="width: 50px">.:.</th>
                            </tr>
                            </thead>
                            @foreach($ajustes as $item)
                                <tr>
                                    <td>{{ $item->id}}</td>
                                    <td>{{ $item->nomtipo}}</td>
                                    <td>{{ $item->nombre}}</td>
                                    <td>{{ $item->fecha}}</td>
                                    <td>{{ $item->tcosto}}</td>
                                    <td>{{ $item->tiva}}</td>
                                    <td>{{ $item->tventa}}</td>
                                    <td>
                                        @if($item->estado == 0)
                                            <a href="" data-target="#" data-toggle="modal">
                                                <button class="btn btn-xs btn-warning">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-check"></span>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ URL::action('IngresenController@show', $item->id) }}">
                                                <button class="btn btn-xs btn-success">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-eye-open"></span>
                                                </button>
                                            </a>
                                            <a data-target="#modal-delete-{{$item->id}}" data-toggle="modal">
                                                <button class="btn btn-xs btn-danger">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @include('movimientos.ajuste.modal')
                            @endforeach
                        </table>
                    </div>
                </div>
                {{$ajustes->render()}}
              </div>
        </section>
    </div>
    @include('layouts.footer')
</div>
@endsection