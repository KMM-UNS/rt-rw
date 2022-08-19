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
                                <th scope="col">Iuran Sosial</th>
                                <th scope="col">Iuran Kebersihan</th>
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
                                $status1 = $item->warga_wajib->where('jenis_iuran_id', 7);
                                $status2 = $item->warga_wajib->where('jenis_iuran_id', 8);
                                @endphp

                                <td>
                                    @foreach ($status1 as $i)
                                    <p>{{ $i->tanggal }}</p>
                                    @endforeach
                                    <label for="" class="label {{ count($status1) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status1) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                </td>
                                <td>
                                    @foreach ($status2 as $j)
                                    <p>{{ $j->tanggal }}</p>
                                    @endforeach
                                    <label for="" class="label {{ count($status2) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status2) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                </td>



                            </tr>
                            @endforeach
                            <td colspan="cols-3"> <b>Cetak</b> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="cols-1">
                                @if (count($status1) == 1)
                                <a href="{{ route('user.kepala-keluarga.cetak_sosial') }}" class="btn btn-primary" target="_blank">CETAK
                                    PDF</a>
                                @else
                                <a href="#" class="btn btn-primary disabled" target="_blank">CETAK
                                    PDF</a>
                                @endif
                            </td>
                            <td colspan="cols-2">
                                @if (count($status2) == 1)
                                <a href="{{ route('user.kepala-keluarga.cetak_kebersihan') }}" class="btn btn-primary" target="_blank">CETAK
                                    PDF</a>
                                @else
                                <a href="#" class="btn btn-primary disabled" target="_blank">CETAK
                                    PDF</a>
                                @endif
                            </td>
                        </tbody>
                    </table>

                    {{-- @if (count($status1) == 1 && count($status2 == 1)) --}}
                    {{-- @if (count($status1) == 1)
                            <a href="#" class="btn btn-primary" target="_blank">CETAK
                                PDF</a>
                        @else
                            <a href="#" class="btn btn-primary disabled" target="_blank">CETAK
                                PDF</a>
                        @endif --}}
                    {{-- @endif --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush