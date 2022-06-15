@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Surat' : 'Create Surat' )

@push('css')
<link href="{{ asset('/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
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
<form action="{{ isset($data) ? route('admin.surat.update', $data->id) : route('admin.surat.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
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
                            <label for="surat_warga_id"><strong>Warga</strong></label>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <x-form.Dropdown name="surat_warga_id" :options="$warga" selected="{{{ old('surat_warga_id') ?? ($data['warga_id'] ?? null) }}}" required />
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-1 my-auto">
                            <label for="surat_keperluan_surat_id"><strong>Keperluan</strong></label>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <x-form.Dropdown name="surat_keperluan_surat_id" :options="$keperluan_surat" onchange="suratChange()" selected="{{{ old('surat_keperluan_surat_id') ?? ($data['keperluan_surat_id'] ?? null) }}}" required />
                            </div>
                            <div class="input-group my-1">
                                <input type="text" id="keterangan" name="surat_keterangan" class="form-control" autofocus  placeholder="Tuliskan disini. . ." value="{{{ old('surat_keterangan') ?? ($data['keterangan'] ?? null) }}}" style="display: none;">
                            </div>
                            <input type="hidden" id="status" name="surat_status" class="form-control" value="1">
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
<script>
    function suratChange() {
    var keperluanSurat = document.getElementById("surat_keperluan_surat_id");
    var keterangan = document.getElementById("keterangan");

        // if lainnya dipilih
        if (keperluanSurat.value == "9999"){
            keterangan.style.display = "block";
        }
        else {
            keterangan.style.display = "none";
        }
    }
// function suratKeteranganChange() {
//     var jenisSuratKeterangan = document.getElementById("surat_jenis_surat_keterangan_id");
//     var keterangan = document.getElementById("keterangan");
//     var suratKeterangan = document.getElementById("surat_keterangan");
//     var inputKeterangan = document.getElementById("input_keterangan");

//     if(jenisSuratKeterangan.value == "2" ) {
//             keterangan.style.display = "block";
//             inputKeterangan.placeholder = "Tuliskan nama usaha dan alamat lengkap..";
//     }
//     else if (jenisSuratKeterangan.value == "5"){
//         keterangan.style.display = "block";
//         inputKeterangan.placeholder = "Tuliskan barang yang hilang..";
//     }
//     else {
//         keterangan.style.display = "none";
//     }
// }
</script>
@endpush
