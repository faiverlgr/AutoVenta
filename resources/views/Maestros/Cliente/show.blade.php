@extends ('layouts.admin')
@section ('wrapper')
    <div id="app" class="wrapper">
        @include('layouts.partials.home.header')
        @include('layouts.partials.home.menu')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Clientes</h1>
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
                        <h3>Lista de Negocios<a href="/crearnegoc/{{$cliente->id}}"><button class="btn btn-succes pull-right">Nuevo</button></a></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                                <div class="form-group">
                                    <label for="nrodoc">Documento</label>
                                    <input readonly type="text" id="nrodoc" class="form-control" value="{{$cliente->nrodoc}}">
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
                                <div class="form-group">
                                    <label for="numdoc">Razon Social</label>
                                    <input readonly type="text" id="razons" class="form-control" value="{{$cliente->razons}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color:#A9D0F5">
                                        <tr>
                                            <th style="width: 5%">Id</th>
                                            <th style="width: 5%">Red</th>
                                            <th style="width: 5%">Zona</th>
                                            <th style="width: 5%">Loc</th>
                                            <th style="width: 25%">Negocio</th> 
                                            <th style="width: 15%">Dirección</th>
                                            <th style="width: 10%">Teléfono</th>
                                            <th style="width: 15%">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($negocios as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->idred}}</td>
                                                <td>{{$item->idzon}}</td>
                                                <td>{{$item->idloc}}</td>
                                                <td>{{$item->nomneg}}</td>
                                                <td>{{$item->direccion}}</td>
                                                <td>{{$item->telefono}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{$negocios->render()}}
                    </div>
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>
@endsection