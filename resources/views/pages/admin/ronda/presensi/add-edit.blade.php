@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Ubah Presensi Ronda' : 'Tambah Presensi Ronda' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ronda.presensi.index') }}">Ronda</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->


<!-- begin panel -->
@if (isset($jadwal_ronda))
<form action="{{ route('admin.ronda.presensi.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
    @csrf
    <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
              <h4 class="panel-title">Form @yield('title')</h4>
              <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="hari_id"><strong>Hari</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                {{-- {{{ $hari[\Request::get('hari')] }}} --}}
                                <input type="hidden" name="presensi_ronda_hari_id" value="{{ \Request::get('hari') }}">
                                <x-form.Dropdown name="presensi_ronda_hari_id" :options="$hari" disabled selected="{{{ \Request::get('hari') }}}" required />
                                {{-- <x-form.Dropdown name="hari" :options="$hari" selected="{{{ \Request::get('hari') }}}" required /> --}}
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="tanggal"><strong>Tanggal</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="">
                                <div class="input-group date">
                                    <input type="hidden" data-parsley-required="true"  name="presensi_ronda_tanggal" value="{{ \Request::get('presensi_ronda_tanggal')}}">
                                    {{-- {{ \Request::get('presensi_ronda_tanggal') }} --}}
                                    <input type="text" id="tanggal" name="presensi_ronda_tanggal" class="form-control date-picker" disabled data-parsley-required="true" value="{{{ \Request::get('presensi_ronda_tanggal')}}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <table class="table table-bordered mx-4 text-center">
                                    <thead>
                                        <tr>
                                            <th>Warga</th>
                                            <th>Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwal_ronda as $warga)
                                        <tr>
                                            <td>
                                                <p>{{ $warga->warga->nama }}</p>
                                                <input type="hidden" name="presensi_ronda_jadwal_ronda_id[]" value="{{{ $warga->id }}}">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="presensi_ronda_kehadiran[]" value="hadir" id="">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <!-- end panel-body -->
            <!-- begin panel-footer -->
            <div class="panel-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div>
            <!-- end panel-footer -->
    </div>
