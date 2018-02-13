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
            <h1>Ingresos</h1>
        </section>
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3>Listado<a href="ingresen/create"><button class="btn btn-succes pull-right">Crear un nuevo item</button></a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col col-md-10 col-md-offset-1">
                        {!! Form::open(array('url'=>'/ingreso','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchText" placeholder="Buscar por número de documento..." value="{{$searchText}}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </span>
                                </div>
                            </div>
                        {{Form::close()}}
                        <table class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 5%">Doc.</th>
                                <th style="width: 20%">Fecha</th>
                                <th style="width: 27%">Costo</th>
                                <th style="width: 20%">Margen</th>
                                <th style="width: 10%">Venta</th>
                                <th style="width: 10%">Iva</th>
                                <th style="width: 8%">.:.</th>
                            </tr>
                            </thead>
                            @foreach($ingresos as $item)
                                <tr>
                                    <td>{{ $item->numdoc }}</td>
                                    <td>{{ $item->fecha }}</td>
                                    <td>{{ $item->tcosto }}</td>
                                    <td>{{ $item->tmargen }}</td>
                                    <td>{{ $item->tventa }}</td>
                                    <td>{{ $item->tiva }}</td>
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
                                            <a data-target="#modal-delete-{{$agen->id}}" data-toggle="modal">
                                                <button class="btn btn-xs btn-danger">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @include('movimientos.ingreso.modal')
                            @endforeach
                        </table>
                    </div>
                </div>
                {{$ingresos->render()}}
              </div>
        </section>
    </div>
    @include('layouts.footer')
</div>
@endsection