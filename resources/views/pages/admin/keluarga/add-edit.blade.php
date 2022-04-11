@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Keluarga' : 'Create Keluarga' )

@push('css')
<link href="{{ asset('/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Admin</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ isset($data) ? route('admin.keluarga.update', $data->id) : route('admin.keluarga.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
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
                            <label for="no_kk"><strong>No KK</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="no_kk" name="keluarga_no_kk" class="form-control" autofocus data-parsley-required="true" value="{{{ old('keluarga_no_kk') ?? ($data['no_kk'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="kepala_keluarga"><strong>Nama Kepala Keluarga</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="kepala_keluarga" name="keluarga_kepala_keluarga" class="form-control" autofocus data-parsley-required="true" value="{{{ old('keluarga_kepala_keluarga') ?? ($data['kepala_keluarga'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="rumah_id"><strong>Nomor Rumah</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <x-form.Dropdown name="keluarga_rumah_id" :options="$rumah" selected="{{{ old('keluarga_rumah_id') ?? ($data['rumah_id'] ?? null) }}}" required />
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="telp"><strong>Nomor Telepon/HP</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="telp" name="keluarga_telp" class="form-control" autofocus data-parsley-required="true" value="{{{ old('keluarga_telp') ?? ($data['telp'] ?? null) }}}">
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
<script src="{{ asset('/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
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
