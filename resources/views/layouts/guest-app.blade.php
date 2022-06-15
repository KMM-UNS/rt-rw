<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIPMB UNSA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href={{ asset('/assets/img/logo/logo.png') }} rel="icon">
  <link href={{ asset('assets/img/apple-touch-icon.png') }} rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link type="text/css" href={{ asset('vendor/animate.css/animate.min.css') }} rel="stylesheet">
  <link type="text/css" href={{ asset('vendor/aos/aos.css') }} rel="stylesheet">
  <link type="text/css" href={{ asset('vendor/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
  <link type="text/css" href={{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet">
  <link type="text/css" href={{ asset('vendor/boxicons/css/boxicons.min.css') }} rel="stylesheet">
  <link type="text/css" href={{ asset('vendor/glightbox/css/glightbox.min.css') }} rel="stylesheet">
  <link type="text/css" href={{ asset('vendor/remixicon/remixicon.css') }} rel="stylesheet">
  <link type="text/css" href={{ asset('vendor/swiper/swiper-bundle.min.css') }} rel="stylesheet">


  <!-- Template Main CSS File -->
  <link type="text/css" href={{ asset('assets/css/guest-style.css') }} rel="stylesheet">

</head>

<body>
   <!-- ======= Top Bar ======= -->
   <div id="topbar" class="fixed-top d-flex align-items-center topbar-inner-pages">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        {{-- @if($home->count() != 0)
        <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">{{ $home->last()->email }}</a>
        <i class="bi bi-phone-fill phone-icon"></i> {{ $home->last()->telp }}
        @endif --}}
      </div>


      <div class="cta d-none d-md-block">
        {{-- <a href='{{ route('user.dashboard') }}' class="scrollto"> --}}
          @if (Auth::check())
          Dashboard
          @else
          Login
          @endif
        </a>
      </div>


    </div>
  </div>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center  header-inner-pages ">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="https://unsa.ac.id">UNSA</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href=index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          {{-- <li class=""><a class="nav-link scrollto {{ (request()->is('home')) ? 'active' : '' }}" href='{{ route('home') }}'>Home</a></li> --}}
          {{-- <li class="dropdown"><a class="{{ (request()->is('jurusan','berita')) ? 'active' : '' }}" href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a> --}}
            <ul>
              {{-- <li class=""><a href='{{ route('jurusan') }}'>Fakultas dan Jurusan</a></li> --}}
              {{-- <li class=""><a href='{{ route('berita') }}'>Berita</a></li> --}}
            </ul>
          {{-- <li class=""><a class="nav-link scrollto {{ (request()->is('info-daftar')) ? 'active' : '' }}" href='{{ route('info-daftar') }}'>Pendaftaran</a></li> --}}
          <li class="dropdown"><a href="#"><span>Link Terkait</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="https://unsa.ac.id/">Website Univeritas Surakarta</a></li>
            </ul>

          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  @yield('content')

   <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              {{-- <li><i class="bx bx-chevron-right"></i> <a href='{{ route('home') }}'>Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href='{{ route('berita') }}'>Informasi Berita</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href='{{ route('jurusan') }}'>Informasi Jurusan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('info-daftar') }}">Pendaftaran</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://unsa.ac.id/">Website Universitas Surakarta</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('user.dashboard') }}">Login</a></li> --}}
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-contact">
            <h4>Kontak Kami</h4>
            <p>
              {{-- @if ($home->count() !=0)
              {{ $home->last()->alamat }} <br><br>
              <strong>Phone:</strong> {{ $home->last()->telp }}<br>
              <strong>Email:</strong> {{ $home->last()->email }}<br>
              @endif
            </p> --}}

          </div>

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>Pertanyaan</h3>
            <p>Pertanyaan atau Informasi lebih lanjut silahkan menghubungi Bagian Informasi Pendaftaran Mahasiswa Baru What's Apps (WA) Panitia PMB UNSA 082311571998</p>
            <div class="social-links mt-3">
              <a href="https://www.facebook.com/humasunsaofficial/" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="https://www.instagram.com/unsaofficial/" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="https://www.youtube.com/channel/UCKFzwp_Rx1fVipIsiCzfUfA" class="youtube"><i class="bx bxl-youtube"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="">CMS</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('layouts.guest-script')

</body>

</html>
