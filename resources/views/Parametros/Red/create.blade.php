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
                <h1>Redes</h1>
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
                        <h3>Crear Red<a href="/red"><button class="btn btn-succes pull-right">Listado</button></a></h3>
                    </div>
                        <div class="box-body">
                            <div class="col col-md-8 col-md-offset-2">
                                {!!Form::open(array('url'=>'red', 'method'=>'POST', 'autocompleted'=>'off', 'id'=>'myForm'))!!}
                                {{Form::token()}}
                                <div class="form-group">    
                                    <label for="codage">Codigo *</label>
                                    <input type="text" id="codred" name="codred" class="numeric form-control" value="{{old('codage')}}" onfocus="">
                                </div>
                                <div class="form-group">
                                    <label for="nit">Nombre *</label>
                                    <input type="nombre" name="desred" class="text form-control" value="{{old('desred')}}">
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
        $("#codred").val('');

        $(".text").keyup(function(){
            this.value = this.value.toUpperCase();
        });

        $('#codred').blur(function(){
            this.value = ('000' + this.value).slice (-3);
        });
    </script>
    @endsection
@endsection