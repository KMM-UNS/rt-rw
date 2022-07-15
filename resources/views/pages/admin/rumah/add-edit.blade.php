@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Rumah' : 'Create Rumah' )

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
<form action="{{ isset($data) ? route('admin.rumah.update', $data->id) : route('admin.rumah.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
  @csrf
  @if(isset($data))
  {{ method_field('PUT') }}
  @endif
  <div class="row">
      <div class="col-xl-9 ui-sortable">
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
                            <label for="alamat"><strong>Alamat</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="alamat" name="rumah_alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ old('rumah_alamat') ?? ($data['alamat'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="nomor_rumah"><strong>Nomor Rumah</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="nomor_rumah" name="rumah_nomor_rumah" class="form-control" autofocus data-parsley-required="true" value="{{{ old('rumah_nomor_rumah') ?? ($data['nomor_rumah'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="status_penggunaan_rumah_id"><strong>Status Penggunaan Rumah</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <x-form.Dropdown name="rumah_status_penggunaan_rumah_id" :options="$status_penggunaan_rumah" selected="{{{ old('rumah_status_penggunaan_rumah_id') ?? ($data['status_penggunaan_rumah_id'] ?? null) }}}" required />
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="status_hunian_id"><strong>Status Hunian</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <x-form.Dropdown name="rumah_status_hunian_id" :options="$status_hunian" selected="{{{ old('rumah_status_hunian_id') ?? ($data['status_hunian_id'] ?? null) }}}" required />
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
      <div class="col-xl-3 ui-sortable">
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">Lampiran Berkas</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        {{-- <img src="{{ asset($data->foto)}}" alt="" srcset=""> --}}
                    </div>
                    {{-- <img src="{{ asset('storage/app/public/foto')$data->foto }}" alt="" srcset=""> --}}
                </div>
                @php
                $imageSrc = null;
                if(isset($data->dokumen)){
                $imageSrc = $data->dokumen->toArray();
                }
                @endphp
                <div class="row">
                    <x-form.ImageUploader :imageSrc="$imageSrc != null ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'foto_rumah')->first()['public_url']) : null" name="foto_rumah" title="Foto Rumah" value="{{{ $data->dokumen  ?? old('foto_rumah') }}}" />
                </div>
            </div>
        </div>
        <!-- end panel-body -->
    </div>
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
