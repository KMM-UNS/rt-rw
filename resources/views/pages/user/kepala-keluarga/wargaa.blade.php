@extends('layouts.warga')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- begin panel -->
                    <form
                        action="{{ isset($data) ? route('admin.kas-rt.kas-petugas.update', $data->id) : route('admin.kas-rt.kas-iuranwajib.store') }}"
                        id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data))
                            {{ method_field('PUT') }}
                        @endif

                        <div class="panel panel-inverse">
                            <!-- begin panel-heading -->
                            <div class="panel-heading">
                                <h4 class="panel-title">Notifikasi Pembayaran ITU @yield('title')</h4>
                                <div class="panel-heading-btn">
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                        data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                        data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                </div>
                            </div>
                            <!-- end panel-heading -->
                            <!-- begin panel-body -->
                            <div class="panel-body">

                                <h1>Iuran Wajib</h1>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Jenis</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Iuran Sosisal</td>
                                            <td>
                                                <div class="row">
                                                    <i style="color:rgb(216, 88, 88);" class='far fa-check-circle'></i>
                                                    <a style="color:rgb(216, 88, 88);"><b> Belum Bayar</b></a>
                                                </div>
                                            </td>

                                            {{-- <td><button type="button" class="btn btn-danger">Belum Bayar</button></td> --}}
                                        </tr>
                                        <tr>
                                            <td>Iuran Kebersihan</td>
                                            {{-- <td><button type="button" class="btn btn-danger">Belum Bayar</button></td> --}}
                                            <td>
                                                <div class="row">
                                                    <i style="color:rgb(216, 88, 88);" class='far fa-check-circle'></i>
                                                    <a style="color:rgb(216, 88, 88);"><b> Belum Bayar</b></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Iuran Pembangunan</td>
                                            {{-- <td><button type="button" class="btn btn-success">Sudah Bayar</button></td> --}}
                                            <td>
                                                <div class="row">
                                                    <i style="color:rgb(50, 240, 135);" class='far fa-check-circle'></i>
                                                    <a style="color:rgb(81, 235, 150);"><b> Sudah Bayar</b></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Iuran Sosial</td>
                                            {{-- <td><button type="button" class="btn btn-success">Sudah Bayar</button></td> --}}
                                            <td>
                                                <div class="row">
                                                    <i style="color:rgb(50, 240, 135);" class='far fa-check-circle'></i>
                                                    <a style="color:rgb(50, 240, 135);"><b> Sudah Bayar</b></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Iuran Kebersihan</td>
                                            {{-- <td><button type="button" class="btn btn-success">Sudah Bayar</button></td> --}}
                                            <td>
                                                <div class="row">
                                                    <i style="color:rgb(50, 240, 135);" class='far fa-check-circle'></i>
                                                    <a style="color:rgb(50, 240, 135);"><b> Sudah Bayar</b></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h1>Iuran Sukarela</h1>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Jenis</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Iuran Pendidikan</td>
                                            <td><button type="button" class="btn btn-danger">Belum Bayar</button></td>
                                        </tr>
                                        <tr>
                                            <td>Arisan</td>
                                            <td><button type="button" class="btn btn-success">Sudah Bayar</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h1>Iuran Kondisional</h1>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Jenis</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Denda Ronda </td>
                                            <td><button type="button" class="btn btn-danger">Belum Bayar</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h1>Iuran Agenda</h1>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Jenis</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Peringatan HUT RI</td>
                                            <td><button type="button" class="btn btn-danger">Belum Bayar</button></td>
                                        </tr>
                                        <tr>
                                            <td>Halal Bi Halal</td>
                                            <td><button type="button" class="btn btn-success">Sudah Bayar</button></td>
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
