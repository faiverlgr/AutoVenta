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
                    <div class="box-body">
                        <div class="col col-md-12">
                            <div class="box-header with-border">
                                <h3>Clientes<a href="/"><button id="resultado" class="btn btn-succes pull-right">Volver</button></a></h3>
                            </div>
                            {!! Form::open(array('url'=>'/negocio','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="searchText" placeholder="Buscar por razón social" value="{{$searchText}}">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                        </span>
                                    </div>
                                </div>
                            {{Form::close()}}
                            <table class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">Documento</th>
                                        <th style="width: 5%">Razon Social</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $item)
                                        <tr>
                                            <td>{{$item->nrodoc}}</td>
                                            <td>{{$item->razons}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $clientes->render() }}
                            <select id="idcli" class="form-control" name="idcli">
                                @foreach($clientes as $item)
                                    <option value= "{{$item->id}}">{{$item->nrodoc}}-{{$item->razons}}</option>
                                @endforeach
                            </select>
                            <div class="box-header with-border">
                                <h3>Negocios<a href="/crearnegoc/{{$item->id}}"><button class="btn btn-succes pull-right">Crear negocio</button></a></h3>
                            </div>
                            <table id="table" class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">Id</th>
                                        <th style="width: 5%">Red</th>
                                        <th style="width: 5%">Zona</th>
                                        <th style="width: 5%">Loc</th>
                                        <th style="width: 25%">Negocio</th> 
                                        <th style="width: 25%">Dirección</th>
                                        <th style="width: 10%">Teléfono</th>
                                        <th style="width: 5%">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="contenido">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>
    @section('scripts')
        <script>
            $('#idcli').change(function(){
                var $sel = $('#contenido');
                var cadena = `/AjaxNegocios/${this.value}`;
                var val = "{{url("")}}";
                var conca = val.concat(cadena);
                var registros = [];
                var filas = 0;
                $sel.empty();
                $sel.find('option').not(':first').remove();
                $.ajax({
                    url: conca,
                    type: 'GET',
                    dataType: "json",
                    beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                    },
                    success: function(data){
                        $.each(data, function(index, item){
//                            var filas = data.length;
//                            for ( i = 0 ; i < filas; i++){ //cuenta la cantidad de registros
                            registros = `<tr><td>${item.id}</td><td>${item.codred}</td><td>${item.codzon}</td><td>${item.codloc}</td><td>${item.nomneg}</td><td>${item.direccion}</td><td>${item.telefono}</td></tr>`
                            $sel.append(registros);
                        });
                    },
                    complete: function () {
                        $("#resultado").html("Volver");
                    }
                }); 
            });
        </script>
    @endsection
@endsection
