@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title','Tambah Warga Meninggal' )

@push('css')
<link href="{{ asset('/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.warga.index') }}">Warga</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.warga.meninggal.index') }}">Meninggal</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ route('admin.warga.meninggal.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
  @csrf
  @if(isset($data))
  {{ method_field('PUT') }}
  @endif
  <div class="row">
      <div class="col-xl-12 ui-sortable">
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
                <div class="alert alert-warning" role="alert">
                    Berhati-hatilah dalam mendata warga yang meninggal, dan pastikan bahwa anda tidak salah dalam melakukan pendataan.
                  </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2 my-auto">
                            <label for="warga_id"><strong>Warga</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <x-form.Dropdown name="warga_meninggal_warga_id" :options="$warga" selected="{{{ old('warga_meninggal_warga_id') ?? ($data['warga_id'] ?? null) }}}" required />
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                            <label for="waktu"><strong>Waktu Meninggal</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <input type="text" id="waktu" name="warga_meninggal_waktu" class="form-control datetime-picker" data-parsley-required="true" value="{{{ old('warga_meninggal_waktu') ?? (isset($data['waktu']) ? $data['tanggal_tiba']->format('dd-mm-YYYY H:i') : null) ?? null}}}">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2 my-auto">
                            <label for="penyebab"><strong>Penyebab</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="penyebab" name="warga_meninggal_penyebab" class="form-control" data-parsley-required="true" value="{{{ old('warga_meninggal_penyebab') ?? ($data['penyebab'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                            <label for="tempat_pemakaman"><strong>Tempat Pemakaman</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="tempat_pemakaman" name="warga_meninggal_tempat_pemakaman" class="form-control" value="{{{ old('warga_meninggal_tempat_pemakaman') ?? ($data['tempat_pemakaman'] ?? null) }}}">
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
      </div>
        <!-- end panel-body -->
    </div>
    <a href="javascript:history.back(-1);" class="btn btn-success">
      <i class="fa fa-arrow-circle-left"></i> Kembali
    </a>
  </div>
</form>

@endsection

@push('scripts')
<script src="{{ asset('/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/js/custom/datetime-picker.js') }}"></script>
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/js/custom/string-helper.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
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
