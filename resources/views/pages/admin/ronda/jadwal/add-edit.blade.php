@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Ubah Jadwal Ronda' : 'Tambah Jadwal Ronda' )

@push('css')
<link href="{{ asset('/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.ronda.jadwal.index') }}">Jadwal Ronda</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ isset($data) ? route('admin.ronda.jadwal.update', $data->id) : route('admin.ronda.jadwal.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
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
                                <x-form.Dropdown name="jadwal_ronda_hari_id" :options="$hari" selected="{{{ old('jadwal_ronda_hari_id') ?? ($data['hari_id'] ?? null) }}}" required />
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="warga_id"><strong>Warga</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                @if(isset($data))
                                <x-form.dropdown name="jadwal_ronda_warga_id" data-parsley-required="true" :options="$warga" selected="{{{ old('jadwal_ronda_warga_id') ?? $data->warga->id ?? null }}}" required />
                                @else
                                <x-form.dropdown name="jadwal_ronda_warga_id[]" :options="$warga" :selected="old('jadwal_ronda_warga_id') ?? (isset($data->warga_id) ? $data->roles->pluck('id')->toArray() : null)" placeholder="Roles" multiple />
                                @endif

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
<script src="{{ asset('/assets/js/parsley/language-id.js') }}"></script>
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
