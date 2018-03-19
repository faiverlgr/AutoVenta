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
                        <h3>Ver Ingreso<a href="/ingresen"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">    
                                    <label fr="codprov">Proveedor</label>
                                    <input readonly type="text" id="idprov" class="form-control" value="{{$ingreso->razons}}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                                <div class="form-group">    
                                    <label for="numdoc">Documento</label>
                                    <input readonly type="text" id="numdoc" class="form-control" value="{{$ingreso->numdoc}}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                                <div class="form-group">
                                    <label for="anoper">Fecha</label>
                                    <div class="input-group">
                                        <input readonly type="text" id="fecha" class="form-control" value="{{$ingreso->fecha}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                                <div class="form-group">
                                    <label for="idper">Periodo</label>
                                    <input readonly type="text" id="idper" class="form-control" value="{{$ingreso->anoper}}-{{$ingreso->mesper}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body" style="border-top:0.5px; border-left: 0px; border-right: 0px; border-bottom: 0.5px; border-style: solid; border-color: #A9D0F5; ">
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3" style="padding-right:3px">
                                <div class="form-group">
                                    <label for="tcosto">Total Costo</label>
                                    <input readonly type="text" id="totalcostom" class="form-control" value="{{$ingreso->tcosto}}">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="padding-left:3px; padding-right:3px">
                                <div class="form-group">
                                    <label for="tneto">Total Neto</label>
                                    <input readonly type="text" id="totalneto" class="form-control" value="{{$ingreso->tneto}}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px">
                                <div class="form-group">
                                    <label for="tiva">Total Iva</label>
                                    <input readonly type="text" id="totaliva" class="form-control" value="{{$ingreso->tiva}}">
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding-left:3px; padding-right:3px">
                                <div class="form-group">
                                    <label for="tventa">Total Venta</label>
                                    <input readonly type="text" id="totaventa" class="form-control" value="{{$ingreso->tventa}}">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detalle as $item)
                                            <tr>
                                                <td>{{$item->codprov}}{{$item->codcate}}{{$item->codarti}}-{{$item->nomartic}}</td>
                                                <td>{{$item->cantidad}}</td>
                                                <td>{{$item->vcosto}}</td>
                                                <td>{{$item->vneto}}</td>
                                                <td>{{$item->piva}}</td>
                                                <td>{{$item->vtneto}}</td>
                                                <td>{{$item->vtotal}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
        </script>
    @endsection
@endsection