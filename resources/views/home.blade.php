<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>{{ Auth::user()->name }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="../assets/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="../assets/css/default/style.min.css" rel="stylesheet" />
    <link href="../assets/css/default/style-responsive.min.css" rel="stylesheet" />
    <link href="../assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    @php
        $bodyClass = !empty($boxedLayout) ? 'boxed-layout' : '';
        $bodyClass .= !empty($paceTop) ? 'pace-top ' : '';
        $bodyClass .= !empty($bodyExtraClass) ? $bodyExtraClass . ' ' : '';
        $sidebarHide = !empty($sidebarHide) ? $sidebarHide : '';
        $sidebarTwo = !empty($sidebarTwo) ? $sidebarTwo : '';
        $sidebarSearch = !empty($sidebarSearch) ? $sidebarSearch : '';
        $topMenu = !empty($topMenu) ? $topMenu : '';
        $footer = !empty($footer) ? $footer : '';

        $pageContainerClass = !empty($topMenu) ? 'page-with-top-menu ' : '';
        $pageContainerClass .= !empty($sidebarRight) ? 'page-with-right-sidebar ' : '';
        $pageContainerClass .= !empty($sidebarLight) ? 'page-with-light-sidebar ' : '';
        $pageContainerClass .= !empty($sidebarWide) ? 'page-with-wide-sidebar ' : '';
        $pageContainerClass .= !empty($sidebarHide) ? 'page-without-sidebar ' : '';
        $pageContainerClass .= !empty($sidebarMinified) ? 'page-sidebar-minified ' : '';
        $pageContainerClass .= !empty($sidebarTwo) ? 'page-with-two-sidebar ' : '';
        $pageContainerClass .= !empty($contentFullHeight) ? 'page-content-full-height ' : '';

        $contentClass = !empty($contentFullWidth) || !empty($contentFullHeight) ? 'content-full-width ' : '';
        $contentClass .= !empty($contentInverseMode) ? 'content-inverse-mode ' : '';
    @endphp
</head>

<body class="{{ $bodyClass }}">

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu">
        <!-- begin #header -->
        <div id="header" class="header navbar-default">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> <b>Color</b> Admin</a>
                <button type="button" class="navbar-toggle" data-click="top-menu-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end navbar-header -->

            <!-- begin header navigation right -->
            <ul class="navbar-nav navbar-right">

                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/assets/img/user/user-13.jpg" alt="" />
                        @auth
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> <b class="caret"></b>
                        @endauth
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:;" class="dropdown-item">Edit Profile</a>
                        <a href="javascript:;" class="dropdown-item">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ request()->is('admin*') ? route('admin.logout') : route('logout') }}"
                            method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Log Out</button>
                        </form>
                    </div>
                </li>
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end #header -->
        <!-- begin #page-container -->

        <!-- begin navbar-collapse -->
        <div id="top-menu" class="top-menu">
            <ul class="nav navbar-nav navbar-right ">
                <li class="has-sub">
                    <a href="" data-click="scroll-to-target" data-toggle="dropdown">HOME</a>
                    {{-- <ul class="sub-menu">
                        <li><a href="index.html">Page with Transparent Header</a></li>
                        <li><a href="index_inverse_header.html">Page with Inverse Header</a></li>
                        <li><a href="index_default_header.html">Page with White Header</a></li>
                        <li><a href="extra_element.html">Extra Element</a></li>
                    </ul> --}}
                </li>
                <li><a href="{{ route('user.kepala-keluarga.warga.index') }}">ABOUT</a></li>
                @if (auth()->check() && auth()->user()->role->nama === 'Warga')
                    <li><a href="{{ route('user.warga.wargak.index') }}">Data Warga</a></li>

                    <li class="has-sub">
                        <a href="javascript:;">
                            <span class="badge pull-right">10</span>
                            <i class="fa fa-hdd"></i>
                            <span>Email</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="email_inbox.html">Inbox</a></li>
                            <li><a href="email_compose.html">Compose</a></li>
                            <li><a href="email_detail.html">Detail</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="">
                            <i class="fa fa-medkit"></i>
                            <span>Status Pembayara Iuran</span>
                        </a>
                    </li>
                @endif
                @if (auth()->check() && auth()->user()->role->nama === 'Petugas')
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-cubes"></i>
                            <span>Version <span class="label label-theme m-l-5">NEW</span></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="javascript:;">HTML</a></li>
                            <li><a href="../template_ajax/index.html">AJAX</a></li>
                            <li><a href="../template_angularjs/index.html">ANGULAR JS</a></li>
                            <li><a href="../template_angularjs4/index.html">ANGULAR JS 4 <i
                                        class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="../template_material/index.html">MATERIAL DESIGN</a></li>
                            <li><a href="../template_apple/index.html">APPLE DESIGN <i
                                        class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                        </ul>
                    </li>

                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-align-left"></i>
                            <span>Menu Level</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="has-sub">
                                <a href="javascript:;">
                                    <b class="caret"></b>
                                    Menu 1.1
                                </a>
                                <ul class="sub-menu">
                                    <li class="has-sub">
                                        <a href="javascript:;">
                                            <b class="caret"></b>
                                            Menu 2.1
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:;">Menu 3.1</a></li>
                                            <li><a href="javascript:;">Menu 3.2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:;">Menu 2.2</a></li>
                                    <li><a href="javascript:;">Menu 2.3</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:;">Menu 1.2</a></li>
                            <li><a href="javascript:;">Menu 1.3</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>


        <!-- end navbar-collapse -->
        <!-- begin #top-menu -->
        {{-- <div id="top-menu" class="top-menu">
            <!-- begin top-menu nav -->
            <ul class="nav">
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-th-large"></i>
                        <span>Dashboard woii</span>
                    </a>
                </li>
                @if (auth()->check() && auth()->user()->role->nama === 'Warga')
                    <li class="has-sub">
                        <a href="javascript:;">
                            <span class="badge pull-right">10</span>
                            <i class="fa fa-hdd"></i>
                            <span>Email</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="email_inbox.html">Inbox</a></li>
                            <li><a href="email_compose.html">Compose</a></li>
                            <li><a href="email_detail.html">Detail</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <i class="fa fa-medkit"></i>
                            <span>Helper</span>
                        </a>
                    </li>
                @endif
                @if (auth()->check() && auth()->user()->role->nama === 'Petugas')
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-cubes"></i>
                            <span>Version <span class="label label-theme m-l-5">NEW</span></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="javascript:;">HTML</a></li>
                            <li><a href="../template_ajax/index.html">AJAX</a></li>
                            <li><a href="../template_angularjs/index.html">ANGULAR JS</a></li>
                            <li><a href="../template_angularjs4/index.html">ANGULAR JS 4 <i
                                        class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                            <li><a href="../template_material/index.html">MATERIAL DESIGN</a></li>
                            <li><a href="../template_apple/index.html">APPLE DESIGN <i
                                        class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                        </ul>
                    </li>

                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="fa fa-align-left"></i>
                            <span>Menu Level</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="has-sub">
                                <a href="javascript:;">
                                    <b class="caret"></b>
                                    Menu 1.1
                                </a>
                                <ul class="sub-menu">
                                    <li class="has-sub">
                                        <a href="javascript:;">
                                            <b class="caret"></b>
                                            Menu 2.1
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="javascript:;">Menu 3.1</a></li>
                                            <li><a href="javascript:;">Menu 3.2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:;">Menu 2.2</a></li>
                                    <li><a href="javascript:;">Menu 2.3</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:;">Menu 1.2</a></li>
                            <li><a href="javascript:;">Menu 1.3</a></li>
                        </ul>
                    </li>
                @endif
                <li class="menu-control menu-control-left">
                    <a href="javascript:;" data-click="prev-menu"><i class="fa fa-angle-left"></i></a>
                </li>
                <li class="menu-control menu-control-right">
                    <a href="javascript:;" data-click="next-menu"><i class="fa fa-angle-right"></i></a>
                </li>
            </ul>
            <!-- end top-menu nav -->
        </div> --}}
        <!-- end #top-menu -->

        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
                <li class="breadcrumb-item active">Page with Top Menu</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Page with Top Menu PETUGAS <small>header small text goes here...</small></h1>
            <!-- end page-header -->

            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Panel Title here</h4>
                </div>
                <div class="panel-body">
                    Panel Content Here
                </div>
                <a href="{{ url('admin/manajemen-keuangan/manajemen-pengeluaran/create') }}"
                    class="btn btn-outline-info">CREATE</a>
            </div>
            <!-- end panel -->
        </div>
        <!-- end #content -->

        <!-- begin theme-panel -->

        <!-- end theme-panel -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="../assets/plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../assets/plugins/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <!--[if lt IE 9]>
  <script src="../assets/crossbrowserjs/html5shiv.js"></script>
  <script src="../assets/crossbrowserjs/respond.min.js"></script>
  <script src="../assets/crossbrowserjs/excanvas.min.js"></script>
 <![endif]-->
    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/plugins/js-cookie/js.cookie.js"></script>
    <script src="../assets/js/theme/default.min.js"></script>
    <script src="../assets/js/apps.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>

</html>