</form>
@else
<form action="{{ route('admin.ronda.presensi.create') }}" id="form" name="form" method="GET" data-parsley-validate="true" enctype="multipart/form-data">
    <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
              <h4 class="panel-title">Form @yield('title')</h4>
              <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="hari_id"><strong>Hari</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                {{-- <x-form.Dropdown name="presensi_ronda_hari_id" :options="$hari" selected="{{{ old('presensi_ronda_hari_id') ?? ($data['hari_id'] ?? null) }}}" required /> --}}
                                <x-form.Dropdown name="hari" :options="$hari" selected="{{{ \Request::get('hari') }}}" required />
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="tanggal"><strong>Tanggal</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <div class="input-group date">
                                    {{-- <input type="text" id="tanggal" name="presensi_ronda_tanggal" class="form-control date-picker" autofocus data-parsley-required="true" value="{{{ old('presensi_ronda_tanggal') ?? (isset($data['tanggal']) ? $data['tanggal']->format('dd-mm-YYYY') : null) ?? null}}}"> --}}
                                    <input type="text" id="tanggal" name="presensi_ronda_tanggal" class="form-control date-picker" autofocus data-parsley-required="true" value="{{{ \Request::get('presensi_ronda_tanggal')}}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Pilih</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end panel-body -->
            <!-- begin panel-footer -->
            {{-- <div class="panel-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div> --}}
            <!-- end panel-footer -->
    </div>
</form>
@endif

<a href="javascript:history.back(-1);" class="btn btn-success">
  <i class="fa fa-arrow-circle-left"></i> Kembali
</a>
@endsection

@push('scripts')
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
<script src="{{ asset('/assets/js/demo/form-wizards-validation.demo.js') }}"></script>
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/js/parsley/language-id.js') }}"></script>
<script src="{{ asset('/assets/js/custom/datetime-picker.js') }}"></script>
<script src="{{ asset('/assets/js/custom/string-helper.js') }}"></script>
<script>
    $( document ).ready(function() {
        $("#from-datepicker").datepicker({
            format: 'yyyy-mm-dd'
        });
        $("#from-datepicker").on("change", function () {
            var fromdate = $(this).val();
            alert(fromdate);
        });
    });
    </script>
    <script>
        form.addEventListener('submit', () => {
            if(document.getElementById("testName").checked) {
            document.getElementById('testNameHidden').disabled = true;
            }
        })
    </script>
    <script>
    // function hariChange() {
    //     var hari = document.getElementById("presensi_ronda_hari_id").value;
    //     var minggu = document.getElementById("minggu");
    //     var senin = document.getElementById("senin");
    //     var selasa = document.getElementById("selasa");
    //     var rabu = document.getElementById("rabu");
    //     var kamis = document.getElementById("kamis");
    //     var jumat = document.getElementById("jumat");
    //     var sabtu = document.getElementById("sabtu");

    //     switch (hari) {
    //     case '1':
    //         minggu.style.display = "block";
    //         senin.style.display = "none";
    //         selasa.style.display = "none";
    //         rabu.style.display = "none";
    //         kamis.style.display = "none";
    //         jumat.style.display = "none";
    //         sabtu.style.display = "none";

    //         minggu.disabled = false;
    //         senin.disabled = true;
    //         selasa.disabled = true;
    //         rabu.disabled = true;
    //         kamis.disabled = true;
    //         jumat.disabled = true;
    //         sabtu.disabled = true;
    //         break;
    //     case '2':
    //         minggu.style.display = "none";
    //         senin.style.display = "block";
    //         selasa.style.display = "none";
    //         rabu.style.display = "none";
    //         kamis.style.display = "none";
    //         jumat.style.display = "none";
    //         sabtu.style.display = "none";

    //         minggu.getAttributeNode('input').disabled = true;
    //         senin.disabled = false;
    //         selasa.disabled = true;
    //         rabu.disabled = true;
    //         kamis.disabled = true;
    //         jumat.disabled = true;
    //         sabtu.disabled = true;
    //         break;
    //     case '3':
    //         minggu.style.display = "none";
    //         senin.style.display = "none";
    //         selasa.style.display = "block";
    //         rabu.style.display = "none";
    //         kamis.style.display = "none";
    //         jumat.style.display = "none";
    //         sabtu.style.display = "none";

    //         minggu.getAttributeNode('input').disabled = true;
    //         senin.disabled = true;
    //         selasa.disabled = false;
    //         rabu.disabled = true;
    //         kamis.disabled = true;
    //         jumat.disabled = true;
    //         sabtu.disabled = true;
    //         break;
    //     case '4':
    //         minggu.style.display = "none";
    //         senin.style.display = "none";
    //         selasa.style.display = "none";
    //         rabu.style.display = "block";
    //         kamis.style.display = "none";
    //         jumat.style.display = "none";
    //         sabtu.style.display = "none";

    //         minggu.getAttributeNode('input').disabled = true;
    //         senin.disabled = true;
    //         selasa.disabled = true;
    //         rabu.disabled = false;
    //         kamis.disabled = true;
    //         jumat.disabled = true;
    //         sabtu.disabled = true;
    //         break;
    //     case '5':
    //         minggu.style.display = "none";
    //         senin.style.display = "none";
    //         selasa.style.display = "none";
    //         rabu.style.display = "none";
    //         kamis.style.display = "block";
    //         jumat.style.display = "none";
    //         sabtu.style.display = "none";

    //         minggu.getAttributeNode('input').disabled = true;
    //         senin.disabled = true;
    //         selasa.disabled = true;
    //         rabu.disabled = true;
    //         kamis.disabled = false;
    //         jumat.disabled = true;
    //         sabtu.disabled = true;
    //         break;
    //     case '6':
    //         minggu.style.display = "none";
    //         senin.style.display = "none";
    //         selasa.style.display = "none";
    //         rabu.style.display = "none";
    //         kamis.style.display = "none";
    //         jumat.style.display = "block";
    //         sabtu.style.display = "none";

    //         minggu.getAttributeNode('input').disabled = true;
    //         senin.disabled = true;
    //         selasa.disabled = true;
    //         rabu.disabled = true;
    //         kamis.disabled = true;
    //         jumat.disabled = false;
    //         sabtu.disabled = true;
    //         break;
    //     case '7':
    //         minggu.style.display = "none";
    //         senin.style.display = "none";
    //         selasa.style.display = "none";
    //         rabu.style.display = "none";
    //         kamis.style.display = "none";
    //         jumat.style.display = "none";
    //         sabtu.style.display = "block";

    //         minggu.getAttributeNode('input').disabled = true;
    //         senin.disabled = true;
    //         selasa.disabled = true;
    //         rabu.disabled = true;
    //         kamis.disabled = true;
    //         jumat.disabled = true;
    //         sabtu.disabled = false;
    //         break;
    //     default:
    //         minggu.style.display = "block";
    //         senin.style.display = "none";
    //         selasa.style.display = "none";
    //         rabu.style.display = "none";
    //         kamis.style.display = "none";
    //         jumat.style.display = "none";
    //         sabtu.style.display = "none";

    //         minggu.getAttributeNode('input').disabled = false;
    //         senin.disabled = true;
    //         selasa.disabled = true;
    //         rabu.disabled = true;
    //         kamis.disabled = true;
    //         jumat.disabled = true;
    //         sabtu.disabled = true;
    //     }
    // }
    </script>
@endpush
