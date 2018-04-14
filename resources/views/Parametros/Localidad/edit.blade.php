@extends ('layouts.admin')
@section ('wrapper')
    <div id="app" class="wrapper">
        @include('layouts.partials.home.header')
        @include('layouts.partials.home.menu')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Localidades</h1>
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
            <!-- Main content -->
            <section class="content container-fluid">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3>Editar Localidad<a href="/localidad"><button class="btn btn-md btn-succes pull-right">Listado</button></a></h3>
                    </div>
                    <div class="box-body">
                        <div class="col col-md-6 col-md-offset-3">
                            {!!Form::model($data, ['route' => ['localidad.update', $data->id], 'method' => 'PATCH'])!!}
                            {{Form::token()}}
                                <div class="form-group">
                                    <label for="desred">Red</label>
                                    <input name="desred" readonly class="text form-control" value="{{ $data->desred }}">
                                </div>
                                <div class="form-group">
                                    <label for="deszon">Zona</label>
                                    <input name="deszon" readonly class="text form-control" value="{{ $data->deszon }}">
                                </div>
                                <div class="form-group">    
                                    <label for="codloc">Localidad</label>
                                    <input type="text" name="codloc" readonly class="form-control" value="{{ $data->codloc }}">
                                </div>
                                <div class="form-group">
                                    <label for="nomloc">Nombre</label>
                                    <input name="nomloc" class="text form-control" value="{{ $data->nomloc }}">
                                </div>
                                <div class="form-group">
                                    <label for="desloc">Detalle</label>
                                    <textarea rows="4" cols="50" name="desloc" class="text form-control">{{ $data->desloc }}</textarea>
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