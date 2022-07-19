<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
</head>
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


<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- begin panel -->
                    {{-- <form
                        action="{{ isset($data) ? route('admin.kas-rt.kas-petugas.update', $data->id) : route('admin.kas-rt.kas-iuranwajib.store') }}"
                        id="form" name="form" method="POST" data-parsley-validate="true"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($data))
                            {{ method_field('PUT') }}
                        @endif --}}

                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Notifikasi Pembayaran INI @yield('title')</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">

                            <h1>Iuran Wajibbb </h1>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $status1 = $data1->where('jenis_iuran_id', 7);
                                        $status2 = $data1->where('jenis_iuran_id', 8);
                                    @endphp

                                    <tr>
                                        <td>Iuran Sosisal</td>
                                        <td>
                                            <label for=""
                                                class="label {{ count($status1) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status1) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Iuran Kebersihan</td>
                                        <td>
                                            <label for=""
                                                class="label {{ count($status2) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status2) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h1>Iuran Sukarela</h1>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $status3 = $data2->where('jenis_iuran_id', 1);
                                        $status4 = $data2->where('jenis_iuran_id', 2);
                                    @endphp
                                    <tr>
                                        <td>Iuran Pendidikan</td>
                                        <td><label for=""
                                                class="label {{ count($status3) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status3) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Arisan</td>
                                        <td><label for=""
                                                class="label {{ count($status4) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status4) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h1>Iuran Kondisional</h1>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $status5 = $data3->where('jenis_iuran_id', 1);
                                    @endphp
                                    <tr>
                                        <td>Denda Ronda </td>
                                        <td><label for=""
                                                class="label {{ count($status5) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status5) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h1>Iuran Agenda</h1>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $status6 = $data4->where('jenis_iuran_id', 1);
                                        $status7 = $data4->where('jenis_iuran_id', 2);
                                    @endphp
                                    <tr>
                                        <td>Peringatan HUT RI</td>
                                        <td><label for=""
                                                class="label {{ count($status6) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status6) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Halal Bi Halal</td>
                                        <td><label for=""
                                                class="label {{ count($status7) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status7) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                        <!-- end panel-body -->
                        <!-- begin panel-footer -->

                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
        <script src="{{ asset('/assets/js/custom/string-helper.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#from-datepicker").datepicker({
                    format: 'yyyy-mm-dd'
                });
                $("#from-datepicker").on("change", function() {
                    var fromdate = $(this).val();
                    alert(fromdate);
                });
            });
        </script>


</body>

</html>
