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
        </section>
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3>Listado<a href="categoria/create"><button class="btn btn-succes pull-right">Crear un nuevo item</button></a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col col-md-8 col-md-offset-2">                    
                        {!! Form::open(array('url'=>'/categoria','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
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
                                    <th style="width: 5%">Categoria</th>
                                    <th style="width: 80%">Nombre</th>
                                    <th style="width: 10%">.:.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categorias as $cate)
                                <tr>
                                    <td>{{ $cate->codprov }}</td>
                                    <td>{{ $cate->codcate }}</td>
                                    <td>{{ $cate->nomcate }}</td>
                                    <td>
                                        @if($cate->estado == 0)
                                            <a href="" data-target="#modal-delete-{{$cate->id}}" data-toggle="modal">
                                                <button class="btn btn-xs btn-warning">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-check"></span>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{URL::action('CategoriaController@edit', $cate->id)}}">
                                                <button class="btn btn-xs btn-success">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
                                                </button>
                                            </a>
                                            <a data-target="#modal-delete-{{$cate->id}}" data-toggle="modal">
                                                <button class="btn btn-xs btn-danger">
                                                    <span aria-hidden="true" class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @include('maestros.categoria.modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$categorias->render()}}
              </div>
        </section>
    </div>
    @include('layouts.footer')
</div>
@endsection