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
                <h1>Zonas</h1>
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
                        <h3>Crear Zona<a href="/zona"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                    </div>
                        <div class="box-body">
                            <div class="col col-md-8 col-md-offset-2">
                                {!!Form::open(array('url'=>'zona', 'method'=>'POST', 'autocompleted'=>'off', 'id'=>'myForm'))!!}
                                {{Form::token()}}
                                <div class="form-group">    
                                    <label for="codred">Seleccione la Red *</label>
                                    <select id="codred" name="codred" class="form-control" autofocus>
                                        @foreach($redes as $item)
                                            <option value="{{$item->id}}">{{$item->codred}}-{{$item->desred}}</option>
                                        @endforeach
                                    </select>   
                                </div>
                                <div class="form-group">    
                                    <label for="codzon">Codigo *</label>
                                    <input type="text" id="codzon" name="codzon" class="numeric form-control" value="{{old('codzon')}}" onfocus="true">
                                </div>
                                <div class="form-group">
                                    <label for="nomzon">Nombre *</label>
                                    <input type="text" name="nomzon" class="text form-control" value="{{old('nomzon')}}">
                                </div>
                                <div class="form-group">
                                    <label for="zondes">Detalle</label>
                                    <textarea rows="4" cols="50" name="deszon" class="text form-control" value="{{old('deszon')}}"></textarea>
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
        //ajax para validar zona en la red
        $('#codzon').blur(function(){
            this.value = ('000' + this.value).slice (-3);
            var $sel = $('#codzon');
            var $Arg = $('#codred').val();
            var cadena = `/AjaxZona/${$Arg}/${this.value}`;
            var val = "{{url("")}}";
            var conca = val.concat(cadena);
            var options = [];
            //$sel.empty()
            //$sel.find('option').not(':first').remove();
            $.ajax({
                url: conca,
                type: 'GET',
                dataType: "json",
                beforeSend: function () {$('#load').addClass("loading")},
                success: function(data){
                    if (data.length > 0) {
                        alert('Este código ya existe para la red seleccionada');
                        $sel.focus();
                    }
                }
                //complete: 
            }); 
        });
    </script>
    @endsection
@endsection