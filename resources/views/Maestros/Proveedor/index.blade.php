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
        <!-- Main Header // BARRA HORIZONTAL include('layouts.partials.header')-->
        @include('layouts.partials.home.header')
        <!-- Main Header // BARRA VERTICAL include('layouts.partials.menu')-->
        @include('layouts.partials.home.menu')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Proveedores</h1>
            </section>
            <section class="content container-fluid">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3>Listado<a href="proveedor/create"><button class="btn btn-succes pull-right">Crear un nuevo item</button></a></h3>
                    </div>
                    <div class="box-body">
                        <div class="col col-md-10 col-md-offset-1">
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
                            <table class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">Cod.</th>
                                        <th style="width: 15%">Nit</th>
                                        <th style="width: 38%">Razon Social</th> 
                                        <th style="width: 12%">Sigla</th>
                                        <th style="width: 15%">Telefono</th>
                                        <th style="width: 15%">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proveedores as $prov)
                                        <tr>
                                            <td>{{ $prov->codprov }}</td>
                                            <td>{{ $prov->nit }}</td>
                                            <td>{{ $prov->razons }}</td>
                                            <td>{{ $prov->sigla }}</td>
                                            <td>{{ $prov->telefono1 }}</td>
                                            <td>
                                                @if($prov->estado == 0)
                                                    <a href="" data-target="#modal-delete-{{$prov->id}}" data-toggle="modal">
                                                        <button class="btn btn-xs btn-warning">
                                                            <span aria-hidden="true" class="glyphicon glyphicon-check"></span>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{URL::action('ProveedorController@edit', $prov->id)}}">
                                                        <button class="btn btn-xs btn-success">
                                                            <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
                                                        </button>
                                                    </a>
                                                    <a data-target="#modal-delete-{{$prov->id}}" data-toggle="modal">
                                                        <button class="btn btn-xs btn-danger">
                                                            <span aria-hidden="true" class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    </a>
                                                @endif
                                                <a href="{{URL::action('ProveedorController@show', $prov->id)}}" class="btn-delete">
                                                    <button class="btn btn-xs btn-info">
                                                        <span aria-hidden="true" class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('maestros.proveedor.modal')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{$proveedores->render()}}
                </div>
                <div class="box box-info">
                    <div id="load" class="box-header with-border">
                        <h3>Categorias</h3>
                    </div>
                    {{--  <div id="alert" class="alert alert-info"></div>  --}}
                    <div class="box-body">
                        {{ Form::open() }}
                            <select name="select1" id="select1">
                                @foreach($proveedores as $item)
                            <option value={{ $item->id }}>{{ $item->codprov }}</option>
                                @endforeach
                            </select>
                            <select name="select2" id="select2">
                                    <option>Escoja un proveedor</option>
                            </select>
                        {{ Form::close() }}
                    </div>
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>
    @section('scripts')
    <script>
        $(document).ready(function(){
            $('#select1').change(function(){
                var $sel = $(select2);
                var cadena = `/categoriasm/${this.value}`;
                var val = "{{url("")}}";
                var conca = val.concat(cadena);
                var options = [];
                $sel.find('option').not(':first').remove();
                $.ajax({
                    url: conca,
                    type: 'GET',
                    dataType: "json",
                    beforeSend: function () {$('#load').addClass("loading")},
                    success: function(data){
                        $.each(data, function(index, item){
                            options.push(`<option value= "${item.id}">${item.nomcate}</option>`);
                        });
                        $sel.append(options);
                    },
                    complete: function(){$('div.loading').removeClass("loading")}
                });
            });
        });
    </script>
    @endsection
@endsection
