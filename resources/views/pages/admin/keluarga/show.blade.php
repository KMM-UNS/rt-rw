@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Detail Keluarga')

@push('css')
<!-- datatables -->
<link href="{{ asset('/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
<!-- end datatables -->
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.keluarga.index') }}">Keluarga</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->

<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Data Keluarga</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="panel-body" style="font-size: 14px">
        <div class="row mx-auto">
            <div class="col-md-6">
                <div>
                    <label>No KK</label>
                    <p class="font-weight-bold">{{ $data['no_kk'] }}</p>
                </div>
                <div>
                    <label>Nama Kepala Keluarga</label>
                    <p class="font-weight-bold">{{ $data['kepala_keluarga'] }}</p>
                </div>
                <div>
                    <label>Nomor Telepon/HP</label>
                    <p class="font-weight-bold">{{ $data['telp'] }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <label>Alamat</label>
                    <p class="font-weight-bold">{{ !empty($data->rumah_id) ? $data->rumah['alamat'] : "-" }}</p>
                </div>
                <div>
                    <label>Nomor Rumah</label>
                    <p class="font-weight-bold">{{ !empty($data->rumah_id) ? $data->rumah['nomor_rumah'] : "-" }}</p>
                </div>
            </div>
        </div>
        @if(auth()->user()->hasRole('admin'))
        <a href="#modal-dialog" class="btn btn-sm btn-dark fw-normal float-right" data-toggle="modal" style="font-size: 13px"><i class="fa fa-truck mr-2"></i> Pindah Rumah</a>
        @endif
    </div>
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pindah Rumah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.keluarga.pindah', $data->id) }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <select class="form-control select2" onchange="pindahChange()" name="lokasi" id="pindah">
                                <option value="Dalam Lingkungan" selected>Dalam Lingkungan</option>
                                <option value="Luar Lingkungan">Luar Lingkungan</option>
                            </select>
                        </div>
                        <div id="dropdownRumah" class="mt-2">
                            <label for="keluarga_rumah_id">Nomor Rumah</label>
                            <x-form.Dropdown name="keluarga_rumah_id" :options="$rumah" selected="{{{ old('keluarga_rumah_id') ?? ($data['rumah_id'] ?? null) }}}" required />
                        </div>
                        <div id="dropdownStatus" class="mt-2">
                            <label for="rumah_status_hunian_id">Jenis Hunian</label>
                            <x-form.Dropdown name="rumah_status_hunian_id" :options="$status_hunian" selected="{{{ old('rumah_status_hunian_id') ?? ($data->rumah->status_hunian_id ?? null) }}}" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title">Data Anggota Keluarga</h4>
    <div class="panel-heading-btn">
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
    </div>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body">
    {{ $dataTable->table() }}
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->
@endsection

@push('scripts')
<!-- datatables -->
<script src="{{ asset('assets/js/custom/datatable-assets.js') }}"></script>
{{ $dataTable->scripts() }}
<!-- end datatables -->

<script src="{{ asset('assets/js/custom/delete-with-confirmation.js') }}"></script>
<script>
  $(document).on('delete-with-confirmation.success', function() {
    $('.buttons-reload').trigger('click')
  })
</script>
<script>
    function pindahChange() {
    var lokasiPindah = document.getElementById("pindah");
    var keluargaId = document.getElementById("keluarga_rumah_id");
    var statusId = document.getElementById("rumah_status_hunian_id");
    var dropdownRumah = document.getElementById("dropdownRumah");
    var dropdownStatus = document.getElementById("dropdownStatus");
    var submit = document.getElementById("submit");
    var rumah = "<?= "$data->rumah_id"?>";

    function empty(e) {
    switch (e) {
        case "":
        case 0:
        case "0":
        case null:
        case false:
        case undefined:
        return true;
        default:
        return false;
    }
    }

    if (empty(rumah) && lokasiPindah.value == "Luar Lingkungan" ) {
        submit.disabled = true;
        keluargaId.disabled = true;
        statusId.disabled = true;
        dropdownRumah.style.display = "none";
        dropdownStatus.style.display = "none";
    }
    else if (lokasiPindah.value == "Luar Lingkungan"){
        submit.disabled = false;
        keluargaId.disabled = true;
        statusId.disabled = true;
        dropdownRumah.style.display = "none";
        dropdownStatus.style.display = "none";
    }
    else {
        submit.disabled = false;
        keluargaId.disabled = false;
        statusId.disabled = false;
        dropdownRumah.style.display = "block";
        dropdownStatus.style.display = "block";
    }
}
</script>
@endpush
