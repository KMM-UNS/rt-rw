@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- begin panel -->
                    {{-- <form
                        action="{{ isset($data) ? route('admin.kas-rt.kas-petugas.update', $data->id) : route('admin.kas-rt.kas-iuranwajib.store') }}"
                        id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data))
                            {{ method_field('PUT') }}
                        @endif --}}

                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Form @yield('title')</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <!-- end panel-heading -->


                        {{-- <a class="btn btn-primary" href="{{ route('user.petugas-iuran.data-petugas.edit') }}">Edit</a> --}}
                        <form action="{{ route('user.petugas-iuran.data-petugas.store') }}" id="form" name="form"
                            method="POST" data-parsley-validate="true" enctype="multipart/form-data">
                            @csrf
                            @if (isset($data))
                                {{ method_field('PUT') }}
                            @endif
                            <!-- begin panel-body -->
                            <div class="panel-body">
                                <a href="{{ url('petugas-iuran/data-petugas/create') }}"
                                    class="btn btn-success">CREATE</a>
                                <div class="row">
                                    <div class="col">
                                        <img src="/assets/img/user/user-13.jpg" alt="Foto Petugas" width="200">
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
                                                @foreach ($data1 as $item)
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td> {{ Auth::user()->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Lahir</td>
                                                        <td>{{ date('d M Y', strtotime($item->ttgl)) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. Telepon</td>
                                                        <td>{{ $item->no_telp }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>{{ $item->alamat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pos</td>
                                                        <td>{{ $item->poss->nama }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- end panel-body -->

                    <!-- begin panel-footer -->
                    {{-- <div class="panel pr-5">
                        <a class="btn btn-outline-info"
                            href="{{ route('user.petugas-iuran.data-petugas.update') }}">Edit</a>
                    </div>
                    <!-- end panel-footer -->

                    <a href="javascript:history.back(-1);" class="btn btn-success">
                        <i class="fa fa-arrow-circle-left"></i> Kembali
                    </a> --}}
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
