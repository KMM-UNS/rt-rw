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
<form action="{{ isset($data) ? route('admin.ronda.presensi.update', $data->id) : route('admin.ronda.presensi.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
  @csrf
  @if(isset($data))
  {{ method_field('PUT') }}
  @endif
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
                                <x-form.Dropdown name="presensi_ronda_hari_id" :options="$hari" onchange="hariChange()" selected="{{{ old('presensi_ronda_hari_id') ?? ($data['hari_id'] ?? null) }}}" required />
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="jadwal_ronda_id"><strong>Warga</strong></label>
                        </div>
                            <div id="mingguSelect" class="input-group col-md-5">
                                <select class="select2 form-control" name="presensi_ronda_jadwal_ronda_id" id="minggu" >
                                    @foreach ($minggu as $id => $minggu)
                                        <option value="{{ $id }}">
                                        {{ in_array($id, old('minggu', [])) ? 'selected' : '' }}
                                        {{ $minggu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="seninSelect" class="input-group col-md-5" style="display:none;">
                                <select class="select2 form-control" name="presensi_ronda_jadwal_ronda_id" id="senin">
                                    @foreach ($senin as $id => $senin)
                                        <option value="{{ $id }}">
                                        {{ in_array($id, old('senin', [])) ? 'selected' : '' }}
                                        {{ $senin }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="selasaSelect" class="input-group col-md-5" style="display:none;">
                                <select class="select2 form-control" name="presensi_ronda_jadwal_ronda_id" id="selasa">
                                    @foreach ($selasa as $id => $selasa)
                                        <option value="{{ $id }}">
                                        {{ in_array($id, old('selasa', [])) ? 'selected' : '' }}
                                        {{ $selasa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="rabuSelect" class="input-group col-md-5" style="display:none;">
                                <select class="select2 form-control" name="presensi_ronda_jadwal_ronda_id" id="rabu">
                                    @foreach ($rabu as $id => $rabu)
                                        <option value="{{ $id }}">
                                        {{ in_array($id, old('rabu', [])) ? 'selected' : '' }}
                                        {{ $rabu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="kamisSelect" class="input-group col-md-5" style="display:none;">
                                <select class="select2 form-control" name="presensi_ronda_jadwal_ronda_id" id="kamis">
                                    @foreach ($kamis as $id => $kamis)
                                        <option value="{{ $id }}">
                                        {{ in_array($id, old('kamis', [])) ? 'selected' : '' }}
                                        {{ $kamis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="jumatSelect" class="input-group col-md-5" style="display:none;">
                                <select class="select2 form-control" name="presensi_ronda_jadwal_ronda_id" id="jumat">
                                    @foreach ($jumat as $id => $jumat)
                                        <option value="{{ $id }}">
                                        {{ in_array($id, old('jumat', [])) ? 'selected' : '' }}
                                        {{ $jumat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="sabtuSelect" class="input-group col-md-5" style="display:none;">
                                <select class="select2 form-control" name="presensi_ronda_jadwal_ronda_id" id="sabtu">
                                    @foreach ($sabtu as $id => $sabtu)
                                        <option value="{{ $id }}">
                                        {{ in_array($id, old('sabtu', [])) ? 'selected' : '' }}
                                        {{ $sabtu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="tanggal"><strong>Tanggal</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="">
                                <div class="input-group date">
                                    <input type="text" id="tanggal" name="presensi_ronda_tanggal" class="form-control date-picker" autofocus data-parsley-required="true" value="{{{ old('presensi_ronda_tanggal') ?? (isset($data['tanggal']) ? $data['tanggal']->format('dd-mm-YYYY') : null) ?? null}}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="kehadiran"><strong>Kehadiran</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div>
                                    <x-form.presensiRadio name="presensi_ronda_kehadiran" selected="{{{ old('presensi_ronda_kehadiran') ?? ($data['kehadiran'] ?? null) }}}" />
                                </div>
                            </div>
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
    function hariChange() {
        var hari = document.getElementById("presensi_ronda_hari_id").value;
        var minggu = document.getElementById("minggu");
        var senin = document.getElementById("senin");
        var selasa = document.getElementById("selasa");
        var rabu = document.getElementById("rabu");
        var kamis = document.getElementById("kamis");
        var jumat = document.getElementById("jumat");
        var sabtu = document.getElementById("sabtu");

        var mingguSelect = document.getElementById("mingguSelect");
        var seninSelect = document.getElementById("seninSelect");
        var selasaSelect = document.getElementById("selasaSelect");
        var rabuSelect = document.getElementById("rabuSelect");
        var kamisSelect = document.getElementById("kamisSelect");
        var jumatSelect = document.getElementById("jumatSelect");
        var sabtuSelect = document.getElementById("sabtuSelect");

        switch (hari) {
        case '1':
            mingguSelect.style.display = "block";
            seninSelect.style.display = "none";
            selasaSelect.style.display = "none";
            rabuSelect.style.display = "none";
            kamisSelect.style.display = "none";
            jumatSelect.style.display = "none";
            sabtuSelect.style.display = "none";

            minggu.disabled = false;
            senin.disabled = true;
            selasa.disabled = true;
            rabu.disabled = true;
            kamis.disabled = true;
            jumat.disabled = true;
            sabtu.disabled = true;
            break;
        case '2':
            mingguSelect.style.display = "none";
            seninSelect.style.display = "block";
            selasaSelect.style.display = "none";
            rabuSelect.style.display = "none";
            kamisSelect.style.display = "none";
            jumatSelect.style.display = "none";
            sabtuSelect.style.display = "none";

            minggu.disabled = true;
            senin.disabled = false;
            selasa.disabled = true;
            rabu.disabled = true;
            kamis.disabled = true;
            jumat.disabled = true;
            sabtu.disabled = true;
            break;
        case '3':
            mingguSelect.style.display = "none";
            seninSelect.style.display = "none";
            selasaSelect.style.display = "block";
            rabuSelect.style.display = "none";
            kamisSelect.style.display = "none";
            jumatSelect.style.display = "none";
            sabtuSelect.style.display = "none";

            minggu.disabled = true;
            senin.disabled = true;
            selasa.disabled = false;
            rabu.disabled = true;
            kamis.disabled = true;
            jumat.disabled = true;
            sabtu.disabled = true;
            break;
        case '4':
            mingguSelect.style.display = "none";
            seninSelect.style.display = "none";
            selasaSelect.style.display = "none";
            rabuSelect.style.display = "block";
            kamisSelect.style.display = "none";
            jumatSelect.style.display = "none";
            sabtuSelect.style.display = "none";

            minggu.disabled = true;
            senin.disabled = true;
            selasa.disabled = true;
            rabu.disabled = false;
            kamis.disabled = true;
            jumat.disabled = true;
            sabtu.disabled = true;
            break;
        case '5':
            mingguSelect.style.display = "none";
            seninSelect.style.display = "none";
            selasaSelect.style.display = "none";
            rabuSelect.style.display = "none";
            kamisSelect.style.display = "block";
            jumatSelect.style.display = "none";
            sabtuSelect.style.display = "none";

            minggu.disabled = true;
            senin.disabled = true;
            selasa.disabled = true;
            rabu.disabled = true;
            kamis.disabled = false;
            jumat.disabled = true;
            sabtu.disabled = true;
            break;
        case '6':
            mingguSelect.style.display = "none";
            seninSelect.style.display = "none";
            selasaSelect.style.display = "none";
            rabuSelect.style.display = "none";
            kamisSelect.style.display = "none";
            jumatSelect.style.display = "block";
            sabtuSelect.style.display = "none";

            minggu.disabled = true;
            senin.disabled = true;
            selasa.disabled = true;
            rabu.disabled = true;
            kamis.disabled = true;
            jumat.disabled = false;
            sabtu.disabled = true;
            break;
        case '7':
            mingguSelect.style.display = "none";
            seninSelect.style.display = "none";
            selasaSelect.style.display = "none";
            rabuSelect.style.display = "none";
            kamisSelect.style.display = "none";
            jumatSelect.style.display = "none";
            sabtuSelect.style.display = "block";

            minggu.disabled = true;
            senin.disabled = true;
            selasa.disabled = true;
            rabu.disabled = true;
            kamis.disabled = true;
            jumat.disabled = true;
            sabtu.disabled = false;
            break;
        default:
            mingguSelect.style.display = "block";
            seninSelect.style.display = "none";
            selasaSelect.style.display = "none";
            rabuSelect.style.display = "none";
            kamisSelect.style.display = "none";
            jumatSelect.style.display = "none";
            sabtuSelect.style.display = "none";

            minggu.disabled = false;
            senin.disabled = true;
            selasa.disabled = true;
            rabu.disabled = true;
            kamis.disabled = true;
            jumat.disabled = true;
            sabtu.disabled = true;
        }
    }
    </script>
@endpush
