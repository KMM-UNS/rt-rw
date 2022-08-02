@php
$sidebarClass = !empty($sidebarTransparent) ? 'sidebar-transparent' : '';
@endphp
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar {{ $sidebarClass }}">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        @if (!$sidebarSearch)
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <a href="javascript:;" data-toggle="nav-profile">
                        <div class="cover with-shadow"></div>
                        <div class="image">
                            <img src="/assets/img/user/user-13.jpg" alt="" />
                        </div>
                        <div class="info">
                            <b class="caret pull-right"></b>
                            {{ Auth::user()->name }}
                            <small>Petugas Penertima Iuran</small>
                        </div>
                    </a>
                </li>
                <li>
                    <ul class="nav nav-profile">
                        <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                        <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end sidebar user -->
        @endif
        <!-- begin sidebar nav -->
        <ul class="nav">
            @if ($sidebarSearch)
                <li class="nav-search">
                    <input type="text" class="form-control" placeholder="Sidebar menu filter..."
                        data-sidebar-search="true" />
                </li>
            @endif
            <li class="nav-header">Navigation</li>
            <!-- begin #sidebar -->
            <!-- terbaru -->
            <div id="sidebar" class="sidebar" data-disable-slide-animation="true">
                <!-- begin sidebar scrollbar -->
                <div data-scrollbar="true" data-height="100%">
                    <!-- begin sidebar user -->
                    <ul class="nav">
                        <li class="nav-profile">
                            <a href="javascript:;" data-toggle="nav-profile">
                                <div class="cover with-shadow"></div>
                                <div class="image">
                                    {{-- <img src="../assets/img/user/user-14.jpg" alt="" /> --}}
                                </div>
                                <div class="info">
                                    <b class="caret pull-right"></b>
                                    {{ Auth::user()->name }}

                                </div>
                            </a>
                        </li>
                        <li>
                            <ul class="nav nav-profile">
                                <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                                <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                                <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end sidebar user -->
                    <!-- begin sidebar nav -->
                    <ul class="nav">
                        <li class="nav-header">Navigation</li>

                        <li class="">
                            <a href="{{ url('/') }}">
                                <i class="fa fa-th-large"></i>
                                <span>Kembali ke Home</span>
                            </a>
                        </li>
                        @if (auth()->check() && auth()->user()->role->nama === 'Warga')
                            <li class="">
                                <a href="{{ route('user.warga.data-diri.index') }}">
                                    <i class="fa fa-id-card"></i>
                                    <span>Data Diri</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="nav-link" href="{{ route('user.warga.wargak.index') }}">
                                    <i class="fa fa-id-card"></i>
                                    <span>Notifikasi Status Pembayaran Iuran</span>

                                </a>
                            </li>
                        @endif

                        @if (auth()->check() && auth()->user()->role->nama === 'Warga')
                            {{-- <li class="has-sub">
                                <a href="javascript:;">
                                    <b class="caret"></b>
                                    <i class="fa fa-list-ol"></i>
                                    <span>Dashboard Warga</span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="index.html">Data Diri Warga</a></li>
                                    <li><a href="index_v2.html">Status Pembayaran</a></li>
                                </ul>
                            </li> --}}
                        @endif

                        @if (auth()->check() && auth()->user()->role->nama === 'Petugas')
                            <li class="">
                                <a href="{{ route('user.kepala-keluarga.warga.index') }}">
                                    <i class="fa fa-th-large"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('user.petugas-iuran.data-petugas.index') }}">
                                    <i class="fa fa-id-card"></i>
                                    <span>Data Dirii</span>
                                </a>
                            </li>
                            <li class="has-sub">
                                <a href="javascript:;">
                                    <b class="caret"></b>
                                    <i class="fa fa-list-ol"></i>
                                    <span>Pembayaran Iuran</span>

                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('user.kepala-keluarga.bayar-iuranwajib.index') }}">Data
                                            Pembayaran Iuran Wajib</a></li>
                                    <li><a href="{{ route('user.kepala-keluarga.bayar-iuransukarela.index') }}">Data
                                            Pembayaran Iuran Suka Rela</a></li>
                                    <li><a href="{{ route('user.kepala-keluarga.bayar-iurankondisional.index') }}">Data
                                            Pembayaran Iuran Kondisional</a></li>
                                    <li><a href="{{ route('user.kepala-keluarga.bayar-iuranagenda.index') }}">Data
                                            Pembayaran Iuran Suka Agenda</a></li>
                                </ul>
                            </li>



                            <li class="has-sub">
                                <a href="javascript:;">
                                    <b class="caret"></b>
                                    <i class="fa fa-list-ol"></i>
                                    <span>Input Pembayaran</span>

                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('user.kas-rt.kas-iuranwajib.index') }}">Pembayaran
                                            Iuran Wajib</a></li>
                                    <li><a href="{{ route('user.kas-rt.kas-iuransukarela.index') }}">Pembayaran
                                            Iuran Suka Rela</a></li>
                                    <li><a href="{{ route('user.kas-rt.kas-iurankondisional.index') }}">Pembayaran
                                            Iuran Kondisional</a></li>
                                    <li><a href="{{ route('user.kas-rt.kas-iuranagenda.index') }}">Pembayaran
                                            Iuran Suka Agenda</a></li>
                                </ul>
                            </li>
                        @endif
                        <!-- begin sidebar minify button -->
                        <li>
                            <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
                                <i class="fa fa-angle-double-left"></i>
                            </a>
                        </li>
                        <!-- end sidebar minify button -->
                    </ul>
                    <!-- end sidebar nav -->
                </div>
                <!-- end sidebar scrollbar -->
            </div>
            <div class="sidebar-bg"></div>
            <!-- end #sidebar -->

            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
