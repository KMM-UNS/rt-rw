<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>RT-RW  @yield('title')</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{ asset('vendor/bootstrap3/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('vendor/animate/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/one-page-parallax/style.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/one-page-parallax/style-responsive.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/one-page-parallax/theme/default.css') }}" id="theme" rel="stylesheet" />
    {{-- <link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" /> --}}

	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('vendor/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->

    <style>
        * {
            font-size: 16px;
        }
    </style>
</head>
<body data-spy="scroll" data-target="#header-navbar" data-offset="51">
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container -->
            <div class="container">
                <!-- begin navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.html" class="navbar-brand">
                        <span class="brand-logo"></span>
                        <span class="brand-text">
                            <span class="text-theme">RT-RW</span> Makmur
                        </span>
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active dropdown">
                            <a href="#home" data-click="scroll-to-target" data-toggle="dropdown">Beranda</a>
                        </li>
                        <li><a href='{{ route('user.') }}' class="scrollto">
                            @if (Auth::check())
                            Dashboard
                            @else
                            Login
                            @endif
                          </a></li>
                    </ul>
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #header -->

        <!-- begin #home -->
        <div id="home" class="content has-bg home">
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="{{ asset('assets/img/cover.jpg') }}" class="w-100 px-auto" alt="Home" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container home-content">
                <h1>Selamat Datang</h1>
                <h3 class="mb-1">{{ isset($app) ? strtoupper($app->nama) : "Perumahan"  }}</h3>
                <p class="text-center fw-normal" style="font-size: 16px;">{{ isset($app) ? "RT {$app->rt} RW {$app->rw}, KELURAHAN {$app->kelurahan->name}, KECAMATAN {$app->kecamatan->name}, {$app->kabupaten->name}, PROVINSI {$app->provinsi->name}" : 'RT RW Kelurahan Kecamatan Kabupaten/Kota Provinsi'}}</p>
            </div>
            <!-- end container -->
        </div>
        <!-- end #home -->

        <!-- begin #about -->
        <div id="about" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <h2 class="content-title">Statistik</h2>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3 milestone-col">
                        <div class="milestone">
                            <div class="number" style="color:black;"  data-animation-type="number" data-final-number="{{ isset($warga) ? $warga : 0 }}">{{ isset($warga) ? $warga : 0 }}</div>
                            <div class="title">Warga</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3 milestone-col">
                        <div class="milestone">
                            <div class="number" style="color:black;"  data-animation-type="number" data-final-number="{{ isset($keluarga) ? $keluarga : 0 }}">{{ isset($keluarga) ? $keluarga : 0 }}</div>
                            <div class="title">Keluarga</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3 milestone-col">
                        <div class="milestone">
                            <div class="number" style="color:black;"  data-animation-type="number" data-final-number="{{ isset($rumah) ? $rumah : 0 }}">{{ isset($rumah) ? $rumah : 0 }}</div>
                            <div class="title">Rumah</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3 milestone-col">
                        <div class="milestone">
                            <div class="number" style="color:black;"  data-animation-type="number" data-final-number="{{ isset($surat) ? $surat : 0 }}">{{ isset($surat) ? $surat : 0 }}</div>
                            <div class="title">Surat yang dikeluarkan</div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #about -->

        <div id="contact" class="content bg-black-darker has-bg" data-scrollview="true">
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInLeft">
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-12 -->
                    <div class="col-md-6 contact">
                        <div class="div-title">
                            <h2>Kontak Kami</h2>
                        </div>

                        <div class="row mt-1 d-flex justify-content-start" data-aos="fade-right" data-aos-delay="100">

                            <div class="col-lg">
                              <div class="info">
                                <div class="address">
                                  <i class="bi bi-geo-alt"></i>
                                  <h4>Alamat:</h4>
                                  <p>{{ isset($app) ? "RT {$app->rt} RW {$app->rw}, KELURAHAN {$app->kelurahan->name}, KECAMATAN {$app->kecamatan->name}, {$app->kabupaten->name} PROVINSI {$app->provinsi->name}" : 'RT RW Kelurahan Kecamatan Kabupaten/Kota Provinsi'}}</p>
                                </div>

                                <div class="email">
                                  <i class="bi bi-envelope"></i>
                                  <h4>Email:</h4>
                                  <p>{{ isset($app) ? $app->email : 'mail@mail.com' }}</p>
                                </div>

                                <div class="phone">
                                  <i class="bi bi-phone"></i>
                                  <h4>Telefon :</h4>
                                  <p>{{ isset($app) ? $app->telepon : '08192829281' }}</p>
                                </div>

                              </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 quote">
                       <div class="card">
                        <div class="card-title">
                            <h2>Kritik/Saran</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('beranda.store') }}" method="POST" style="font-size: 16px">
                                @csrf
                                <input type="text" id="tanggal" name="nama" class="form-control my-5" style="margin: 2rem 0 2rem 0; font-size: 14px;" autofocus data-parsley-required="true" value="{{{ old('nama') ??  null }}}" placeholder="Nama">
                                <textarea class="form-control my-5" style="margin: 2rem 0 2rem 0; resize: none;font-size: 14px;" name="saran" id="saran" cols="30" rows="5" placeholder="Kritik/Saran"></textarea>
                                <div class="mt-2 mb-2" style="float: right;">
                                    <button class="btn btn-success btn-sm" type="submit">Kirim</button>
                                </div>
                            </form>
                        </div>
                       </div>
                    </div>
                    <!-- end col-12 -->
                </div>
            </div>
                <!-- end row -->
        </div>
            <!-- end container -->
        <!-- end #quote -->

    </div>
    <!-- end #page-container -->
<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap3/js/bootstrap.min.js') }}"></script>
<!--[if lt IE 9]>
    <script src="assets/crossbrowserjs/html5shiv.js"></script>
    <script src="assets/crossbrowserjs/respond.min.js"></script>
    <script src="assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="{{ asset('vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('vendor/scrollMonitor/scrollMonitor.js') }}"></script>
<script src="{{ asset('assets/js/one-page-parallax/apps.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
