<header class="main-header">
    <!-- Logo -->
    <a href={{url('/')}} class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>G</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Sisetma</b>GS</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    
                    <ul class="dropdown-menu">
                        
                    </ul>
                </li>
                <!-- /.messages-menu -->

                <!-- Notifications Menu -->
                
                <!-- Tasks Menu -->
                
                <!-- User Account Menu -->

                <li class="dropdown user user-menu">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="dropdown-toggle" data-toggle="dropdown">
        
                        <span class="hidden-xs">Salir <i class="fa fa-sign-out"></i></span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>