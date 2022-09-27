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

                        {{-- {{ __('Data Warga!') }} --}}
                        {{-- <h1>Data Warga</h1> --}}

                        <table border="1" cellpadding="2" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No KK</th>
                                    <th scope="col">Kepala Keluarga</th>
                                    <th scope="col">Pos Tagihan</th>
                                    <th scope="col">Telp</th>
                                    @foreach ($iuran_wajib as $itemm)
                                        <th>{{ $itemm->nama }}</th>
                                    @endforeach

                                    {{-- <th scope="col">Tanda</th> --}}

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($wargaa as $item)
                                    <tr>
                                        <td>{{ $item->no_kk }}</td>
                                        <td>{{ $item->warga }}</td>
                                        <td>{{ $item->pos->nama }}</td>
                                        <td>{{ $item->telp }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <a
                                                    href="{{ route('user.kepala-keluarga.bayar-iuranwajib.status', $item->id) }}">
                                                    <button class="btn btn-danger">Belum Bayar</button></a>
                                            @else
                                                <a
                                                    href="{{ route('user.kepala-keluarga.bayar-iuranwajib.status', $item->id) }}">
                                                    <button class="btn btn-success">Sudah Bayar</button></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                                <a
                                                    href="{{ route('user.kepala-keluarga.bayar-iuranwajib.status', $item->id) }}">
                                                    <button class="btn btn-danger">Belum Bayar</button></a>
                                            @else
                                                <a
                                                    href="{{ route('user.kepala-keluarga.bayar-iuranwajib.status', $item->id) }}">
                                                    <button class="btn btn-success">Sudah Bayar</button></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                                <a
                                                    href="{{ route('user.kepala-keluarga.bayar-iuranwajib.status', $item->id) }}">
                                                    <button class="btn btn-danger">Belum Bayar</button></a>
                                            @else
                                                <a
                                                    href="{{ route('user.kepala-keluarga.bayar-iuranwajib.status', $item->id) }}">
                                                    <button class="btn btn-success">Sudah Bayar</button></a>
                                            @endif
                                        </td>
                                        {{-- <td><label for=""
                                                class="label {{ $item->status == 1 ? 'label-success' : 'label-danger' }}">{{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</label>
                                        </td> --}}
                                        {{-- <td>
                                            <input data-id="{{ $item->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Sudah Bayar" data-off="Belum Bayar"
                                                {{ $item->status ? 'checked' : '' }}>
                                        </td> --}}
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
    {{-- <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "admin/manajemen-keuangan/manajemen-pengeluaran/changeMemberStatus",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        });
    </script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush
