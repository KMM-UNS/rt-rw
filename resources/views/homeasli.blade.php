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

    <style>
        img {
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body class="{{ $bodyClass }}">

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container"
        class="bg-light page-container fade page-without-sidebar page-header-fixed page-with-top-menu">
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
                        <a href="javascript:;" class="dropdown-item">Editx Profile</a>
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
                    <a href="#home" data-click="scroll-to-target" data-toggle="dropdown">HOME</a>
                    {{-- <ul class="sub-menu">
                        <li><a href="index.html">Page with Transparent Header</a></li>
                        <li><a href="index_inverse_header.html">Page with Inverse Header</a></li>
                        <li><a href="index_default_header.html">Page with White Header</a></li>
                        <li><a href="extra_element.html">Extra Element</a></li>
                    </ul> --}}
                </li>
                <li><a href="#about" data-click="scroll-to-target">ABOUT</a></li>
                @if (auth()->check() && auth()->user()->role->nama === 'Petugas')
                    <li><a href="{{ route('user.kepala-keluarga.warga.index') }}">Data Pembayaran</a></li>
                @endif
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

        <!-- begin tambahan -->
        <div class="container-fluid">


            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="" src="../assets/img/bg/bg-home.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="" src="../assets/img/bg/bg-home.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="" src="../assets/img/bg/bg-home.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="container home-content">
                <h1>Welcome to Color Admin</h1>
                <h3>Multipurpose One Page Theme</h3>
                <p>
                    We have created a multi-purpose theme that take the form of One-Page or Multi-Page Version.<br />
                    Use our <a href="#">theme panel</a> to select your favorite theme color.
                </p>
                <a href="#" class="btn btn-theme">Explore More</a> <a href="#"
                    class="btn btn-outline">Purchase Now</a><br />
                <br />
                or <a href="#">subscribe</a> newsletter
            </div>
        </div>
        <!-- end tambahan -->
        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            {{-- <ol class="breadcrumb pull-right">
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
            <!-- end panel --> --}}
            <!-- begin #about -->
            <div id="about" class="content" data-scrollview="true">
                <!-- begin container -->
                <div class="container" data-animation="true" data-animation-type="fadeInDown">
                    <h2 class="content-title">About Us</h2>
                    <p class="content-desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros
                        dolor,<br />
                        sed bibendum turpis luctus eget
                    </p>
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-6">
                            <!-- begin about -->
                            <div class="about">
                                <h3>Our Story</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vestibulum posuere augue eget ante porttitor fringilla.
                                    Aliquam laoreet, sem eu dapibus congue, velit justo ullamcorper urna,
                                    non rutrum dolor risus non sapien. Vivamus vel tincidunt quam.
                                    Donec ultrices nisl ipsum, sed elementum ex dictum nec.
                                </p>
                                <p>
                                    In non libero at orci rutrum viverra at ac felis.
                                    Curabitur a efficitur libero, eu finibus quam.
                                    Pellentesque pretium ante vitae est molestie, ut faucibus tortor commodo.
                                    Donec gravida, eros ac pretium cursus, est erat dapibus quam,
                                    sit amet dapibus nisl magna sit amet orci.
                                </p>
                            </div>
                            <!-- end about -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-6">
                            <h3>Our Philosophy</h3>
                            <!-- begin about-author -->
                            <div class="about-author">
                                <div class="quote bg-silver">
                                    <i class="fa fa-quote-left"></i>
                                    <h3>We work harder,<br /><span>to let our user keep simple</span></h3>
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="author">
                                    <div class="image">
                                        {{-- <img src="../assets/img/user/user-1.jpg" alt="Sean Ngu" /> --}}
                                    </div>
                                    <div class="info">
                                        Sean Ngu
                                        <small>Front End Developer</small>
                                    </div>
                                </div>
                            </div>
                            <!-- end about-author -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-12">
                            <h3>Our Experience</h3>
                            <!-- begin skills -->
                            <div class="skills">
                                <div class="skills-name">Front End</div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width: 95%">
                                        <span class="progress-number">95%</span>
                                    </div>
                                </div>
                                <div class="skills-name">Programming</div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width: 90%">
                                        <span class="progress-number">90%</span>
                                    </div>
                                </div>
                                <div class="skills-name">Database Design</div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width: 85%">
                                        <span class="progress-number">85%</span>
                                    </div>
                                </div>
                                <div class="skills-name">Wordpress</div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width: 80%">
                                        <span class="progress-number">80%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end skills -->
                        </div>
                        <!-- end col-4 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end #about -->
            <!-- begin #about -->
            <div id="about" class="content" data-scrollview="true">
                <!-- begin container -->
                <div class="container" data-animation="true" data-animation-type="fadeInDown">
                    <h2 class="content-title">About Us</h2>
                    <p class="content-desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros
                        dolor,<br />
                        sed bibendum turpis luctus eget
                    </p>
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-6">
                            <!-- begin about -->
                            <div class="about">
                                <h3>Our Story</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vestibulum posuere augue eget ante porttitor fringilla.
                                    Aliquam laoreet, sem eu dapibus congue, velit justo ullamcorper urna,
                                    non rutrum dolor risus non sapien. Vivamus vel tincidunt quam.
                                    Donec ultrices nisl ipsum, sed elementum ex dictum nec.
                                </p>
                                <p>
                                    In non libero at orci rutrum viverra at ac felis.
                                    Curabitur a efficitur libero, eu finibus quam.
                                    Pellentesque pretium ante vitae est molestie, ut faucibus tortor commodo.
                                    Donec gravida, eros ac pretium cursus, est erat dapibus quam,
                                    sit amet dapibus nisl magna sit amet orci.
                                </p>
                            </div>
                            <!-- end about -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-6">
                            <h3>Our Philosophy</h3>
                            <!-- begin about-author -->
                            <div class="about-author">
                                <div class="quote bg-silver">
                                    <i class="fa fa-quote-left"></i>
                                    <h3>We work harder,<br /><span>to let our user keep simple</span></h3>
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="author">
                                    <div class="image">
                                        {{-- <img src="../assets/img/user/user-1.jpg" alt="Sean Ngu" /> --}}
                                    </div>
                                    <div class="info">
                                        Sean Ngu
                                        <small>Front End Developer</small>
                                    </div>
                                </div>
                            </div>
                            <!-- end about-author -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-12">
                            <h3>Our Experience</h3>
                            <!-- begin skills -->
                            <div class="skills">
                                <div class="skills-name">Front End</div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width: 95%">
                                        <span class="progress-number">95%</span>
                                    </div>
                                </div>
                                <div class="skills-name">Programming</div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width: 90%">
                                        <span class="progress-number">90%</span>
                                    </div>
                                </div>
                                <div class="skills-name">Database Design</div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width: 85%">
                                        <span class="progress-number">85%</span>
                                    </div>
                                </div>
                                <div class="skills-name">Wordpress</div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width: 80%">
                                        <span class="progress-number">80%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end skills -->
                        </div>
                        <!-- end col-4 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end #about -->

            <!-- begin #milestone -->
            <div id="milestone" class="content bg-black-darker has-bg" data-scrollview="true">
                <!-- begin content-bg -->
                <div class="content-bg">
                    <img src="../assets/img/bg/bg-milestone.jpg" alt="Milestone" />
                </div>
                <!-- end content-bg -->
                <!-- begin container -->
                <div class="container">
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-3 -->
                        <div class="col-md-3 col-sm-3 milestone-col">
                            <div class="milestone">
                                <div class="number" data-animation="true" data-animation-type="number"
                                    data-final-number="1292">1,292</div>
                                <div class="title">Themes & Template</div>
                            </div>
                        </div>
                        <!-- end col-3 -->
                        <!-- begin col-3 -->
                        <div class="col-md-3 col-sm-3 milestone-col">
                            <div class="milestone">
                                <div class="number" data-animation="true" data-animation-type="number"
                                    data-final-number="9039">9,039</div>
                                <div class="title">Registered Members</div>
                            </div>
                        </div>
                        <!-- end col-3 -->
                        <!-- begin col-3 -->
                        <div class="col-md-3 col-sm-3 milestone-col">
                            <div class="milestone">
                                <div class="number" data-animation="true" data-animation-type="number"
                                    data-final-number="89291">89,291</div>
                                <div class="title">Items Sold</div>
                            </div>
                        </div>
                        <!-- end col-3 -->
                        <!-- begin col-3 -->
                        <div class="col-md-3 col-sm-3 milestone-col">
                            <div class="milestone">
                                <div class="number" data-animation="true" data-animation-type="number"
                                    data-final-number="129">129</div>
                                <div class="title">Theme Authors</div>
                            </div>
                        </div>
                        <!-- end col-3 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end #milestone -->

            <!-- begin #team -->
            <div id="team" class="content" data-scrollview="true">
                <!-- begin container -->
                <div class="container">
                    <h2 class="content-title">Our Team</h2>
                    <p class="content-desc">
                        Phasellus suscipit nisi hendrerit metus pharetra dignissim. Nullam nunc ante, viverra quis<br />
                        ex non, porttitor iaculis nisi.
                    </p>
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <!-- begin team -->
                            <div class="team">
                                <div class="image" data-animation="true" data-animation-type="flipInX">
                                    <img src="../assets/img/user/user-1.jpg" alt="Ryan Teller" />
                                </div>
                                <div class="info">
                                    <h3 class="name">Ryan Teller</h3>
                                    <div class="title text-theme">FOUNDER</div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                        eget
                                        dolor.</p>
                                    <div class="social">
                                        <a href="#"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                        <a href="#"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                        <a href="#"><i class="fa fa-google-plus fa-lg fa-fw"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end team -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <!-- begin team -->
                            <div class="team">
                                <div class="image" data-animation="true" data-animation-type="flipInX">
                                    <img src="../assets/img/user/user-2.jpg" alt="Jonny Cash" />
                                </div>
                                <div class="info">
                                    <h3 class="name">Johnny Cash</h3>
                                    <div class="title text-theme">WEB DEVELOPER</div>
                                    <p>Donec quam felis, ultricies nec, pellentesque eu sem. Nulla consequat massa quis
                                        enim.</p>
                                    <div class="social">
                                        <a href="#"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                        <a href="#"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                        <a href="#"><i class="fa fa-google-plus fa-lg fa-fw"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end team -->
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <!-- begin team -->
                            <div class="team">
                                <div class="image" data-animation="true" data-animation-type="flipInX">
                                    <img src="../assets/img/user/user-3.jpg" alt="Mia Donovan" />
                                </div>
                                <div class="info">
                                    <h3 class="name">Mia Donovan</h3>
                                    <div class="title text-theme">WEB DESIGNER</div>
                                    <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean
                                        imperdiet.
                                    </p>
                                    <div class="social">
                                        <a href="#"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                                        <a href="#"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                                        <a href="#"><i class="fa fa-google-plus fa-lg fa-fw"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end team -->
                        </div>
                        <!-- end col-4 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end #team -->

            <!-- begin #quote -->
            <div id="quote" class="content bg-black-darker has-bg" data-scrollview="true">
                <!-- begin content-bg -->
                <div class="content-bg">
                    <img src="../assets/img/bg/bg-quote.jpg" alt="Quote" />
                </div>
                <!-- end content-bg -->
                <!-- begin container -->
                <div class="container" data-animation="true" data-animation-type="fadeInLeft">
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-12 -->
                        <div class="col-md-12 quote">
                            <i class="fa fa-quote-left"></i> Passion leads to design, design leads to performance,
                            <br />
                            performance leads to <span class="text-theme">success</span>!
                            <i class="fa fa-quote-right"></i>
                            <small>Sean Themes, Developer Teams in Malaysia</small>
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end #quote -->

            <!-- beign #service -->
            <div id="service" class="content" data-scrollview="true">
                <!-- begin container -->
                <div class="container">
                    <h2 class="content-title">Our Services</h2>
                    <p class="content-desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros
                        dolor,<br />
                        sed bibendum turpis luctus eget
                    </p>
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="service">
                                <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i
                                        class="fa fa-cog"></i></div>
                                <div class="info">
                                    <h4 class="title">Easy to Customize</h4>
                                    <p class="desc">Duis in lorem placerat, iaculis nisi vitae, ultrices tortor.
                                        Vestibulum molestie ipsum nulla. Maecenas nec hendrerit eros, sit amet maximus
                                        leo.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="service">
                                <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i
                                        class="fa fa-paint-brush"></i></div>
                                <div class="info">
                                    <h4 class="title">Clean & Careful Design</h4>
                                    <p class="desc">Etiam nulla turpis, gravida et orci ac, viverra commodo ipsum.
                                        Donec
                                        nec mauris faucibus, congue nisi sit amet, lobortis arcu.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="service">
                                <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i
                                        class="fa fa-file"></i></div>
                                <div class="info">
                                    <h4 class="title">Well Documented</h4>
                                    <p class="desc">Ut vel laoreet tortor. Donec venenatis ex velit, eget bibendum
                                        purus
                                        accumsan cursus. Curabitur pulvinar iaculis diam.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col-4 -->
                    </div>
                    <!-- end row -->
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="service">
                                <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i
                                        class="fa fa-code"></i></div>
                                <div class="info">
                                    <h4 class="title">Re-usable Code</h4>
                                    <p class="desc">Aenean et elementum dui. Aenean massa enim, suscipit ut molestie
                                        quis, pretium sed orci. Ut faucibus egestas mattis.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="service">
                                <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i
                                        class="fa fa-shopping-cart"></i></div>
                                <div class="info">
                                    <h4 class="title">Online Shop</h4>
                                    <p class="desc">Quisque gravida metus in sollicitudin feugiat. Class aptent
                                        taciti
                                        sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col-4 -->
                        <!-- begin col-4 -->
                        <div class="col-md-4 col-sm-4">
                            <div class="service">
                                <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i
                                        class="fa fa-heart"></i></div>
                                <div class="info">
                                    <h4 class="title">Free Support</h4>
                                    <p class="desc">Integer consectetur, massa id mattis tincidunt, sapien erat
                                        malesuada
                                        turpis, nec vehicula lacus felis nec libero. Fusce non lorem nisl.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end col-4 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end #about -->


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
