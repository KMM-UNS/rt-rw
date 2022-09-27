@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Suka Rela')

@push('css')
    <!-- datatables -->
    <link href="{{ asset('/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <!-- end datatables -->
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Rekap Iuran Suka Rela</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Rekap Iuran Suka Rela<small> @yield('title')</small></h1>
    <!-- end page-header -->


    <!-- begin panel -->
    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">Rekap Kas Iuran - @yield('title')</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
            </div>
        </div>

        <!-- begin panel-body -->
        <form action="{{ route('admin.rekap-kas.rekap-iuransukarela.store') }}" id="form" name="form" method="POST"
            data-parsley-validate="true" enctype="multipart/form-data">
            @csrf
            @if (isset($datas))
                {{ method_field('PUT') }}
            @endif
            <div class="panel-body">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="bulan"><strong>Jenis Iuran</strong></label>
                        </div>
                        <div class="col-md-3 ">
                            <x-form.Dropdown name="jenis_iuran_id" :options="$jenis_iuran" selected="{{{ old('jenis_iuran_id') ?? ($data['jenis_iuran_id'] ?? null) }}}" required />
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="bulan"><strong>Tanggal Awal</strong></label>
                        </div>
                        <div class="col-md-3 ">
                            <input type="date" name="tglawal" id="tglawal" class="form-control" />
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="bulan"><strong>Tanggal Akhir</strong></label>
                        </div>
                        <div class="col-md-3 ">
                            <input type="date" name="tglakhir" id="tglakhir" class="form-control" />
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

        </form>
        <!-- end panel-body -->


        <!-- mencoba -->
        {{-- <form action="/admin/rekap-kas/laporankematian" method="post">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-1 my-auto">
                        <label for="bulan"><strong>Jenis Iuran</strong></label>
                    </div>
                    <div class="col-md-3 ">
                        <x-form.Dropdown name="jenis_iuran_id" :options="$jenis_iuran" selected="{{{ old('jenis_iuran_id') ?? ($data['jenis_iuran_id'] ?? null) }}}" required />
                    </div>
                    <div class="input-group mb-3">
                        <label for="label"> Tanggal Awal</label>
                        <input type="date" name="tglawal" id="tglawal" class="form-control" />
                    </div>
                    <div class="input-group mb-3">
                        <label for="label"> Tanggal Akhir</label>
                        <input type="date" name="tglakhir" id="tglakhir" class="form-control" />
                    </div>
                    <button class="btn btn-primary btn-md float-right " type="submit" name="submit"
                        value="table">Search</button>
                </div>
            </div>
        </form> --}}

        <!-- end mencoba -->
    </div>
    <!-- end panel -->

    <!-- menoba 2 -->
    @isset($data)
        <div class="panel panel-inverse">
            <br>

            <div class="panel-body">
                <center>
                    <h4> Laporan Kematian Lansiayyy</h4>
                </center>
                <a href="/admin/data-lansia/cetaklaporankematian/{{ $startDate }}/{{ $endDate }}"
                    class="btn btn-secondary btn-sm float-right mr-4"><i class="fa fa-print fa-fw"></i> Cetak Laporan </a>
                <br>

                <div class="form-group my-5">

                    <table id="rekaps" class="table table-bordered my-5" align="center" rules="all" border="1px"
                        style="width: 95%; margin-top: 1 rem;
margin-bottom: 1 rem;">
                        <tr>
                            <th>No. </th>
                            <th>Nama Lansia </th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Tanggal Meninggal</th>
                        </tr>
                        @foreach ($data as $cetak)
                            <tr>
                                <td> banyak</td>
                                <td> banyak</td>
                                <td> banyak</td>
                                <td>banyak</td>
                                <td> banyak</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>


        </div>

    @endisset
    <!--end mencoba 2 -->

@endsection


@push('scripts')
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
    <script>
        $(document).ready(function() {
            var table = $('#rekaps').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: false,
                dom: 'Blfrtip',
            });
        });
    </script>
@endpush
