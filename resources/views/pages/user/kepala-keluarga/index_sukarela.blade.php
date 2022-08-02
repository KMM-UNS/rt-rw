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

                        <table border="1" cellpadding="2" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No KK</th>
                                    <th scope="col">Kepala Keluarga</th>
                                    <th scope="col">Pos Tagihan</th>
                                    <th scope="col">Telp</th>
                                    <th scope="col">Iuran Pendidikan</th>
                                    <th scope="col">Iuran Arian</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($wargaa as $item)
                                    <tr>
                                        <td>{{ $item->no_kk }}</td>
                                        <td>{{ $item->warga }}</td>
                                        <td>{{ $item->pos->nama }}</td>
                                        <td>{{ $item->telp }}</td>
                                        @php
                                            $status1 = $item->warga_sukarela->where('jenis_iuran_id', 1);
                                            $status2 = $item->warga_sukarela->where('jenis_iuran_id', 2);
                                        @endphp
                                        <td>
                                            <label for=""
                                                class="label {{ count($status1) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status1) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                        <td>
                                            <label for=""
                                                class="label {{ count($status2) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status2) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
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

@push('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush
