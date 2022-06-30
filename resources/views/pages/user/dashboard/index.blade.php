@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="page-header mb-1 text-center">{{ isset($app) ? $app->nama : 'Perumahan'}}</h5>
                    <p class="text-center fw-normal m-0" style="font-size: 12px;">{{ isset($app) ? "RT {$app->rt} RW {$app->rw} KELURAHAN {$app->kelurahan->name} KECAMATAN {$app->kecamatan->name}" : 'RT RW Kelurahan Kecamatan'}}</p>
                    <p class="text-center fw-normal m-0" style="font-size: 12px;">
                        {{ isset($app) ? "{$app->kabupaten->name} PROVINSI {$app->provinsi->name}" : ' Kabupaten/Kota Provinsi'}}
                    </p>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h1 class="text-center">
                        Selamat Datang, {{ auth()->user()->name }}!
                    </h1>
                </div>


            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Informasi</strong>
                </div>
                <div class="card-body">
                    @isset($jadwal)
                    <p style="font-size: 14px;">Jadwal Ronda: {{ $jadwal->hari->nama }}</p>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
