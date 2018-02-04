<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src=" {{ asset('images/user.jpg')}} " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Usuario: {{ auth()->user()->user }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU DE OPCIONES</li>
            <!--Maestros-->
            <li class="treeview menu">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Maestros</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/proveedor')}}"><i class="fa fa-circle-o"></i>Proveedores</a></li>
                    <li><a href="{{url('/categoria')}}"><i class="fa fa-circle-o"></i>Categorias</a></li>
                    <li><a href="{{url('/articulo')}}"><i class="fa fa-circle-o"></i>Articulos</a></li>
                </ul>
            </li>
            <!--Parámetros-->
            <li class="treeview menu">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Movimientos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/cargo')}}"><i class="fa fa-circle-o"></i> Cargue de facturas</a></li>
                </ul>
            </li>
            <!--Parámetros-->
            <li class="treeview menu">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Parametros</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/cargo')}}"><i class="fa fa-circle-o"></i> Agencias</a></li>
                    <li><a href="{{url('/cargo')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>