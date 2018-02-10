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
        </section>
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3>Listado<a href="agencia/create"><button class="btn btn-succes pull-right">Crear un nuevo item</button></a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col col-md-10 col-md-offset-1">
                        {!! Form::open(array('url'=>'/agencia','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchText" placeholder="Buscar por Razon Social..." value="{{$searchText}}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </span>
                                </div>
                            </div>
                        {{Form::close()}}
                        <table id="example1" class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 5%">Cod</th>
                                <th style="width: 20%">Nombre</th>
                                <th style="width: 27%">Dirección</th>
                                <th style="width: 20%">Barrio</th>
                                <th style="width: 10%">Teléfono</th>
                                <th style="width: 10%">Teléfono</th>
                                <th style="width: 8%">.:.</th>
                            </tr>
                            </thead>
                            @foreach($agencias as $agen)
                                <tr>
                                    <td>{{ $agen->codage }}</td>
                                    <td>{{ $agen->nombre }}</td>
                                    <td>{{ $agen->direccion }}</td>
                                    <td>{{ $agen->barrio }}</td>
                                    <td>{{ $agen->telefono1 }}</td>
                                    <td>{{ $agen->telefono2 }}</td>
                                    <td>
                                        @if($agen->estado == 0)
                                            <a href="" data-target="#modal-delete-{{$agen->id}}" data-toggle="modal">
                                                <button class="btn btn-xs btn-warning">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-check"></span>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{URL::action('AgenciaController@edit', $agen->id)}}">
                                                <button class="btn btn-xs btn-success">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
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
                                @include('parametros.agencia.modal')
                            @endforeach
                        </table>
                    </div>
                </div>
                {{$agencias->render()}}
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