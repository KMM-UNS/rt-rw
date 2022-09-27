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
                        <!-- begin row -->
                        <div class="row">
                            <!-- begin col-3 -->
                            <div class="col-lg-3 col-md-6">
                                <div class="widget widget-stats bg-red">
                                    <div class="stats-icon"></div>
                                    <div class="stats-info">
                                        <h4>TOTAL Kas Iuran Wajibb</h4>
                                        <p>Rp.{{ number_format($total_wajib, 0) }}</p>
                                    </div>
                                    <div class="stats-link">
                                        <a href="{{ url('/kepala-keluarga/bayar-iuranwajib') }}">View Detail<i
                                                class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-3 -->
                            <!-- begin col-3 -->
                            <div class="col-lg-3 col-md-6">
                                <div class="widget widget-stats bg-orange">
                                    <div class="stats-icon"></div>
                                    <div class="stats-info">
                                        <h4>TOTAL Kas Iuran Sukarela</h4>
                                        <p>Rp.{{ number_format($total_sukarela, 0) }}</p>
                                    </div>
                                    <div class="stats-link">
                                        <a href="{{ url('/kepala-keluarga/bayar-iuransukarela') }}">View Detail<i
                                                class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-3 -->
                            <!-- begin col-3 -->
                            <div class="col-lg-3 col-md-6">
                                <div class="widget widget-stats bg-grey-darker">
                                    <div class="stats-icon"></div>
                                    <div class="stats-info">
                                        <h4>TOTAL Kas Iuran Kondisional</h4>
                                        <p>Rp.{{ number_format($total_kondisional, 0) }}</p>
                                    </div>
                                    <div class="stats-link">
                                        <a href="{{ url('/kepala-keluarga/bayar-iurankondisional') }}">View Detail <i
                                                class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-3 -->
                            <!-- begin col-3 -->
                            <div class="col-lg-3 col-md-6">
                                <div class="widget widget-stats bg-black-lighter">
                                    <div class="stats-icon"></div>
                                    <div class="stats-info">
                                        <h4>TOTAL Kas Iuran Agenda</h4>
                                        <p>Rp.{{ number_format($total_agenda, 0) }}</p>
                                    </div>
                                    <div class="stats-link">
                                        <a href="{{ url('/kepala-keluarga/bayar-iuranagenda') }}">View Detail <i
                                                class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-3 -->
                        </div>
                        <!-- end row -->
                        {{-- <h1>Data Warga</h1> --}}

                        {{-- <table border="1" cellpadding="2" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No KK</th>
                                    <th scope="col">Kepala Keluarga</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($wargaa as $item)
                                    <tr>
                                        <td>{{ $item->no_kk }}</td>
                                        <td>{{ $item->warga }}</td>
                                        <td>
                                            <label for=""
                                                class="label {{ $item->status == 1 ? 'label-success' : 'label-danger center' }}">{{ $item->status == 1 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>

                                        </td>
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
