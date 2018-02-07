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
            <h1>Articulos</h1>
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
        <!-- /.Header (Page header) -->
        <!-- Main content -->
        <section class="content container-fluid">
            <div id="box-info" class="box box-info">   
                <div class="box-header">
                    <h3 class="box-title">Seleccione una de las categorias disponibles</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i id="fa-fa" class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row col col-md-10 col-md-offset-1">
                        <table class="table table-condensed table-hover table-bordered padre">
                            <thead>
                                <tr>
                                    <th>Prov</th>
                                    <th>Razons</th>
                                    <th>Cate</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gcodcates as $codcate)
                                <tr class="hijo" onclick="comprime()">
                                    <td style="width:10%">{{$codcate->codprov}}</td>
                                    <td style="width:40%">{{$codcate->razons}}</td>
                                    <td style="width:10%">{{$codcate->codcate}}</td>
                                    <td style="width:40%">{{$codcate->nomcate}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
            <div id="box-default" class="box box-default">
                <div class="box-header with-border">
                    <h3>Nuevo Articulo<a href="/articulo"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                </div>
                    <div class="box-body">
                        <div class="col col-sm-10 col-sm-offset-1">
                            {!!Form::open(array('url'=>'articulo','method'=>'POST','autocompleted'=>'off'))!!}
                            {{Form::token()}}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="codprov">codprov</label>
                                        <input id="codprov" readonly type="text" name="codprov" class="form-control" value="{{old('codprov')}}">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="#">Nombre</label>
                                        <input id="razons" readonly type="text" name="razons" class="form-control" value="{{old('razons')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="codprov">Codcate</label>
                                        <input id="codcate" readonly type="text" name="codcate" class="form-control" value="{{old('codcate')}}">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="control-label" for="nomcate">Nombre</label>
                                        <input id="nombre" readonly type="text" name="nomcate" class="form-control" value="{{old('nomcate')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="codarti">Codigo *</label>
                                        <input id="codarti" onchange="uneCodigo()" type="text" name="codarti" class="form-control" value="{{old('codarti')}}" required>
                                    </div>
                                </div>
                                <div class="col col-md-10">
                                    <div class="form-group">
                                        <label class="control-label" for="nombre">Nombre*</label>
                                        <input type="text" name="nomartic" class="form-control" value="{{old('nomartic')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="nombrec">Nombre abreviado</label>
                                        <input type="text" name="nomarti" class="form-control" value="{{old('nomarti')}}">
                                    </div>
                                </div>                            
                            </div>                            
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="vcosto">Valor costo *</label>
                                        <input id="vcosto" onblur="fvalor()" type="number" name="vcosto" class="form-control" step="0.01" value="{{old('vcosto')}}" required style="padding: 6px 4px 6px 8px">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="pmargen">Marg*</label>
                                        <input id="pmargen" onblur="fvalor()" type="number" step="0.01" name="pmargen" class="form-control" value="{{old('pmargen')}}" required style="padding: 6px 4px 6px 8px">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="vneto">Valor</label>
                                        <input id="valor" name="valor" type="number" readonly class="form-control" value="{{old('valor')}}" style="padding: 6px 4px 6px 8px">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="vneto">Valor neto *</label>
                                        <input id="vneto" name="vneto" onblur="ftotal()" type="number" step="0.01" class="form-control" value="{{old('vneto')}}" required style="padding: 6px 4px 6px 8px">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="piva">Iva *</label>
                                        <input id="piva" onblur="ftotal()" type="number" step="0.01" name="piva" class="form-control" value="{{old('piva')}}" required style="padding: 6px 4px 6px 8px">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="venta">Venta</label>
                                        <input id="vtotal" name="vtotal" type="number" readonly class="form-control" value="{{old('vtotal')}}" style="padding: 6px 4px 6px 8px">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="minimo">Mínimo *</label>
                                        <input type="number" name="minimo" class="form-control" value="{{old('minimo')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="maximo">Máximo *</label>
                                        <input type="number" name="maximo" class="form-control" value="{{old('maximo')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="embalaje">Embalaje *</label>
                                        <input type="number" name="embalaje" class="form-control" value="{{old('embalaje')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unidad">Unidad</label>
                                        <input type="text" name="unidad" class="form-control" value="{{old('unidad')}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cbarras">Código de barras</label>
                                        <input type="text" name="cbarras" class="form-control" value="{{old('cbarras')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                            </div>
                            <input hidden name="validaArti" id="validaArti"></input>
                            {!!Form::close()!!}
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
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
    @section('scripts')
    <script>
        // comentarios
        function fvalor(){
            var vcos = document.getElementById('vcosto').value;
            var vmar = document.getElementById('pmargen').value;

            if (vcos == "" || vcos == null || vcos == undefined) {
                document.getElementById('valor').value = 0.00;
            } else if (vmar == "" || vmar == null || vmar == undefined) {
                document.getElementById('valor').value = 0.00;
            } else {
                vcos = parseFloat(vcos);
                vmar = parseFloat(vmar);
                var vcalculo = (vcos + ((vcos * vmar) / 100));
                document.getElementById('valor').value = vcalculo.toFixed(2);
            }
        };

        function ftotal(){
            var vnet = document.getElementById('vneto').value;
            var viva = document.getElementById('piva').value;

            if (vnet == "" || vnet == null || vnet == undefined) {
                document.getElementById('vtotal').value = 0.00;
            }else if (viva == "" || viva == null || viva == undefined){
                document.getElementById('vtotal').value = 0.00;
            }
            else {
                var vnet = parseFloat(vnet);
                var viva = parseFloat(viva);
                var vcalculo = (vnet + ((vnet * viva) / 100));
                document.getElementById('vtotal').value = vcalculo.toFixed(2);
            }
        };

        var hijos = document.querySelectorAll("table.padre > tbody > tr.hijo");
        for (unHijo of hijos) {
            unHijo.addEventListener("click", function(evt){
                var hijo = evt.target;

                //var valor1 = this.cells[2].innerText;
                //alert("Texto del enlace: " + valor1);
                document.getElementById('codprov').value = this.cells[0].innerText;
                document.getElementById('razons').value = this.cells[1].innerText;
                document.getElementById('codcate').value = this.cells[2].innerText;
                document.getElementById('nombre').value = this.cells[3].innerText;
            });
        };

        function comprime(){
            document.getElementById("box-info").className += " collapsed-box"
            document.getElementById("fa-fa").className = "fa fa-plus"
            //console.log("sale del box-info");
        };

        function uneCodigo(){
            var valor1 = document.getElementById('codprov').value;
            var valor2 = document.getElementById('codcate').value;
            var valor3 = document.getElementById('codarti').value;
            document.getElementById('validaArti').value = valor1+valor2+valor3;
        };
     
    </script>
    <!-- Select2 -->
    @endsection
@endsection