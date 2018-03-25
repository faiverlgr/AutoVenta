@extends ('layouts.admin')
@section ('wrapper')
<div id="app" class="wrapper">
    @include('layouts.partials.home.header')
    @include('layouts.partials.home.menu')
    <div class="content-wrapper">
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
        <section class="content container-fluid">
            
            <div id="box-default" class="box box-default">
                <div class="box-header with-border">
                    <h3>Nuevo Articulo<a href="/articulo"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                </div>
                    <div class="box-body">
                        <div class="col col-sm-10 col-sm-offset-1">
                            {!!Form::open(array('url'=>'articulo','method'=>'POST','autocompleted'=>'off'))!!}
                            {{Form::token()}}
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="codarti">Seleccione un Proveedor *</label>
                                        <select id="idprov" name="idprov" class="form-control">
                                            @foreach($proveedores as $prov)
                                                <option value="{{$prov->id}}">{{$prov->codprov}}-{{$prov->razons}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="codarti">Seleccione una Categoria *</label>
                                        <select id="idcate" name="idcate" class="form-control">
                                            @foreach($categorias as $item)
                                                <option value="{{$item->id}}">{{$item->codcate}}-{{$item->nomcate}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="codarti">Codigo *</label>
                                        <input id="codarti" type="text" name="codarti" class="llena4 numeric form-control" value="{{old('codarti')}}" required>
                                    </div>
                                </div>
                                <div class="col col-md-10">
                                    <div class="form-group">
                                        <label class="control-label" for="nombre">Nombre*</label>
                                        <input type="text" name="nomartic" class="text form-control" value="{{old('nomartic')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="nombrec">Nombre abreviado</label>
                                        <input type="text" name="nomarti" class="text form-control" value="{{old('nomarti')}}">
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
                                        <input type="number" name="minimo" class="numeric form-control" value="{{old('minimo')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="maximo">Máximo *</label>
                                        <input type="number" name="maximo" class="numeric form-control" value="{{old('maximo')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="embalaje">Embalaje *</label>
                                        <input type="number" name="embalaje" class="numeric form-control" value="{{old('embalaje')}}" required>
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
                            <input type="hidden" name="validaArti" id="validaArti"></input>
                            {!!Form::close()!!}
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
        $('#idprov').change(function(){
            var $sel = $(idcate);
            var cadena = `/ajaxCate/${this.value}`;
            var val = "{{url("")}}";
            var conca = val.concat(cadena);
            var options = [];
            $sel.empty()
            $sel.find('option').not(':first').remove();
            $.ajax({
                url: conca,
                type: 'GET',
                dataType: "json",
                beforeSend: function () {$('#load').addClass("loading")},
                success: function(data){
                    $.each(data, function(index, item){
                        options.push(`<option value= "${item.id}">${item.codcate}-${item.nomcate}</option>`);
                    });
                    $sel.append(options);
                },
                complete: function(){$('div.loading').removeClass("loading")}
            }); 
        });

        //rellena ceros a la izquierda
        $("input.llena4").blur(function(){
            if  (this.value != ""){
                var n = this.value.toString();
                while(n.length < 4)
                n = "0" + n;
                this.value = n;
                uneCodigo();
            }
        });
        //convierte a mayúsculas
        $(".text").keyup(function(){
            this.value = this.value.toUpperCase();
        });
        //sólo permite números
        $(".numeric").numeric();
        
        //prepara código para validación e ingreso
        $('#idprov').change(function(){
            uneCodigo();
        });

        $('#idcate').change(function(){
            uneCodigo();
        });
        $('#codarti').change(function(){
            uneCodigo();
        });

        function uneCodigo(){
            var valor1 = document.getElementById('idprov').value;
            var valor2 = document.getElementById('idcate').value;
            var valor3 = document.getElementById('codarti').value;
            document.getElementById('validaArti').value = valor1+'-'+valor2+'='+valor3;
        };
    </script>
    @endsection
@endsection