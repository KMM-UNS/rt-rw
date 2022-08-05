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
                <div>
                    <label>Dokumen</label>
                    @foreach ($data->dokumen as $dokumen)
                            @php
                                $original = $dokumen['nama'];
                                $replace = str_replace('_', ' ', $original);
                            @endphp
                            <div class="my-1">
                                {{-- <img src="{{ asset($dokumen['public_url']) }}"> --}}
                                <a href="{{ $dokumen['public_url'] }}" class="btn btn-dark btn-sm" target="_blank" rel="noopener noreferrer" style="text-transform: {{ ($replace == 'ktp' ?  'uppercase' : 'capitalize') }}; align-items:center">{{ $replace }}<a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if(auth()->user()->hasRole('admin'))
        @if($data->verified_at == null)
        <a href="#modal-tolak" class="btn btn-sm btn-danger fw-normal float-right" data-toggle="modal" style="font-size: 13px"><i class="fa fa-times mr-2"></i> Tolak</a>
        <a href="#modal-verifikasi" class="btn btn-sm btn-primary fw-normal float-right mx-2" data-toggle="modal" style="font-size: 13px"><i class="fa fa-check mr-2" aria-hidden="true"></i> Verifikasi</a>
        @else
        <a href="#modal-pindah" class="btn btn-sm btn-dark fw-normal float-right" data-toggle="modal" style="font-size: 13px"><i class="fa fa-truck mr-2"></i> Pindah Rumah</a>
        @endif
        @endif
    </div>
    {{-- begin modal pindah --}}
    <div class="modal fade" id="modal-pindah">
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
                        <div id="pindahDalam">
                            <div id="dropdownRumah" class="mt-2">
                                <label for="keluarga_rumah_id">Nomor Rumah</label>
                                <x-form.Dropdown name="keluarga_rumah_id" :options="$rumah" selected="{{{ old('keluarga_rumah_id') ?? ($data['rumah_id'] ?? null) }}}" required />
                            </div>
                            <div id="dropdownStatus" class="mt-2">
                                <label for="rumah_status_hunian_id">Jenis Hunian</label>
                                <x-form.Dropdown name="rumah_status_hunian_id" :options="$status_hunian" selected="{{{ old('rumah_status_hunian_id') ?? ($data->rumah->status_hunian_id ?? null) }}}" required />
                            </div>
                        </div>
                        <div id="pindahLuar">
                        </div>
                        <hr>
                        <div class="float-right">
                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                            <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal pindah --}}
    {{-- begin modal verifikasi --}}
    <div class="modal fade" id="modal-verifikasi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Verifikasi Keluarga</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.keluarga.verifikasi', $data->id) }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
                        @csrf
                        Dengan ini Anda menyetujui jika keluarga ini adalah warga Anda.
                        Apakah Anda yakin?
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tidak</a>
                        <button type="submit" id="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal verifikasi --}}
    {{-- begin modal tolak --}}
    <div class="modal fade" id="modal-tolak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tolak</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.keluarga.tolak', $data->id) }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control" name="keluarga_keterangan" id="keterangan" placeholder="Tulis alasan ditolak" required>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal tolak --}}
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
<script>
    function pindahChange() {
    const lokasiPindah = document.getElementById("pindah");
    // const keluargaId = document.getElementById("keluarga_rumah_id");
    // const statusId = document.getElementById("rumah_status_hunian_id");
    // const dropdownRumah = document.getElementById("dropdownRumah");
    // const dropdownStatus = document.getElementById("dropdownStatus");
    const submit = document.getElementById("submit");
    const pindahDalam = document.getElementById("pindahDalam");
    const pindahLuar = document.getElementById("pindahLuar");
    const rumah = "<?= "$data->rumah_id"?>";
    const pindahDalamChild = `<div id="dropdownRumah" class="mt-2">
                            <label for="keluarga_rumah_id">Nomor Rumah</label>
                            <x-form.Dropdown name="keluarga_rumah_id" :options="$rumah" selected="{{{ old('keluarga_rumah_id') ?? ($data['rumah_id'] ?? null) }}}" required />
                        </div>
                        <div id="dropdownStatus" class="mt-2">
                            <label for="rumah_status_hunian_id">Jenis Hunian</label>
                            <x-form.Dropdown name="rumah_status_hunian_id" :options="$status_hunian" selected="{{{ old('rumah_status_hunian_id') ?? ($data->rumah->status_hunian_id ?? null) }}}" required />
                        </div>`
    const pindahLuarChild = `<div class="mt-2">
                                <input type="hidden" id="keluarga_id" name="keluarga_id" value="{{ $data->id }}">
                                <label for="warga_pindah_alamat_tujuan">Alamat Tujuan</label>
                                <input type="text" id="alamat_tujuan" name="warga_pindah_alamat_tujuan" class="form-control" autofocus data-parsley-required="true" value="{{{ old('warga_alamat_tujuan') ?? ($data->warga->first()['alamat_tujuan'] ?? null) }}}">
                            </div>
                            <div class="mt-2">
                                <label for="warga_pindah_tanggal_pindah">Tanggal Pindah</label>
                                <div class="input-group date">
                                    <input type="date" id="tanggal_pindah" name="warga_pindah_tanggal_pindah" class="form-control" autofocus data-parsley-required="true" value="{{{ old('warga_pindah_tanggal_pindah') ?? (isset($data->warga->first()['tanggal_pindah']) ? $data->warga->first()['tanggal_tiba']->format('dd-mm-YYYY') : null) ?? null}}}">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="warga_pindah_keterangan">Keterangan</label>
                                <input type="text" id="keterangan" name="warga_pindah_keterangan" class="form-control" autofocus value="{{{ old('warga_keterangan') ?? ($data->warga->first()['keterangan'] ?? null) }}}">
                            </div>`

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
        while (pindahDalam.hasChildNodes()) {
                pindahDalam.removeChild(pindahDalam.firstChild);
            }
        while (pindahLuar.hasChildNodes()) {
                pindahLuar.removeChild(pindahLuar.firstChild);
            }
    }
    else if (lokasiPindah.value == "Luar Lingkungan"){
        submit.disabled = false;
        while (pindahDalam.hasChildNodes()) {
                pindahDalam.removeChild(pindahDalam.firstChild);
            }
        pindahLuar.innerHTML = pindahLuarChild;
    }
    else {
        submit.disabled = false;
        pindahDalam.innerHTML = pindahDalamChild;
        while (pindahLuar.hasChildNodes()) {
                pindahLuar.removeChild(pindahLuar.firstChild);
            }
    }
}
</script>
@endpush
