@extends ('layouts.admin')
@section ('styles')
    <style type="text/css">
        div.loading, .loading {
            background-color: #FFFFFF;
            background-image: url("{{asset('images/Loading_icon.gif')}}");
            background-position: center center;
            background-repeat: no-repeat;
            z-index: 1400;
            position: relative
        }
        div.loading * {
            visibility: hidden;
        }
    </style>
@endsection
@section ('wrapper')
    <div id="app" class="wrapper">
        @include('layouts.partials.home.header')
        @include('layouts.partials.home.menu')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Negocios</h1>
            </section>
            <section class="content container-fluid">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3>Listado<a href="/"><button id="resultado" class="btn btn-succes pull-right">Volver</button></a></h3>
                    </div>
                    <div class="box-body">
                        <div class="col col-md-10 col-md-offset-1">
                            {!! Form::open(array('url'=>'/negocio','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchText" placeholder="Buscar por nombre de negocio" value="{{$searchText}}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </span>
                                </div>
                            </div>
                            {{Form::close()}}
                            <table id="table" class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">Id</th>
                                        <th style="width: 5%">Red</th>
                                        <th style="width: 5%">Zona</th>
                                        <th style="width: 5%">Loc</th>
                                        <th style="width: 10%">IDCliente</th>
                                        <th style="width: 25%">Negocio</th> 
                                        <th style="width: 25%">Dirección</th>
                                        <th style="width: 10%">Teléfono</th>
                                        <th style="width: 10%">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($negocios as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->codred}}</td>
                                        <td>{{$item->codzon}}</td>
                                        <td>{{$item->codloc}}</td>
                                        <td>{{$item->nrodoc}}</td>
                                        <td>{{$item->nomneg}}</td>
                                        <td>{{$item->direccion}}</td>
                                        <td>{{$item->telefono}}</td>
                                        <td>
                                            @if($item->estado == 0)
                                                <a data-target="#modal-delete-{{$item->id}}" data-toggle="modal">
                                                    <button class="btn btn-xs btn-warning">
                                                        <span aria-hidden="true" class="glyphicon glyphicon-check"></span>
                                                    </button>
                                                </a>
                                            @else
                                                <a href="{{URL::action('NegocioController@edit', $item->id)}}">
                                                    <button class="btn btn-xs btn-success">
                                                        <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
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
                                    @include('maestros.negocio.modal')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{$negocios->render()}}
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>
@endsection
