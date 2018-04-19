@extends ('layouts.admin')
@section ('wrapper')
    <div id="app" class="wrapper">
        @include('layouts.partials.home.header')
        @include('layouts.partials.home.menu')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Negocios</h1>
                @if (session('notification'))
                    <div class="alert alert-success">
                        {{ session('notification') }}
                    </div>
                @endif
                @if (session('danger'))
                    <div class="alert alert-danger">
                        {{ session('danger') }}
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
                    <h3>Nuevo<a href="/cliente/{{ $cli->id }}"><button class="btn btn-succes pull-right">Volver al cliente</button></a></h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-8 col-md-offset-2">
                            {!!Form::open(array('url'=>'negocio','method'=>'POST','autocompleted'=>'off'))!!}
                            {{Form::token()}}
                            <div class="row">
                                <div class="form-group">
                                    <label for="idcli">Documento de cliente</label>
                                    <input name="idcli" type="hidden" class="numeric form-control" value="{{$cli->id}}">
                                    <input type="text" readonly class="numeric form-control" value="{{$cli->nrodoc}}">
                                </div>
                                <div class="form-group">
                                    <label for="nomcli">Nombre de cliente</label>
                                    <input type="text" readonly class="form-control" value="{{$cli->razons}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="resultado" for="idred">Seleccione la Red *</label>
                                <select id="idred" name="idred" class="form-control">
                                    @foreach($redes as $item)
                                        <option value="{{$item->id}}">{{$item->codred}}-{{$item->desred}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group">
                                <label id="resultado_zona" for="idzon">Seleccione la Zona *</label>
                                <select id="idzon" name="idzon" class="form-control">
                                    @foreach($zonas as $item)
                                        <option value="{{$item->id}}">{{$item->codzon}}-{{$item->nomzon}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group">
                                <label id="resultado_loca">Seleccione la Localidad *</label>
                                <select id="idloc" name="idloc" class="form-control">
                                    @foreach($localidades as $item)
                                        <option value="{{$item->id}}">{{$item->codloc}}-{{$item->nomloc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomneg">Nombre de negocio *</label>
                                <input type="text" name="nomneg" class="text form-control" value="{{old('nomneg')}}">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección *</label>
                                <input type="text" name="direccion" class="text form-control" value="{{old('direccion')}}">
                            </div>
                            <div class="form-group">
                                <label for="idciudad">Ciudad *</label>
                                <select name="idciudad" id="idciudad" class="form-control">
                                    <option value="1">BOGOTA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telefono1">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" class="numeric form-control" value="{{old('telefono1')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" name="email" class="form-control" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="tipneg">Tipo de Negocio *</label>
                                <select name="tipneg" id="tipneg" class="form-control">
                                    <option value="1">VENTAS VARIAS</option>
                                </select>
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
            //convierte a mayúsculas
            $(".text").keyup(function(){
                this.value = this.value.toUpperCase();
            });
            /**
            *ajax para deolver zonas de una red
            */
            $('#idred').change(function(){
                var $sel = $('#idzon');
                var cadena = `/AjaxTraeZona/${this.value}`;
                var val = "{{url("")}}";
                var conca = val.concat(cadena);
                var options = [];
                $sel.empty()
                $.ajax({
                    url: conca,
                    type: 'GET',
                    dataType: "json",
                    beforeSend: function () {
                        $("#resultado_zona").html("Cargando zonas, espere por favor...");
                    },
                    success: function(data){
                        $.each(data, function(index, item){
                            options.push(`<option value= "${item.id}">${item.codzon}-${item.nomzon}</option>`);
                        });
                        $sel.append(options);
                    },
                    complete: function(){
                        $("#resultado_zona").html("Seleccione la Zona");
                        cargaLoc();
                    },
                });
            });
            /**
            *ajax para devolver localidades de una red y zona
            */
            $('#idzon').change(function(){
                cargaLoc();
            });
            function cargaLoc(){
                var $sel = $('#idloc');
                var $arg1 = $('#idred').val();
                var $arg2 = $('#idzon').val();
                var cadena = `/AjaxTraeLocalidades/${$arg1}/${$arg2}`;
                var val = "{{url("")}}";
                var conca = val.concat(cadena);
                var options = [];
                $sel.empty()
                $.ajax({
                    url: conca,
                    type: 'GET',
                    dataType: "json",
                    beforeSend: function() {
                        $("#resultado_loca").html("Cargando localidades, espere por favor...");
                    },
                    success: function(data){
                        $.each(data, function(index, item){
                            options.push(`<option value= "${item.id}">${item.codloc}-${item.nomloc}</option>`);
                        });
                        $sel.append(options);
                    },
                    complete: function(){
                        $("#resultado_loca").html("Seleccione la Localidad");
                    },
                });
            }
        </script>
    @endsection
@endsection