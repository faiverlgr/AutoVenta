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
                {!!Form::open(array('url'=>'ingreso','method'=>'POST','autocompleted'=>'off'))!!}
                {{Form::token()}}
                <div class="box-body">
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
                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3" style="padding-right:3px">
                            <div class="form-group">
                                <label for="articulo">Articulo</label>
                                <select id="selArticulo" class="form-control" name="selArticulo">
                                    @foreach($articulos as $art)
                                        <option value="{{ $art->id }}">{{ $art->nomartic }}</option>
                                        <option name="vcosto" hidden value="{{ $art->vcosto }}"></option>
                                        <option name="vneto" hidden value="{{ $art->vneto }}"></option>
                                        <option name="piva" hidden value="{{ $art->piva }}"></option>
                                        <option name="pmargen" hidden value="{{ $art->pmargen }}"></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px">
                            <div class="form-group">
                                <label for="articulo">Cantidad</label>
                                <input type="text" id="cantidad" class="numeric form-control" name="cantidad">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px">
                            <div class="form-group">
                                <label for="vneto">Valor Neto </label>
                                <input type="text" id="vneto"  class="numeric form-control" name="vneto" readonly>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px">
                            <div class="form-group">
                                <label for="piva">%Iva</label>
                                <input type="text" id="piva"  class="numeric form-control" name="piva" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px">
                            <div class="form-group">
                                <label for="vventa">Valor Venta</label>
                                <input type="text" id="vventa"  class="numeric form-control" name="vventa" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px">
                            <div class="form-group">
                                <label for="vlrtotal">Valor Total</label>
                                <input type="text" id="vlrtotalm" class="form-control" readonly>
                                <input hidden type="text" id="vlrtotal">
                            </div>
                        </div>
                        <div hidden class="div">
                            <input type="text" id="vcosto" class="numeric form-control">
                        </div>
                        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px">
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
                                    <tr>
                                        <th style="width: 25%">Artículo</th>
                                        <th style="width: 5%">Cant.</th>
                                        <th style="width: 15%">V/u.Costo</th>
                                        <th style="width: 15%">V/u.Neto</th>
                                        <th style="width: 5%">Iva</th>
                                        <th style="width: 15%">V/u.Venta</th>
                                        <th style="width: 15%">Vlr.Total</th>
                                        <th style="width: 5%">Borrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    </tr>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">$ 0.00</h4></th>
                                    <th></th>
                                    </tr>
                                </tfoot>
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
        Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
            var n = this,
                decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSeparator = decSeparator == undefined ? "." : decSeparator,
                thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
                sign = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
        };

        $(document).ready(function() {
            // multiplica cantidad por valor venta
            $('#cantidad').change(function(){
                var objSel      = document.getElementById("selArticulo");
                var index       = objSel.selectedIndex;
                var objCant     = document.getElementById("cantidad"); 
                var nCant       = parseFloat(objCant.value);
                var vNeto       = parseFloat(objSel.options[index+2].value);
                var pIva        = parseFloat(objSel.options[index+3].value);
                var vVenta      = vNeto + ((vNeto * pIva)/100);
                var objVtotm    = document.getElementById("vlrtotalm");
                var objVtot    = document.getElementById("vlrtotal");
                if (vVenta > 0) {
                    var nTotal      = vVenta * nCant;
                    objVtotm.value   = nTotal.formatMoney(2,'.',',');
                    objVtot.value   = nTotal;
                }
            }); 
            
            // calcula valor de venta para mostrar en el campo valor venta
            $("#selArticulo").change(function(){
                var objSel      = document.getElementById("selArticulo");
                var index       = objSel.selectedIndex;
                var objCant     = document.getElementById("cantidad");
                var objVenta    = document.getElementById("vventa");
                var objVtot     = document.getElementById("vlrtotal");
                var objVtotm    = document.getElementById("vlrtotalm");
                var vCosto      = parseFloat(objSel.options[index+1].value);
                var vNeto       = parseFloat(objSel.options[index+2].value);
                var pIva        = parseFloat(objSel.options[index+3].value);
                //var vMargen     = parseFloat(objSel.options[index+4].value);
                document.getElementById("vcosto").value = vCosto.formatMoney(2,'.',',');
                document.getElementById("vneto").value = vNeto.formatMoney(2,'.',',');
                document.getElementById("piva").value = pIva.formatMoney(2,'.',',');
                var vVenta      = vNeto + ((vNeto * pIva)/100);
                objVenta.value  = vVenta.formatMoney(2,'.',',');
                var nCant       = parseFloat(objCant.value);
                if (nCant > 0) {
                    var nTotal      = vVenta * nCant;
                    objVtotm.value   = nTotal.formatMoney(2,'.',',');
                    objVtot.value   = nTotal;
                }
                //alert(vCosto);
            });

            $('#add').click(function(){
                agregar();
            });

            var cont = 0;
            var total = 0;
            var totalm = 0;
            subtotal = [];
            $("#guardar").hide();
            
            function agregar(){
                idarticulo  = $('#selArticulo').val();
                articulo    = $('#selArticulo option:selected').text();
                cantidad    = $('#cantidad').val();
                vcosto      = $('#vcosto').val();
                vneto       = $('#vneto').val();
                piva        = $('#piva').val();
                vventa      = $('#vventa').val();
                vtotal      = $('#vlrtotal').val();
                if (idarticulo != "" && cantidad != "" && vventa != ""){
                    subtotal[cont] = parseFloat(vtotal);
                    submost = subtotal[cont].formatMoney(2,'.',',');
                    total = total + subtotal[cont];
                    totalm = total.formatMoney(2,'.',',');
                    
                    //alert(total);
                    var fila = `<tr class="selected" id="fila` + cont + `"><td><input type="hidden" name="idarticulo[]" value="`+idarticulo+`">`+articulo+`</td><td>`+cantidad+`</td><td>`+vcosto+`</td><td>`+vneto+`</td><td>`+piva+`</td><td>`+vventa+`</td><td>`+submost+`</td><td><button type="button" class="btn btn-warning" onclick="borrar(`+cont+`)"><span class="glyphicon glyphicon-trash"></span></button></td></tr>`;
                    cont++;
                    limpiar();
                    $('#total').html("$" + totalm);
                    ocultar_guardar();
                    $('#detalles').append(fila);
                }
                else{
                    alert('Error al ingresar el detalle del ingreso, revise los datos del artículo');
                }
            };

            function limpiar(){
                $("#cantidad").val("");
                $("#vcosto").val("");
                $("#vneto").val("");
                $("#piva").val("");
                $("#vventa").val("");
                $("#vlrtotalm").val("");
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
            $('#total').html("$" + total);
            $('#fila' + ind).remove();
            ocultar_guardar();
            alert('hola');
        };
    </script>
@endsection
@endsection