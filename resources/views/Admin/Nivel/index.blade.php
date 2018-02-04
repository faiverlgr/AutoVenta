@extends ('layouts.admin')
@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Page Header
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>
    <!-- /.Header -->

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="col-sm-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h4>Niveles</h4>
                </div>    
                <div class="box-body">
                    <div class="form-horizontal">
                        <label class="col-sm-2 control-label" for="">Nombre</label>
                        <div class="col-sm-10">  
                            <input class="form-control" type="text" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary">Aceptar</button>
                </div>  
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista</h3>
                </div>
                <div class="box-doby">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Cargo1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection