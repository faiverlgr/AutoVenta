@extends ('layouts.admin')
@section ('wrapper')
<div id="app" class="wrapper">
    @include('layouts.partials.home.header')
    @include('layouts.partials.home.menu')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Ingresos</h1>
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
                    <h3>Crear Ingreso<a href="/ingreso"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                </div>
                <div class="box-body">
                    {!!Form::open(array('url'=>'ingreso','method'=>'POST','autocompleted'=>'off'))!!}
                    {{Form::token()}}
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">    
                                <label fr="codprov">Proveedor *</label>
                                <select name="idproveedor" id="idproveedor" class="form-control select2-container">
                                    @foreach($proveedores as $item)
                                    <option value="{{$item->id}}">{{$item->razons}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">    
                                <label for="numdoc">Documento</label>
                                <input type="text" name="numdoc" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                            <div class="form-group">
                                <label for="anoper">Fecha</label>
                                <div class="input-group">
                                    <input id="fecha" type="text" name="fecha" class="datepicker form-control" value=""/>
                                    <label for="datepciker" class="input-group-addon generic_btn"><i class="fa fa-calendar" aria-hidden="true"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                            <div class="form-group">    
                                <label for="anoper">Periodo</label>
                                <input readonly type="text" name="anoper" class="form-control" value="{{$periodos->anoper}}-{{$periodos->mesper}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body" style="border-top:0.5px; border-left: 0px; border-right: 0px; border-bottom: 0.5px; border-style: solid; border-color: #A9D0F5; ">
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                            <div class="form-group">
                                <label for="articulo">Articulo</label>
                                <select id="idarticulo" class="form-control" name="idarticulo">
                                    @foreach($articulos as $art)
                                        <option value="{{ $art->id }}">{{ $art->nomartic }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                            <div class="form-group">
                                <label for="articulo">Cantidad</label>
                                <input type="text" id="cantidad" class="numeric form-control" name="cantidad">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                            <div class="form-group">
                                <label for="articulo">Valor Venta</label>
                                <input type="text" id="pventa"  class="numeric form-control" name="pventa">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                            <div class="form-group">
                                <label for="articulo">Valor Total</label>
                                <input type="text" id="valor_total" class="numeric form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                            <div class="form-group">
                                <button type="button" id="add" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Total</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/. 0.00</h4></th>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="guardar" class="box-footer with-border">
                    <div class="form-group">
                        <button type="submit" id="guardar" class="btn btn-sm btn-primary">Guardar</button>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </section>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
    <script>
        /*
        *
        *
        */
        $(document).ready(function() {

            $('#add').click(function(){
                agregar();
            });

            var cont = 0;
            var total = 0;
            subtotal = [];
            $("#guardar").hide();

            function bolllo(){
                alert('yo también aparezco');
            }
            
            function agregar(){
                idarticulo  = $('#idarticulo').val();
                articulo    = $('#idarticulo option:selected').text();
                cantidad    = $('#cantidad').val();
                pventa      = $('#pventa').val();
                //vtotal      = $('valor_total').val(pventa * pventa);

                if (idarticulo != "" && cantidad != "" && pventa != ""){
                    subtotal[cont] = (cantidad * pventa);
                    total = total + subtotal[cont];
                    var fila = `<tr class="selected" id="fila` + cont + `"><td><button type="button" class="btn btn-warning" onclick="borrar(`+cont+`)">x</button></td><td><input type="hidden" name="idarticulo[]" value="`+idarticulo+`">`+articulo+`</td><td><input type="number" name="cantidad[]" value="`+cantidad+`"></td><td><input type="number" name="pventa[]" value="`+pventa+`"></td><td><input type="number" name="subtotal[]" value="`+subtotal[cont]+`"></tr>`;
                    cont++;
                    limpiar();
                    $('#total').html("S/. " + total);
                    ocultar_guardar();
                    $('#detalles').append(fila);
                }
                else{
                    alert('Error al ingresar el detalle del ingreso, revise los datos del artículo');
                }
                
            };

            function limpiar(){
                $("#cantidad").val("");
                $("#pventa").val("");
                $("#valor_total").val("");
            };

            function ocultar_guardar(){
                if (total>0){
                    $("#guardar").show();
                }
                else{
                    $("#guardar").hide();
                }
            };

            // Datepicker
            $('.datepicker').datepicker({
                dateFormat: "yy/mm/dd",
                firstDay: 1,
                dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                onSelect: function(dateText){
                    $('#fecha').val(dateText);
                }
            });
            //*********
        });
        function borrar(ind){
            total = total - subtotal[ind];
            $('#total').html("S/." + total);
            $('#fila' + ind).remove();
            ocultar_guardar();
            alert('hola');
        };
    </script>
@endsection
@endsection