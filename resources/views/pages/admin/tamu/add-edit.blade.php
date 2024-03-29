@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Tamu' : 'Create Tamu' )

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
<form action="{{ isset($data) ? route('admin.tamu.update', $data->id) : route('admin.tamu.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
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
                        <div class="col-md-2 my-auto">
                            <label for="jumlah"><strong>Jumlah</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="number" id="jumlah" name="tamu_jumlah" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_jumlah') ?? ($data['jumlah'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                            <label for="nama"><strong>Nama</strong><sup> (isi satu nama tamu)</sup></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="nama" name="tamu_nama" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_nama') ?? ($data['nama'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2 my-auto">
                            <label for="alamat"><strong>Alamat</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="alamat" name="tamu_alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_alamat') ?? ($data['alamat'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                            <label for="hubungan"><strong>Hubungan</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="hubungan" name="tamu_hubungan" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_hubungan') ?? ($data['hubungan'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2 my-auto">
                            <label for="tanggal_tiba"><strong>Tanggal Tiba</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <input type="text" id="tanggal_tiba" name="tamu_tanggal_tiba" class="form-control date-picker" autofocus data-parsley-required="true" value="{{{ old('tamu_tanggal_tiba') ?? (isset($data['tanggal_tiba']) ? $data['tanggal_tiba']->format('dd-mm-YYYY') : null) ?? null}}}">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                            <label for="lama_menetap"><strong>Lama Menetap</strong><sup> (dalam hari)</sup></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="number" id="lama_menetap" name="tamu_lama_menetap" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_lama_menetap') ?? ($data['lama_menetap'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2 my-auto">
                            <label for="keluarga_id"><strong>Keluarga Tempat Bermalam</strong></label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <x-form.Dropdown name="tamu_keluarga_id" :options="$keluarga" selected="{{{ old('tamu_keluarga_id') ?? ($data['keluarga_id'] ?? null) }}}" required />
                                </span>
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
