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
            <h1>Proveedores</h1>
        </section>
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3>Listado <a href="proveedor/create"><button class="btn btn-succes pull-right">Crear un nuevo item</button></a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(array('url'=>'/proveedor','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
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
                        <th>Codigo</th>
                        <th>Nit</th>
                        <th>Razon Social</th>
                        <th>Sigla</th>
                        <th>Telefono</th>
                      </tr>
                    </thead>
                    @foreach($proveedores as $prov)
                        <tr>
                            <td>{{ $prov->codprov }}</td>
                            <td>{{ $prov->nit }}</td>
                            <td>{{ $prov->razons }}</td>
                            <td>{{ $prov->sigla }}</td>
                            <td>{{ $prov->telefono1 }}</td>
                            <td>
                                <a href="{{URL::action('Maestros\ProveedorController@edit', $prov->id)}}"><button class="btn btn-xs btn-info">Editar</button></a>
                                @if($prov->estado == 0)
                                    <a href="" data-target="#modal-delete-{{$prov->id}}" data-toggle="modal"><button class="btn btn-xs btn-danger">Inactivo</button></a>
                                @else
                                <a href="" data-target="#modal-delete-{{$prov->id}}" data-toggle="modal"><button class="btn btn-xs btn-success">Activo</button></a>
                                @endif
                            </td>
                        </tr>
                        @include('maestros.proveedor.modal')
                    @endforeach
                  </table>
                </div>
                {{$proveedores->render()}}
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