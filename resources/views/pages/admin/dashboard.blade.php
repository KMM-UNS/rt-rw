@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])
@section('title', 'Dashboard')

@push('css')
<link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
@endpush

@section('content')
<h1 class="page-header mb-1 text-center">{{ isset($app) ? $app->nama : 'Perumahan'}}</h1>
<p class="text-center fw-normal m-0" style="font-size: 16px;">{{ isset($app) ? "RT {$app->rt} RW {$app->rw} Kelurahan {$app->kelurahan} Kecamatan {$app->kecamatan}" : 'RT RW Kelurahan Kecamatan'}}</p>
<p class="text-center fw-normal m-0" style="font-size: 16px;">
    {{ isset($app) ? "Kabupaten/Kota {$app->kabupaten} Provinsi {$app->provinsi}" : ' Kabupaten/Kota Provinsi'}}
</p>

<div class="row mt-3">
    <div class="col-xl-8">
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-title mt-3 mb-1 text-center">
                <h4>Jadwal Ronda</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered w-100">
                    <tr>
                        <th class="text-center">Minggu</th>
                        @foreach ($minggu as $jadwal)
                        <td>
                            {{ $jadwal->warga->nama }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-center">Senin</th>
                        @foreach ($senin as $jadwal)
                        <td>
                            {{ $jadwal->warga->nama }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-center">Selasa</th>
                        @foreach ($selasa as $jadwal)
                        <td>
                            {{ $jadwal->warga->nama }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-center">Rabu</th>
                        @foreach ($rabu as $jadwal)
                        <td>
                            {{ $jadwal->warga->nama }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-center">Kamis</th>
                        @foreach ($kamis as $jadwal)
                        <td>
                            {{ $jadwal->warga->nama }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-center">Jumat</th>
                        @foreach ($jumat as $jadwal)
                        <td>
                            {{ $jadwal->warga->nama }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        <th class="text-center">Sabtu</th>
                        @foreach ($sabtu as $jadwal)
                        <td>
                            {{ $jadwal->warga->nama }}
                        </td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-title mt-3 mb-1 text-center">
                <h4>Statistik Pengajuan Surat</h4>
            </div>
            <div class="card-body">
                {!! $suratChart->container() !!}
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-title mt-3 mb-1 text-center">
                <h4>Grafik Jenis Kelamin Warga</h4>
            </div>
            <div class="card-body">
                {!! $genderChart->container() !!}
            </div>
        </div>
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-title mt-3 mb-1 text-center">
                <h4>Grafik Pendidikan Warga</h4>
            </div>
            <div class="card-body">
                {!! $pendidikanChart->container() !!}
            </div>
        </div>
        <div class="card border-0 bg-white mb-3 overflow-hidden">
            <div class="card-title mt-3 mb-1 text-center">
                <h4>Grafik Pekerjaan Warga</h4>
            </div>
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

<!-- suratChart script -->
<script src="{{ $suratChart->cdn() }}"></script>
{{ $suratChart->script() }}

<script src="/assets/plugins/d3/d3.min.js"></script>
<script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="/assets/plugins/moment/moment.js"></script>
<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/demo/dashboard-v3.js"></script>
@endpush
