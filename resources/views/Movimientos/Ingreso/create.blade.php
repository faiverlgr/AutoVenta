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
                        <h3>Crear Ingreso<a href="/ingresen"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                    </div>
                    {!!Form::open(array('url'=>'ingresen','method'=>'POST','autocompleted'=>'off'))!!}
                    {{Form::token()}}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">    
                                    <label fr="codprov">Proveedor *</label>
                                    <select name="idprov" id="idproveedor" class="form-control select2-container">
                                        @foreach($proveedores as $item)
                                        <option value="{{$item->id}}">{{$item->razons}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                                <div class="form-group">    
                                    <label for="numdoc">Documento</label>
                                    <input type="text" id="numdoc" name="numdoc" class="form-control" value="">
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
                                    <input type="hidden" id="idper" name="idper" class="form-control" value="{{$periodos->id}}">
                                    <input readonly type="text" class="form-control" value="{{$periodos->anoper}}-{{$periodos->mesper}}">
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
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px">
                                <div class="form-group">
                                    <label for="articulo">Cantidad</label>
                                    <input type="text" id="cantidadm" class="numeric form-control" name="cantidad">
                                    <input type="hidden" id="cantidad">
                                    <input type="hidden" id="vcosto">
                                </div>
                            </div>                        
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px">
                                <div class="form-group">
                                    <label for="vneto">Valor Neto </label>
                                    <input type="text" id="vnetom"  class="form-control" name="vneto" readonly>
                                    <input type="hidden" id="vneto">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px">
                                <div class="form-group">
                                    <label for="piva">%Iva</label>
                                    <input type="text" id="pivam"  class="form-control" name="piva" readonly>
                                    <input type="hidden" id="piva">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px">
                                <div class="form-group">
                                    <label for="vventa">Valor Venta</label>
                                    <input type="text" id="vventam"  class="form-control" name="vventa" readonly>
                                    <input type="hidden" id="vventa">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px">
                                <div class="form-group">
                                    <label for="vlrtotal">Valor Total</label>
                                    <input type="text" id="vlrtotalm" class="form-control" readonly>
                                    <input type="hidden" id="vlrtotal">
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
                    <input type="hidden" id="totalmargen" name="tmargen">
                    {!!Form::close()!!}
                </div>
            </section>
        </div>
        @include('layouts.footer')
    </div>
    @section('scripts')
        <script>
            $('#idproveedor').change(function(){
                var $sel = $(selArticulo);
                var cadena = `/articulosp/${this.value}`;
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
                            options.push(`<option value= "${item.id}">${item.codcate}${item.codarti}-${item.nomartic}</option>`);
                            options.push(`<option hidden value= "${item.vcosto}"></option>`);
                            options.push(`<option hidden value= "${item.vneto}"></option>`);
                            options.push(`<option hidden value= "${item.piva}"></option>`);
                            options.push(`<option hidden value= "${item.pmargen}"></option>`);
                        });
                        $sel.append(options);
                    },
                    complete: function(){$('div.loading').removeClass("loading")}
                }); 
            });

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
            //limpia campos
            limpiar();
            $("#fecha").val("");
            $("#numdoc").val("");

            function limpiar(){
                $("#cantidadm").val("");
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
            function agregar(){
                idarti  = $('#selArticulo').val();
                var nEncontro = 0;
                for(var i=0;i<ides.length;i++){
                    if (ides[i] == idarti) {
                        nEncontro = 1;
                    }
                };
                
                if (nEncontro == 0) {
                    articulo  = $('#selArticulo option:selected').text();
                    cantidad    = parseFloat($('#cantidad').val());
                    vcosto      = parseFloat($('#vcosto').val());
                    vneto       = parseFloat($('#vneto').val());
                    piva        = parseFloat($('#piva').val());
                    vventa      = parseFloat($('#vventa').val());
                    vtotal      = parseFloat($('#vlrtotal').val());
                    // si existe un articulo
                    if (articulo != "" && cantidad != "" && vventa != ""){
                        ides[cont] = idarti;
                        var cantdItem  = cantidad.formatMoney(2,'.',','); //para mostrar en tabla
                        // iva
                        var ivaItem   = piva.formatMoney(2,'.',','); //para mostrar en tabla
                        //costo
                        subTotalCosto[cont] = vcosto*cantidad;
                        var costoItem = subTotalCosto[cont].formatMoney(2,'.',','); //para mostrar en tabla
                        if (cont>0) {
                            acumCosto = parseFloat($('#totalcosto').val()) + subTotalCosto[cont];
                        } else {
                            acumCosto = subTotalCosto[cont];
                        }
                        $('#totalcosto').val(acumCosto);
                        $('#totalcostom').val(acumCosto.formatMoney(2,'.',',')); //para mostrar en totales
                        //neto
                        subTotalNeto[cont] = vneto*cantidad;
                        var vNetoItem  = vneto.formatMoney(2,'.',','); //para mostrar en tabla
                        var totalNetoItem = subTotalNeto[cont].formatMoney(2,'.',','); //para mostrar en tabla
                        if (cont>0) {
                            acumNeto = parseFloat($('#totalneto').val()) + subTotalNeto[cont];
                        } else {
                            acumNeto = subTotalNeto[cont];
                        }
                        $('#totalneto').val(acumNeto);
                        $('#totalnetom').val(acumNeto.formatMoney(2,'.',',')); //para mostrar en totales
                        //venta
                        subTotalVenta[cont] = vtotal;
                        var tVentaItem = vtotal.formatMoney(2,'.',','); //para mostrar en tabla
                        if (cont>0) {
                            acumVenta = parseFloat($('#totalventa').val()) + subTotalVenta[cont];
                        } else {
                            acumVenta = subTotalVenta[cont];
                        }
                        $('#totalventa').val(acumVenta);
                        $('#totalventam').val(acumVenta.formatMoney(2,'.',',')); //para mostrar en totales
                        //iva
                        subTotalIva[cont] = vtotal - subTotalNeto[cont];
                        if (cont>0) {
                            acumIva = parseFloat($('#totaliva').val()) + subTotalIva[cont];
                        } else {
                            acumIva = subTotalIva[cont];
                        }
                        $('#totaliva').val(acumIva);
                        $('#totalivam').val(acumIva.formatMoney(2,'.',',')); //para mostrar en totales
                        //margen
                        subTotalMargen[cont] = acumNeto - acumCosto;
                        if (cont>0) {
                            acumMargen = parseFloat($('#totalmargen').val()) + subTotalMargen[cont];
                        } else {
                            acumMargen = subTotalMargen[cont];
                        }
                        $('#totalmargen').val(acumMargen);

                        $('#totalmargen').val(acumMargen);
                        var fila = `<tr class="selected" id="fila` + cont + `"><input type="hidden" name="vtmarg[]" value="`+subTotalMargen[cont]+`"></td><td><input type="hidden" name="idarti[]" value="`+idarti+`">`+articulo+`</td><td><input type="hidden" name="cantidad[]" value="`+cantidad+`">`+cantdItem+`</td><td><input type="hidden" name="vcosto[]" value="`+vcosto+`">`+costoItem+`</td><td><input type="hidden" name="vneto[]" value="`+vneto+`">`+vNetoItem+`</td><td><input type="hidden" name="piva[]" value="`+piva+`">`+ivaItem+`</td><td>`+totalNetoItem+`</td><td><input type="hidden" name="vtotal[]" value="`+vtotal+`">`+tVentaItem+`</td><td><button type="button" class="btn btn-warning" onclick="eliminar(`+cont+`)"><span class="glyphicon glyphicon-trash"></span></button></td><td></tr>`;
                        cont++;
                        limpiar();
                        $('#detalles').append(fila);
                        ocultar_guardar();
                    } else{
                        alert('Error al ingresar el detalle del ingreso, revise los datos del artículo');
                    }
                } else {
                    alert('El artículo ya se encuentra en la tabla.');
                }
            };

            //valoriza cantidad ingresada
            function valorizar(){
                var objSel      = document.getElementById("selArticulo");
                var index       = objSel.selectedIndex;
                var objvCosto   = document.getElementById("vcosto");
                objvCosto.value = parseFloat(objSel.options[index+1].value);
                var objvNetom   = document.getElementById("vnetom");
                var objvNeto    = document.getElementById("vneto");
                var vNeto       = parseFloat(objSel.options[index+2].value);
                objvNeto.value  = vNeto;
                objvNetom.value = vNeto.formatMoney(2,'.',',');
                var objvpIvam   = document.getElementById("pivam");
                var objvpIva    = document.getElementById("piva");
                var pIva        = parseFloat(objSel.options[index+3].value);
                objvpIva.value  = pIva;
                objvpIvam.value = pIva.formatMoney(2,'.',',');
                var objVentam   = document.getElementById("vventam");
                var objVenta    = document.getElementById("vventa");
                var vVenta      = vNeto + ((vNeto * pIva)/100);
                objVenta.value  = vVenta;
                objVentam.value = vVenta.formatMoney(2,'.',',');
                var objCantm    = document.getElementById("cantidadm");
                var objCant     = document.getElementById("cantidad");
                var nCant       = parseFloat($('#cantidadm').val());
                if (nCant > 0) {
                    objCantm.value  = nCant.formatMoney(2,'.',',');
                    objCant.value   = nCant;                    
                    var objVtotm    = document.getElementById("vlrtotalm");
                    var objVtot     = document.getElementById("vlrtotal");
                    var vTotalItem  = nCant * vVenta  
                    objVtotm.value  = vTotalItem.formatMoney(2,'.',',');
                    objVtot.value   = vTotalItem;
                }
            }
            //retira item de la orden
            function eliminar(ind){
                acumCosto = $("#totalcosto").val() - subTotalCosto[ind];
                $("#totalcosto").val(acumCosto);
                $("#totalcostom").val("$" + acumCosto.formatMoney(2,'.',','));
                acumNeto = $("#totalneto").val() - subTotalNeto[ind];
                $("#totalneto").val(acumNeto);
                $("#totalnetom").val("$" + acumNeto.formatMoney(2,'.',','));
                acumVenta = $("#totalventa").val() - subTotalVenta[ind];
                $("#totalventa").val(acumVenta);
                $("#totalventam").val("$" + acumVenta.formatMoney(2,'.',','));
                acumIva = $("#totaliva").val() - subTotalIva[ind];
                $("#totaliva").val(acumIva);
                $("#totalivam").val("$" + acumIva.formatMoney(2,'.',','));
                acumMargen = $("#totalmargen").val() - subTotalMargen[ind];
                $("#totalmargen").val(acumMargen);
                $('#fila' + ind).remove();
                ides[ind] = "";
                ocultar_guardar();
            };
            //valida items para mostrar botón de guardar
            function ocultar_guardar(){
                if ($("#totalventa").val()>0){
                    $("#guardar").show();
                }
                else{
                    $("#guardar").hide();
                }
            };
            //clase de calendario para selección de fecha
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
        </script>
    @endsection
@endsection