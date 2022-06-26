@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('Data Pembayaran') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Data Warga!') }}
                        {{-- <h1>Data Warga</h1> --}}

                        <table border="1" cellpadding="2" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No KK</th>
                                    <th scope="col">Kepala Keluarga</th>
                                    <th scope="col">Status</th>
                                    {{-- <th scope="col">Pos Tagihan</th>
                                    <th scope="col">Telp</th>
                                    <th scope="col">Status</th> --}}

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($warga as $item)
                                    <tr>
                                        <td>{{ $item->no_kk }}</td>
                                        <td>{{ $item->pemberi }}</td>
                                        <td>
                                            <label for=""
                                                class="label {{ $item->status == 1 ? 'label-success' : 'label-danger center' }}">{{ $item->status == 1 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                            {{-- @if ($warga->status == 0)
                                                <a href="#" class="text-success">Success link</a>
                                            @else
                                                <p><a href="#" class="text-danger">Danger link</a></p>
                                            @endif --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
