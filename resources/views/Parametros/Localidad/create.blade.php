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
                <h1>Localidades</h1>
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
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3>Crear Localidad<a href="/localidad"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                    </div>
                        <div class="box-body">
                            <div class="col col-md-8 col-md-offset-2">
                                {!!Form::open(array('url'=>'localidad', 'method'=>'POST', 'autocompleted'=>'off', 'id'=>'myForm'))!!}
                                {{Form::token()}}
                                <div class="form-group">    
                                    <label for="idred">Seleccione la Red *</label>
                                    <select id="idred" name="idred" class="form-control" autofocus>
                                        @foreach($redes as $item)
                                            <option value="{{$item->id}}">{{$item->codred}}-{{$item->desred}}</option>
                                        @endforeach
                                    </select>   
                                </div>
                                <div class="form-group">    
                                    <label for="idzon">Seleccione la Zona *</label>
                                    <select id="idzon" name="idzon" class="form-control">
                                        @foreach($zonas as $item)
                                            <option value="{{$item->id}}">{{$item->codzon}}-{{$item->nomzon}}</option>
                                        @endforeach 
                                    </select>   
                                </div>
                                <div class="form-group">    
                                    <label for="codloc">Codigo *</label>
                                    <input type="text" id="codloc" name="codloc" class="numeric form-control" value="{{old('codloc')}}" onfocus="true">
                                </div>
                                <div class="form-group">
                                    <label for="nomloc">Nombre *</label>
                                    <input type="text" name="nomloc" class="text form-control" value="{{old('nomloc')}}">
                                </div>
                                <div class="form-group">
                                    <label for="desloc">Detalle</label>
                                    <textarea rows="4" cols="50" name="desloc" class="text form-control" value="{{old('desloc')}}"></textarea>
                                </div>  
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                </div>
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
        $(".text").val('');
        $("#codzon").val('');

        $(".text").keyup(function(){
            this.value = this.value.toUpperCase();
        });
        /**
        *Función ajax para devolver las categorías de un proveedor
        */
        $('#idred').change(function(){
            var $sel = $(idzon);
            var cadena = `/AjaxTraeZona/${this.value}`;
            var val = "{{url("")}}";
            var conca = val.concat(cadena);
            var options = [];
            $sel.empty()
            $sel.find('option').not(':first').remove();
            $.ajax({
                url: conca,
                type: 'GET',
                dataType: "json",
                beforeSend: function() {$('#load').addClass("loading")},
                success: function(data){
                    $.each(data, function(index, item){
                        options.push(`<option value= "${item.id}">${item.codzon}-${item.nomzon}</option>`);
                    });
                    $sel.append(options);
                },
                complete: function(){$('div.loading').removeClass("loading")}
            });
        });
        /**
        *ajax para validar localidad en la red
        */
        $('#codloc').blur(function(){
            this.value = ('000' + this.value).slice (-3);
            var $sel = $('#codloc');
            var $Arg1 = $('#idred').val();
            var $Arg2 = $('#idzon').val();
            var cadena = `/AjaxLocalidad/${$Arg1}/${$Arg2}/${this.value}`;
            var val = "{{url("")}}";
            var conca = val.concat(cadena);
            var options = [];
            $.ajax({
                url: conca,
                type: 'GET',
                dataType: "json",
                beforeSend: function () {$('#load').addClass("loading")},
                success: function(data){
                    if (data.length > 0) {
                        alert('Este código ya existe');
                        $sel.focus();
                    }
                }
            }); 
        });
    </script>
    @endsection
@endsection