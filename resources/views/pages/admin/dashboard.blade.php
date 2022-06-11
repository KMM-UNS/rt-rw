@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])
@section('title', 'Dashboard')

@push('css')
<link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
@endpush

@section('content')
<h1 class="page-header mb-3 text-center">Statistik Warga</h1>

<div class="row">
    <div class="col-xl-8">
        <div class="card border-0 bg-white text-white mb-3 overflow-hidden">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-body">
                {!! $genderChart->container() !!}
            </div>
        </div>
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-body">
                {!! $pendidikanChart->container() !!}
            </div>
        </div>
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-body">
                {!! $pekerjaanChart->container() !!}
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')

<!-- genderChart script -->
<script src="{{ $genderChart->cdn() }}"></script>
{{ $genderChart->script() }}

<!-- pendidikanChart script -->
<script src="{{ $pendidikanChart->cdn() }}"></script>
{{ $pendidikanChart->script() }}

<!-- pekerjaanChart script -->
<script src="{{ $pekerjaanChart->cdn() }}"></script>
{{ $pekerjaanChart->script() }}

<script src="/assets/plugins/d3/d3.min.js"></script>
<script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="/assets/plugins/moment/moment.js"></script>
<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/demo/dashboard-v3.js"></script>
@endpush
