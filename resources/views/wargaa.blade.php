@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- begin panel -->

                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Notifikasi Pembayaran @yield('title')</h4>
                            <p style="text-align: left;">Periode : {{ date('M Y', strtotime($warga1->tanggal)) }}</p>
                            {{-- <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div> --}}
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">

                            <h1>Iuran Wajib </h1>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Pembayaran</th>
                                        <th scope="col">Bukti Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $status1 = $data1->where('jenis_iuran_id', 7);
                                        $status2 = $data1->where('jenis_iuran_id', 8);
                                    @endphp

                                    @foreach ($status1 as $i)
                                        <tr>
                                            <td width="150">Iuran Sosial</td>
                                            <td> <label for=""
                                                    class="label {{ count($status1) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status1) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                            </td>
                                            <td> {{ date('d M Y', strtotime($i->tanggal)) }}</td>
                                            @if ($i->status == 1)
                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ route('user.warga.cetak_pdf_wajib', $i->jenis_iuran_id) }}">Lihat
                                                        Bukti</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td width="150">Iuran Kebersiahan</td>
                                        <td> <label for=""
                                                class="label {{ count($status2) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status2) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                        @foreach ($status2 as $j)
                                            <td> {{ date('d M Y', strtotime($j->tanggal)) }}</td>
                                        @endforeach
                                    </tr>


                                </tbody>
                            </table>
                            <h1>Iuran Sukarela</h1>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Pembayaran</th>
                                        <th scope="col">Bukti Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $status3 = $data2->where('jenis_iuran_id', 1);
                                        $status4 = $data2->where('jenis_iuran_id', 2);
                                    @endphp

                                    <tr>
                                        <td width="150">Iuran Pendidikan</td>

                                        <td><label for=""
                                                class="label {{ count($status3) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status3) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                        @foreach ($status3 as $item3)
                                            {{-- @if ($status3 == 1) --}}
                                            <td> {{ date('d M Y', strtotime($item3->tanggal)) }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{ route('user.warga.cetak_pdf_sukarela', $item3->jenis_iuran_id) }}">Lihat
                                                    Bukti</a>
                                            </td>
                                            {{-- @endif --}}
                                        @endforeach
                                    </tr>

                                    <tr>
                                        <td width="150">Arisan</td>
                                        <td><label for=""
                                                class="label {{ count($status4) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status4) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                        @foreach ($status4 as $item4)
                                            <td> {{ date('d M Y', strtotime($items4->tanggal)) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            <h1>Iuran Kondisional</h1>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Pembayaran</th>
                                        <th scope="col">Bukti Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $status5 = $data3->where('jenis_iuran_id', 1);
                                    @endphp

                                    <tr>
                                        <td width="150">Denda Ronda</td>
                                        <td><label for=""
                                                class="label {{ count($status5) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status5) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                        @foreach ($status5 as $item5)
                                            <td>{{ date('d M Y', strtotime($item5->tanggal)) }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{ route('user.warga.cetak_pdf_kondisional', $item5->jenis_iuran_id) }}">Lihat
                                                    Bukti</a>
                                            </td>
                                        @endforeach
                                    </tr>



                                </tbody>
                            </table>
                            <h1>Iuran Agenda</h1>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Pembayaran</th>
                                        <th scope="col">Bukti Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $status6 = $data4->where('jenis_iuran_id', 1);
                                        $status7 = $data4->where('jenis_iuran_id', 2);
                                    @endphp
                                    <tr>
                                        <td width="150">Peringatan HUT RI</td>
                                        <td><label for=""
                                                class="label {{ count($status6) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status6) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                        @foreach ($status6 as $item6)
                                            <td>{{ date('d M Y', strtotime($item6->tanggal)) }}</td>
                                            <td><a class="btn btn-info"
                                                    href="{{ route('user.warga.cetak_pdf_agenda', $item6->jenis_iuran_id) }}">Lihat
                                                    Bukti</a>
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td width="150">Halal Bi Halal</td>
                                        <td><label for=""
                                                class="label {{ count($status7) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status7) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                        </td>
                                        @foreach ($status7 as $item7)
                                            <td>{{ date('d M Y', strtotime($item7->tanggal)) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                        <!-- end panel-body -->
                        <!-- begin panel-footer -->

                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script src="{{ asset('/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
        <script src="{{ asset('/assets/js/custom/string-helper.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#from-datepicker").datepicker({
                    format: 'yyyy-mm-dd'
                });
                $("#from-datepicker").on("change", function() {
                    var fromdate = $(this).val();
                    alert(fromdate);
                });
            });
        </script>
    @endpush
