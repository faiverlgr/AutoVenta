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
                <h1>Negocios</h1>
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
                        <h3>Editar Negocio<a href="/negocio"><button class="btn btn-md btn-succes pull-right">Listado</button></a></h3>
                    </div>
                    <div class="box-body">
                        <div class="col col-md-6 col-md-offset-3">
                            {!!Form::model($data, ['route' => ['negocio.update', $data->id], 'method' => 'PATCH'])!!}
                            {{Form::token()}}
                            <div class="row">
                                <div class="form-group">
                                    <label for="idcli">Documento de cliente</label>
                                    <input type="text" readonly class="numeric form-control" value="{{ $data->nrodoc }}" >
                                </div>
                                <div class="form-group">
                                    <label for="nomcli">Nombre de cliente</label>
                                    <input type="text" readonly class="form-control" value="{{ $data->razons }}">
                                </div>
                            </div>
                            <div class="form-group">    
                                <label for="idred">Red</label>
                                <input type="text" readonly class="numeric form-control" value="{{ $data->codred }}-{{ $data->desred }}" >
                            </div>
                            <div class="form-group">    
                                <label for="idzon">Zona</label>
                                <input type="text" readonly class="numeric form-control" value="{{ $data->codzon }}-{{ $data->nomzon }}" > 
                            </div>
                            <div class="form-group">    
                                <label for="idloc">Localidad</label>
                                <input type="text" readonly class="numeric form-control" value="{{ $data->codloc }}-{{ $data->nomloc }}" > 
                            </div>
                            <div class="form-group">
                                <label for="nomneg">Nombre de negocio *</label>
                                <input type="text" name="nomneg" class="text form-control" value="{{ $data->nomneg }}">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" class="text form-control" value="{{ $data->direccion }}">
                            </div>
                            <div class="form-group">
                                <label for="idciudad">Ciudad *</label>
                                <select name="idciudad" id="idciudad" class="form-control">
                                    <option value="1">BOGOTA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telefono1">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" class="numeric form-control" value="{{ $data->telefono }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $data->email }}">
                            </div>
                            <div class="form-group">
                                <label for="tipneg">Tipo de Negocio *</label>
                                <select name="tipneg" id="tipneg" class="form-control">
                                    <option value="1">VENTAS VARIAS</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-sm btn-danger" type="reset">Cancelar</button>
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>
    @section('scripts')
        <script>
            //convierte a mayúsculas
            $(".text").keyup(function(){
                this.value = this.value.toUpperCase();
            });
        </script>
    @endsection
@endsection