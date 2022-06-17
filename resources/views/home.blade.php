@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                        <h1>Data Warga</h1>
                        {{-- <table border="1" cellpadding="2" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No KK</th>
                                    <th scope="col">Kepala Keluarga</th>
                                    <th scope="col">Pos Tagihan</th>
                                    <th scope="col">Telp</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->no_kk }}</td>
                                        <td>{{ $item->kepala_keluara }}</td>
                                        <td>{{ $item->pos_tagihan }}</td>
                                        <td>{{ $item->telp }}</td>
                                    </tr>
                                @endforeach

                            </tbody>



                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
