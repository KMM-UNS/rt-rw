@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Agama')

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
        <li class="breadcrumb-item"><a href="javascript:;">Master Data</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Master Data<small> @yield('title')</small></h1>
    <!-- end page-header -->


    <!-- begin panel -->
    <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">DataTable - @yield('title')</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <form action="{{ route('admin.kas-rt.iuran-bulanan.store') }}" id="form" name="form" method="POST" data-parsley-validate="true"  enctype="multipart/form-data">
            @csrf
            @if(isset($data))
            {{ method_field('PUT') }}
            @endif
        <div class="panel-body">
            <h1>haiii</h1>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-1 my-auto">
                        <label for="bulan"><strong>Iuran Bulanan</strong></label>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <x-form.Dropdown name="bulan" :options="$nama_bulans" selected="{{{ old('bulan') ?? ($data['bulan'] ?? null) }}}" required />
                        </div>
                    </div>
                    <div class="col-md-1 my-auto">
                        <label for="status_hunian_id"><strong>Tahun</strong></label>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <x-form.Dropdown name="tahun" :options="$tahuns" selected="{{{ old('tahun') ?? ($data['tahun'] ?? null) }}}" required />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary center">Submit</button>
            </div>
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
    $( document ).ready(function() {
        $("#from-datepicker").datepicker({
            format: 'yyyy-mm-dd'
        });
        $("#from-datepicker").on("change", function () {
            var fromdate = $(this).val();
            alert(fromdate);
        });
    });
    </script>
@endpush

