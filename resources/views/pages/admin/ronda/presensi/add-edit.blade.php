@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Presensi Ronda' : 'Create Presensi Ronda' )

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Ronda</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
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
                                <x-form.Dropdown name="presensi_ronda_hari_id" :options="$hari" selected="{{{ old('presensi_ronda_hari_id') ?? ($data['hari_id'] ?? null) }}}" required />
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="jadwal_id"><strong>Warga</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <x-form.Dropdown name="presensi_ronda_jadwal_id" :options="$jadwal" selected="{{{ old('presensi_ronda_jadwal_id') ?? ($data['jadwal_id'] ?? null) }}}" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="tanggal"><strong>Tanggal</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group date">
                                    <input type="text" id="tanggal" name="presensi_ronda_tanggal" class="form-control date-picker" autofocus data-parsley-required="true" value="{{{ old('presensi_ronda_tanggal') ?? (isset($data['tanggal']) ? $data['tanggal']->format('dd-mm-YYYY') : null) ?? null}}}">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
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
@endpush
