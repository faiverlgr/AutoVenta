@extends ('layouts.admin')
@section ('wrapper')
<div id="app" class="wrapper">
    @include('layouts.partials.home.header')
    @include('layouts.partials.home.menu')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Categorias</h1>
            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
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
                    <h3>Nueva Categoria<a href="/categoria"><button class="btn btn-md btn-succes pull-right">Listado</button></a></h3>
                </div>
                <div class="box-body">
                    <div class="col-md-8 col-md-offset-2">
                        {!!Form::open(array('name'=>'form', 'url'=>'categoria', 'method'=>'POST', 'autocompleted'=>'off'))!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col col-md-3">
                                <div class="form-group"> 
                                    <label for="codprov">Proveedor *</label>
                                    <select class="form-control" name="idprov" id="selector" onchange="myFunction()">
                                        @foreach($proveedores as $prov)
                                        <option value="{{$prov->id}}">{{$prov->codprov}}</option>
                                        <option hidden value="{{$prov->razons}}">{{$prov->razons}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-group">
                                    <label for="codprov">Nombre</label>
                                    <input disabled id="detalle" class="form-control" type="text" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="codcate">Codigo *</label>
                                    <input type="text" id="codcate" name="codcate" class="llena4 numeric form-control" placeholder="Categoria.." value="{{old('codcate')}}" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="nomcate">Nombre *</label>
                                    <input type="text" name="nomcate" class="text form-control" value="{{old('nomcate')}}">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="validaCate" id="validaCate">
                            </div>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.footer')
</div>
    @section('scripts')
    <script>
        //rellena ceros a la izquierda
        $("input.llena4").blur(function(){
            if  (this.value != ""){
                this.value = ('0000' + this.value).slice (-4);
                uneCodigo();
            }
        });
        //convierte a mayúsculas
        $(".text").keyup(function(){
            this.value = this.value.toUpperCase();
        });
        //sólo permite números
        $(".numeric").numeric();
        
        function myFunction(){
            desc=form.selector.options[form.selector.selectedIndex+1].value;
            $('#detalle').val(desc);
            $('#codcate').val(''); //limpia codigo de categoria
        };

        function uneCodigo(){
            var valor1 = document.getElementById('selector').value;
            var valor2 = document.getElementById('codcate').value;
            document.getElementById('validaCate').value = valor1+'-'+valor2;
        };
        
    </script>
    @endsection
@endsection