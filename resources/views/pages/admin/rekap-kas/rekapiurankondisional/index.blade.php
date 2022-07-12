@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Kondisional')

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
        <li class="breadcrumb-item"><a href="javascript:;">Rekap Iuran Kondisional</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Rekap Iuran Kondisional<small> @yield('title')</small></h1>
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
        <form action="{{ route('admin.rekap-kas.rekap-iurankondisional.store') }}" id="form" name="form" method="POST"
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
    </div>
    <!-- end panel -->

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
@endpush
