<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Manajemen Keuangan RT/RW</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="#page-top">Manajemen Keuangan RT/RW</a>
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                    @if (auth()->check() && auth()->user()->role->nama === 'Petugas')
                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('user.kepala-keluarga.warga.index') }}">Data
                                Pembayaran</a></li>
                    @endif

                    @if (auth()->check() && auth()->user()->role->nama === 'Warga')
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.warga.wargak.index') }}">Data
                                Pembayaran</a></li>
                    @endif

                    @if (Auth::check())
                        <li class="nav-item"><a class="nav-link" href="">
                                <form action="{{ request()->is('admin*') ? route('admin.logout') : route('logout') }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="nav-item">Log Out</button>
                                </form>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Login
                            </a>
                            <ul class="dropdown-menu navbar-dark bg-dark" aria-labelledby="navbarDropdownMenuLink">
                                <li class="nav-item"><a class="nav-link" href='{{ route('login') }}'>Login User</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href='{{ route('admin.login') }}'>Login
                                        Admin</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><i
                                class="fa fa-cog"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"> Visi dan Misi</h2>
                <h3 class="section-subheading text-muted">RT 02 RW 01 Jebres, Surakarta</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-6">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Visi</h4>
                    <p class="text-muted">VISI adalah gambaran masa depan yang diinginkan oleh Pengurus RT-01 RW-01
                        (sebagai
                        pelayan warga) yang memberikan inspirasi yang cukup jelas bagi Pengurus RT-01 RW-01 dalam
                        melaksanakan
                        Amanah & Tanggungjawabnya.
                        Dengan Visi ini diharapkan Pengurus RT-01 RW-01 Kelurahan Jebres bersama dengan Pengurus RT
                        semakin
                        sadar akan pentingnya Kebersamaan yang Bertanggungjawab Melayani Warga sehingga memiliki sikap,
                        anggapan dan pandangan/persepsi yang sama terhadap langkah yang dilakukan oleh Pengurus RT-01
                        RW-01 di
                        dalam memajukan warga.</p>
                </div>
                <div class="col-md-6">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Misi</h4>
                    <p class="text-muted">MISI yang dimaksud disini adalah dorongan/motivasi untuk melaksanakan niat dan
                        tugas yang harus diemban oleh segenap Pengurus RW-03 dan peran serta warga dalam mencapai VISI
                        tersebut di atas.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Team-->
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Struktur Organisasi</h2>
                <h3 class="section-subheading text-muted">Pengurus Inti RT-01 RW-01</h3>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/businessman.png" alt="..." />
                        <h4>Asep Agus Surmanto</h4>
                        <p class="text-muted">Ketua RT</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/boss.png" alt="..." />
                        <h4>Suryono Trita</h4>
                        <p class="text-muted">Ketua RW</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/woman.png" alt="..." />
                        <h4>Ayu Sularasti</h4>
                        <p class="text-muted">Bendahara</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="large text-muted">VISI dan MISI, serta Program Kerja yang akan dijalankan merupakan kerja
                        bersama oleh Pengurus RW-03 dalam Struktur Organisasi yang Efektif, Pengurus RT dan Partisipasi
                        aktif seluruh warga, serta bersinergi menjalin kemitraan dengan Lembaga / Institusi internal
                        yang ada di lingkungan RT-01 RW-01</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients-->

    <!-- Contact-->

    <!-- Footer-->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
