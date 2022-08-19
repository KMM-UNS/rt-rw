@extends('layouts.user')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    </head>

    <body>
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
                            <table class="table table-bordered">
                                <thead class="alert-info">
                                    <tr>
                                        <th scope="col">No KK</th>
                                        <th scope="col">Nama Warga</th>
                                        <th scope="col">Pos</th>
                                        <th scope="col">Nomor Warga</th>
                                        <th scope="col">Denda Ronda</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($warga as $item)
                                        <tr>
                                            <td>{{ $item->no_kk }}</td>
                                            <td>{{ $item->warga }}</td>
                                            <td>{{ $item->pos->nama }}</td>
                                            <td>{{ $item->telp }}</td>
                                            @php
                                                $status1 = $item->warga_kondisional->where('jenis_iuran_id', 1);
                                                $status2 = $item->warga_kondisional->where('jenis_iuran_id', 2);
                                            @endphp
                                            <td>
                                                @foreach ($item->warga_kondisional->where('jenis_iuran_id', 1) as $i)
                                                    <p>{{ date('d M Y', strtotime($i->tanggal)) }}</p>
                                                @endforeach

                                                <label for=""
                                                    class="label {{ count($status1) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status1) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                            </td>
                                            {{-- <td>
                                                @foreach ($item->warga_kondisional->where('jenis_iuran_id', 8) as $j)
                                                    <p>{{ date('d M Y', strtotime($j->tanggal)) }}</p>
                                    @endforeach
                                    <label for="" class="label {{ count($status2) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status2) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>

                                    </td> --}}
                                        </tr>
                                    @endforeach
                                    <td colspan="cols-3"> <b>Cetak</b> </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @php
                                        $status3 = $wargaa->where('jenis_iuran_id', 7);
                                        $status4 = $wargaa->where('jenis_iuran_id', 8);
                                    @endphp
                                    <td colspan="cols-1">
                                        {{-- {{ count($warga) }}
                                    {{ count($status3) }} --}}
                                        @if (count($warga) == count($status3))
                                            <a href="{{ route('user.kepala-keluarga.cetak_sosial', [$bulan, $tahun]) }}"
                                                class="btn btn-primary" target="_blank">CETAK
                                                PDF</a>
                                        @else
                                            <a href="#" class="btn btn-primary disabled" target="_blank">CETAK
                                                PDF</a>
                                        @endif
                                    </td>
                                    {{-- <td colspan="cols-1">
                                    @if (count($warga) == count($status4))
                                    <a href="{{ route('user.kepala-keluarga.cetak_kebersihan', [$bulan, $tahun]) }}" class="btn btn-primary" target="_blank">CETAK
                                        PDF</a>
                                    @else
                                    <a href="#" class="btn btn-primary disabled" target="_blank">CETAK
                                        PDF</a>
                                    @endif
                                </td> --}}
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection

@push('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush
