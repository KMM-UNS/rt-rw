@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- {{ __('You are logged in!') }} --}}
                        <h1>Data {{ Auth::user()->name }}</h1>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <img src="{{ asset('/assets/img/user/user-13.jpg') }}" alt="Foto Petugas"
                                        width="200">
                                </div>
                                <div class="col">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"> </th>
                                                <th scope="col"> </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td> {{ Auth::user()->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <td>No. Telepon</td>
                                                <td>@twitter</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>@twitter</td>
                                            </tr>
                                            <tr>
                                                <td>Pos</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        {{-- <a href="{{ route('user.petugas.data-petugas.create') }}" class="btn btn-outline-info">CREATE</a> --}}
                        <a href="{{ route('user.kepala-keluarga.bayar-iuranwajib.create') }}"
                            class="btn btn-outline-info">CREATE</a>
                        {{-- @foreach ($data as $item) --}}

                        <!-- begin panel-body -->
                        {{-- <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 ">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-1 my-auto">
                                                <label for="alamat"><strong>Nama</strong></label>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" id="alamat" name="rumah_alamat"
                                                        class="form-control" autofocus data-parsley-required="true"
                                                        value="Denise Aruan">
                                                </div>
                                            </div>
                                            <div class="col-md-1 my-auto">
                                                <label for="nomor_rumah"><strong>Nomor Rumah</strong></label>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" id="nomor_rumah" name="rumah_nomor_rumah" class="form-control" autofocus data-parsley-required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-1 my-auto">
                                                <label for="status_penggunaan_id"><strong>Status Penggunaan</strong></label>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" id="nomor_rumah" name="rumah_nomor_rumah" >
                                                </div>
                                            </div>
                                            <div class="col-md-1 my-auto">
                                                <label for="status_hunian_id"><strong>Status Hunian</strong></label>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" id="nomor_rumah" name="rumah_nomor_rumah" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> --}}
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
