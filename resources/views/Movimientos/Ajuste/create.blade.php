@extends ('layouts.admin')
@section ('wrapper')
    <div id="app" class="wrapper">
        @include('layouts.partials.home.header')
        @include('layouts.partials.home.menu')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Ajustes</h1>
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
                        <h3>Crear Ajuste<a href="/ajusten"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                    </div>
                    {!!Form::open(array('url'=>'ajusten','method'=>'POST','autocompleted'=>'off'))!!}
                    {{Form::token()}}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                                <div class="form-group">    
                                    <label fr="codprov">Tipo *</label>
                                    <select name="idtipo" id="idtipo" class="form-control select2-container">
                                        <option>Seleccione tipo</option>
                                        @foreach($tipo as $item)
                                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                <div class="form-group">    
                                    <label fr="codprov">Concepto *</label>
                                    <select id="selconcepto" name="idconcepto"  class="form-control select2-container">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                                <div class="form-group">
                                    <label for="anoper">Fecha</label>
                                    <div class="input-group">
                                        <input type="date" id="fecha" name="fecha" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                                <div class="form-group">
                                    <label for="idper">Periodo</label>
                                    <input type="hidden" id="idper" name="idper" class="form-control" value="{{$periodo->id}}">
                                    <input readonly type="text" class="form-control" value="{{$periodo->anoper}}-{{$periodo->mesper}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body" style="border-top:0.5px; border-left: 0px; border-right: 0px; border-bottom: 0.5px; border-style: solid; border-color: #A9D0F5; ">
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3" style="padding-right:3px; width: 35%">
                                <div class="form-group">
                                    <label for="articulo">Articulo</label>
                                    <select id="selArticulo" class="form-control" name="selArticulo">
                                        <option>Seleccione articulo</option>
                                        @foreach($articulos as $item)
                                            <option value= "{{$item->id}}">{{$item->codcate}}{{$item->codarti}}-{{$item->nomartic}}</option>
                                            <option hidden value="{{$item->vcosto}}"></option>
                                            <option hidden value="{{$item->vneto}}"></option>
                                            <option hidden value="{{$item->piva}}"></option>
                                            <option hidden value="{{$item->stock}}"></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px; width: 10%">
                                <div class="form-group">
                                    <label for="articulo">Cantidad</label>
                                    <input type="text" id="cantidadm" class="numeric form-control" name="cantidad">
                                    <input type="hidden" id="cantidad">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px; width: 10%">
                                    <div class="form-group">
                                        <label for="Stock">Stock</label>
                                        <input type="text" id="stockm" class="numeric form-control" readonly>
                                        <input type="hidden" id="stock" name="stock">
                                    </div>
                                </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px; width: 11%">
                                <div class="form-group">
                                    <label for="vcosto">Valor Costo</label>
                                    <input type="text" id="vcostom"  class="form-control" name="vcostom" readonly>
                                    <input type="hidden" id="vcosto" name="vcosto">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px; width: 11%">
                                <div class="form-group">
                                    <label for="vneto">Valor Neto </label>
                                    <input type="text" id="vnetom"  class="form-control" name="vnetom" readonly>
                                    <input type="hidden" id="vneto" name="vneto">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px; width: 7%">
                                <div class="form-group">
                                    <label for="piva">Iva</label>
                                    <input type="text" id="pivam"  class="form-control" name="pivam" readonly>
                                    <input type="hidden" id="piva" name="piva">
                                </div>
                            </div>
                            <div class="hidden col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px width: 11%">
                                <div class="form-group">
                                    <label for="vventa">Valor Venta</label>
                                    <input type="text" id="vventam"  class="form-control" name="vventam" readonly>
                                    <input type="hidden" id="vventa" name="vventa">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px; width: 11%">
                                <div class="form-group">
                                    <label for="vlrtotal">Total a la venta</label>
                                    <input type="text" id="vlrtotalm" class="form-control" readonly>
                                    <input type="hidden" id="vlrtotal">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px; width: 5px">
                                <div class="form-group">
                                    <button type="button" id="add" class="btn btn-primary">+</button>
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
                                            <th style="width: 15%">Vlr.TNeto</th>
                                            <th style="width: 15%">Vlr.TVenta</th>
                                            <th style="width: 5%">Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        </tr>
                                            <th>TOTALES</th>
                                            <th></th>
                                            <th><input type="hidden" id="totalcosto" name="tcosto"><input type="text" id="totalcostom" class="form-control" readonly value="$ 0.00"></th>
                                            <th><input type="hidden" id="totalneto" name="tneto"><input type="text" id="totalnetom" class="form-control" readonly value="$ 0.00"></th>
                                            <th></th>
                                            <th><input type="hidden" id="totaliva" name="tiva"><input type="text" id="totalivam" class="form-control" readonly value="$ 0.00"></th>
                                            <th><input type="hidden" id="totalventa" name="tventa"><input type="text" id="totalventam" class="form-control" readonly value="$ 0.00"></th>
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
            $('#idtipo').change(function(){
                ajaxConceptos(this.value);
            });
            //busca conceptos de acuerdo al tipo (entrada o salida)
            function ajaxConceptos($parametro){
                var $sel = $(selconcepto);
                var cadena = `/selconcepto/`+$parametro;
                var val = "{{url("")}}";
                var conca = val.concat(cadena);
                var options = [];
                $sel.empty();
                $sel.find('option').not(':first').remove();
                $.ajax({
                    url: conca,
                    type: 'GET',
                    dataType: "json",
                    beforeSend: function () {$('#load').addClass("loading")},
                    success: function(data){
                        $.each(data, function(index, item){
                            options.push(`<option value= "${item.id}">${item.nombre}</option>`);
                            //options.push(`<option hidden value= "${item.tipo}"></option>`);
                        });
                        $sel.append(options);
                    },
                    complete: function(){$('div.loading').removeClass("loading")}
                }); 
            };
            
            //formato de número 2 (numero, decimales, signo, sep miles, sep decimal)
            function formatMoney1(number, places, symbol, thousand, decimal) {
                number = number || 0;
                places = !isNaN(places = Math.abs(places)) ? places : 2;
                symbol = symbol !== undefined ? symbol : "$";
                thousand = thousand || ",";
                decimal = decimal || ".";
                var negative = number < 0 ? "-" : "",
                    i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
                    j = (j = i.length) > 3 ? j % 3 : 0;
                return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
            }
            
            var cont = 0;
            var acumCosto = 0;
            var acumNeto  = 0;
            var acumVenta = 0;
            var acumMargen = 0;
            var acumIva = 0;
            subTotalCosto = [];
            subTotalNeto = [];
            subTotalVenta = [];
            subTotalMargen = [];
            subTotalIva = [];
            ides = [];
            //limpia campos al carrgar
            limpiar();
            ocultar_guardar();
            $("#fecha").val("");
            $("#selconcepto").attr('enabled', true);
            $("#idtipo").attr('enabled', true);
            document.getElementById("idtipo").selectedIndex=0;
            document.getElementById("selArticulo").selectedIndex=0;
            //totales tabla mostrados
            $("#totalcostom").val("");
            $("#totalnetom").val("");
            $("#totalivam").val("");
            $("#totalventam").val("");
            //totales tabla ocultos
            $("#totalcosto").val("");
            $("#totalneto").val("");
            $("#totaliva").val("");
            $("#totalventa").val("");
            //limpia campos de registro
            function limpiar(){
                $("#cantidadm").val("");
                $("#stockm").val("");
                $("#vcostom").val("");
                $("#vnetom").val("");
                $("#pivam").val("");
                $("#vventam").val("");
                $("#vlrtotalm").val("");
            };
            // multiplica cantidad por valor venta
            $('#cantidadm').change(function(){               
                valorizar();
            }); 
            // calcula valor de venta para mostrar en el campo valor venta
            $("#selArticulo").change(function(){
                valorizar();
            });
            // adiciona item al documento
            $('#add').click(function(){
                agregar();
            });
            //valoriza cantidad ingresada
            function valorizar(){
                var objSel       = document.getElementById("selArticulo");
                var index        = objSel.selectedIndex;
                //stock
                var objstockm    = document.getElementById("stockm");
                var objstock     = document.getElementById("stock");
                var stock        = parseFloat(objSel.options[index+4].value);
                objstock.value   = stock;
                objstockm.value  = formatMoney1(stock,2,'',',','.');
                //costo
                var objvCostom   = document.getElementById("vcostom");
                var objvCosto    = document.getElementById("vcosto");
                var vCosto       = parseFloat(objSel.options[index+1].value);
                objvCosto.value  = vCosto;
                objvCostom.value = formatMoney1(vCosto,2,'',',','.');
                //neto
                var objvNetom    = document.getElementById("vnetom");
                var objvNeto     = document.getElementById("vneto");
                var vNeto        = parseFloat(objSel.options[index+2].value);
                objvNeto.value   = vNeto;
                objvNetom.value  = formatMoney1(vNeto,2,'',',','.');
                //iva 
                var objvpIvam    = document.getElementById("pivam");
                var objvpIva     = document.getElementById("piva");
                var pIva         = parseFloat(objSel.options[index+3].value);
                objvpIva.value   = pIva;
                objvpIvam.value  = formatMoney1(pIva,2,'',',','.');
                //venta 
                var objVentam    = document.getElementById("vventam");
                var objVenta     = document.getElementById("vventa");
                var vVenta       = vNeto + ((vNeto * pIva)/100);
                objVenta.value   = vVenta;
                objVentam.value  = formatMoney1(vVenta,2,'',',','.');
                //cantidad 
                var objCantm     = document.getElementById("cantidadm");
                var objCant      = document.getElementById("cantidad");
                var nCant        = parseFloat(objCantm.value.replace(/[^0-9-.]/g, ''));
                objCant.value    = nCant;
                objCantm.value   = formatMoney1(nCant,2,'',',','.');

                if (nCant > 0) {
                    var objVtotm    = document.getElementById("vlrtotalm");
                    var objVtot     = document.getElementById("vlrtotal");
                    var objVenta    = document.getElementById("vventa");
                    var vTotalItem  = nCant * objVenta.value 
                    objVtotm.value  = formatMoney1(vTotalItem,2,'',',','.');
                    objVtot.value   = vTotalItem;
                }
            }
            //valida stock
            function agregar(){
                //si es una salida y la cantidad no puede ser mayor al stock
                if (idtipo.selectedIndex == 2) {
                    cantidad  = parseFloat($('#cantidad').val());
                    stocky    = parseFloat($('#stock').val());
                    if (cantidad > stocky || isNaN(stocky)) {
                        alert('La cantidad supera el stock.');
                    } else {
                       agregar1()
                    }
                }else{
                    agregar1()
                }
            }
            //agrega item a la tabla
            function agregar1(){
                //revisa si el item ya fue ingresado
                idarti  = $('#selArticulo').val();
                var nEncontro = 0;
                for(var i=0;i<ides.length;i++){
                    if (ides[i] == idarti) {
                        nEncontro = 1;
                    }
                };
                if (nEncontro == 0) {
                    articulo  = $('#selArticulo option:selected').text();
                    cantidad  = parseFloat($('#cantidad').val());
                    vcosto    = parseFloat($('#vcosto').val());
                    vneto     = parseFloat($('#vneto').val());
                    piva      = parseFloat($('#piva').val());
                    vventa    = parseFloat($('#vventa').val());
                    vtotal    = parseFloat($('#vlrtotal').val());
                    tipo      = parseFloat($('#idtipo').val());
                    // si existe un articulo
                    if (articulo != "" && cantidad != "" && vventa != "" && idtipo.selectedIndex != 0){

                        ides[cont] = idarti;
                        var cantdItem  = formatMoney1(cantidad,2,'',',','.'); //para mostrar en tabla
                        // iva
                        var ivaItem   = formatMoney1(piva,2,'',',','.'); //para mostrar en tabla
                        //costo
                        subTotalCosto[cont] = vcosto*cantidad;
                        var costoItem = formatMoney1(subTotalCosto[cont],2,'',',','.'); //para mostrar en tabla
                        if (cont>0) {
                            acumCosto = parseFloat($('#totalcosto').val()) + subTotalCosto[cont];
                        } else {
                            acumCosto = subTotalCosto[cont];
                        }
                        $('#totalcosto').val(acumCosto);
                        $('#totalcostom').val(formatMoney1(acumCosto,2,'',',','.')); //para mostrar en totales
                        //neto
                        subTotalNeto[cont] = vneto*cantidad;
                        var vNetoItem  = formatMoney1(vneto,2,'',',','.'); //para mostrar en tabla
                        var totalNetoItem = formatMoney1(subTotalNeto[cont],2,'',',','.'); //para mostrar en tabla
                        if (cont>0) {
                            acumNeto = parseFloat($('#totalneto').val()) + subTotalNeto[cont];
                        } else {
                            acumNeto = subTotalNeto[cont];
                        }
                        $('#totalneto').val(acumNeto);
                        $('#totalnetom').val(formatMoney1(acumNeto,2,'',',','.')); //para mostrar en totales
                        //venta
                        subTotalVenta[cont] = vtotal;
                        var tVentaItem = formatMoney1(vtotal,2,'',',','.'); //para mostrar en tabla
                        if (cont>0) {
                            acumVenta = parseFloat($('#totalventa').val()) + subTotalVenta[cont];
                        } else {
                            acumVenta = subTotalVenta[cont];
                        }
                        $('#totalventa').val(acumVenta);
                        $('#totalventam').val(formatMoney1(acumVenta,2,'',',','.')); //para mostrar en totales
                        //iva
                        subTotalIva[cont] = vtotal - subTotalNeto[cont];
                        if (cont>0) {
                            acumIva = parseFloat($('#totaliva').val()) + subTotalIva[cont];
                        } else {
                            acumIva = subTotalIva[cont];
                        }
                        $('#totaliva').val(acumIva);
                        $('#totalivam').val(formatMoney1(acumIva,2,'',',','.')); //para mostrar en totales
                        //pinta
                        var fila = `<tr class="selected" id="fila` + cont + `"><td><input type="hidden" name="idarti[]" value="`+idarti+`">`+articulo+`</td><td><input type="hidden" name="cantidad[]" value="`+cantidad+`">`+cantdItem+`</td><td><input type="hidden" name="vcosto[]" value="`+vcosto+`">`+costoItem+`</td><td><input type="hidden" name="vneto[]" value="`+vneto+`">`+vNetoItem+`</td><td><input type="hidden" name="piva[]" value="`+piva+`">`+ivaItem+`</td><td>`+totalNetoItem+`</td><td><input type="hidden" name="vtotal[]" value="`+vtotal+`">`+tVentaItem+`</td><td><button type="button" class="btn btn-warning" onclick="eliminar(`+cont+`)"><span class="glyphicon glyphicon-trash"></span></button></td><td></tr>`;
                        cont++;
                        limpiar();
                        $('#detalles').append(fila);
                        ocultar_guardar();
                        
                    } else{
                        alert('Error al ingresar el detalle del ingreso, revise los datos del artículo');
                    }
                } else {
                    alert('El artículo ya se encuentra en la lista.');
                }
            };
            //retira item de la tabla
            function eliminar(ind){
                acumCosto = $("#totalcosto").val() - subTotalCosto[ind];
                $("#totalcosto").val(acumCosto);
                $("#totalcostom").val(formatMoney1(acumCosto,2,'$',',','.'));
                acumNeto = $("#totalneto").val() - subTotalNeto[ind];
                $("#totalneto").val(acumNeto);
                $("#totalnetom").val(formatMoney1(acumNeto,2,'$',',','.'));
                acumIva = $("#totaliva").val() - subTotalIva[ind];
                $("#totaliva").val(acumIva);
                $("#totalivam").val(formatMoney1(acumIva,2,'$',',','.'));
                acumVenta = $("#totalventa").val() - subTotalVenta[ind];
                $("#totalventa").val(acumVenta);
                $("#totalventam").val(formatMoney1(acumVenta,2,'$',',','.'));
                //remueve
                $('#fila' + ind).remove();
                cont--;
                ides[ind] = "";
                ocultar_guardar();
            };
            //valida items para mostrar botón de guardar
            function ocultar_guardar(){
                if (cont > 0){
                    $("#guardar").show();
                    $("#selconcepto").prop('disabled', true);
                    $("#idtipo").prop('disabled', true);
                }
                else{
                    $("#guardar").hide();
                    $("#selconcepto").prop('disabled', false);
                    $("#idtipo").prop('disabled', false);
                }
            };
            $("#guardar").click(function(){
                $("#selconcepto").prop('disabled', false);
                $("#idtipo").prop('disabled', false);
            });
        </script>
    @endsection
@endsection