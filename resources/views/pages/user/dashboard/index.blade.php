@extends('layouts.user')

@section('content')
<div class="container" style="font-size:14px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (auth()->user()->email_verified_at == null)
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success text-center">
                    <strong>
                        Email verifikasi terkirim.
                    </strong>
                </div>
            @endif
            <div class="alert alert-danger fade show text-center" style="font-size:13px">
                <div class="text-center">
                    <h3>Verifikasi E-mail</h3>
                    <p>Silakan cek email Anda atau klik tombol di bawah jika belum mendapatkan email verifikasi.</p>
                </div>
                <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                    @csrf
                    <button type="submit" class="btn btn-dark font-weight-normal" style="font-size:13px">Kirim ulang email verifikasi</button>
                </form>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="page-header mb-1 text-center">{{ isset($app) ? $app->nama : 'Perumahan'}}</h5>
                    <p class="text-center fw-normal m-0" style="font-size: 14px;">{{ isset($app) ? "RT {$app->rt} RW {$app->rw} KELURAHAN {$app->kelurahan->name} KECAMATAN {$app->kecamatan->name}" : 'RT RW Kelurahan Kecamatan'}}</p>
                    <p class="text-center fw-normal m-0" style="font-size: 14px;">
                        {{ isset($app) ? "{$app->kabupaten->name} PROVINSI {$app->provinsi->name}" : ' Kabupaten/Kota Provinsi'}}
                    </p>
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif --}}

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
