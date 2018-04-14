@extends ('layouts.admin')
@section ('wrapper')
<div id="app" class="wrapper">
    @include('layouts.partials.home.header')
    @include('layouts.partials.home.menu')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Localidades</h1>
        </section>
        <section class="content container-fluid">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3>Listado<a href="localidad/create"><button class="btn btn-succes pull-right">Crear un nuevo item</button></a></h3>
                </div>
                <div class="box-body">
                    <div class="col col-md-12">
                        {!! Form::open(array('url'=>'/localidad','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchText" placeholder="Buscar por nombre" value="{{$searchText}}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </span>
                                </div>
                            </div>
                        {{Form::close()}}
                        <table id="example1" class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 5%">Codigo</th>
                                <th style="width: 30%">Localidad</th>
                                <th style="width: 35%">Zona</th>
                                <th style="width: 20%">Red</th>
                                <th style="width: 10%">Acción</th>
                            </tr>
                            </thead>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->codloc }}</td>
                                    <td>{{ $item->nomloc }}</td>
                                    <td>{{ $item->codzon }}-{{ $item->nomzon }}</td>
                                    <td>{{ $item->codred }}-{{ $item->desred }}</td>
                                    <td>
                                        @if($item->estado == 0)
                                            <a href="" data-target="#modal-delete-{{ $item->id }}" data-toggle="modal">
                                                <button class="btn btn-xs btn-warning">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-check"></span>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{URL::action('LocalidadController@edit', $item->id) }}">
                                                <button class="btn btn-xs btn-success">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
                                                </button>
                                            </a>
                                            <a data-target="#modal-delete-{{ $item->id }}" data-toggle="modal">
                                                <button class="btn btn-xs btn-danger">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @include('parametros.localidad.modal')
                            @endforeach
                        </table>
                    </div>
                </div>
                {{$data->render()}}
              </div>
        </section>
    </div>
    @include('layouts.footer')
</div>
@endsection