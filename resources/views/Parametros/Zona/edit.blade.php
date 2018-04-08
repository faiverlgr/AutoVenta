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
                <h1>Zonas</h1>
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
                        <h3>Editar Zona<a href="/zona"><button class="btn btn-md btn-succes pull-right">Listado</button></a></h3>
                    </div>
                    <div class="box-body">
                        <div class="col col-md-6 col-md-offset-3">
                            {!!Form::model($data, ['route' => ['zona.update', $data->id], 'method' => 'PATCH'])!!}
                            {{Form::token()}}
                                <div class="form-group">
                                    <label for="desred">Red</label>
                                    <input name="desred" readonly class="text form-control" value="{{ $data->desred }}">
                                </div>
                                <div class="form-group">    
                                    <label for="codzon">Zona</label>
                                    <input type="text" readonly class="form-control" value="{{ $data->codzon }}">
                                </div>
                                <div class="form-group">
                                    <label for="nomzon">Nombre</label>
                                    <input name="nomzon" class="text form-control" value="{{ $data->nomzon }}">
                                </div>
                                <div class="form-group">
                                    <label for="deszon">Detalle</label>
                                    <textarea rows="4" cols="50" name="deszon" class="text form-control">{{ $data->deszon }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
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
        $(".text").keyup(function(){
            this.value = this.value.toUpperCase();
        });
    </script>
    @endsection
@endsection