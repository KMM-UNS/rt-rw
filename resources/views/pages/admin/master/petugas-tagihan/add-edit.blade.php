@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Petugas Tagihan' : 'Create Petugas Tagihan')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}">
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Master Data</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Master Data<small> @yield('title')</small></h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <form
        action="{{ isset($data)? route('admin.master-data.petugas-tagihan.update', $data->id) : route('admin.master-data.petugas-tagihan.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
        @csrf
        @if (isset($data))
            {{ method_field('PUT') }}
        @endif

        <div class="panel panel-inverse">
            <!-- begin panel -heading -->
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
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="petugas_tagihans_nama" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->nama ?? old('petugas_tagihans_nama') }}}">
                </div>
                <div class="form-group">
                    <label for="ttgl">Tanggal Lahir</label>
                    <input type="date" id="ttgl" name="petugas_tagihans_ttgl" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->ttgl ?? old('petugas_tagihans_ttgl') }}}">
                </div>
                <div class="form-group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" id="no_telp" name="petugas_tagihans_no_telp" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_telp ?? old('petugas_tagihans_no_telp') }}}">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="petugas_tagihans_alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->alamat ?? old('petugas_tagihans_alamat') }}}">
                </div>
                <div class="form-group">
                    <label for="pos">Pos</label>
                    <x-form.Dropdown name="petugas_tagihans_pos" :options="$area_pos" selected="{{{ old('petugas_tagihans_pos') ?? ($data['pos'] ?? null) }}}" required />
                </div>
                <div class="form-group">
                    <label for="foto_iurankondisional">Foto Petugas</label>
                    {{-- <input type="file" id="foto_iurankondisional" name="foto_iurankondisional" class="form-control @error('image') is-invalid @enderror" autofocus data-parsley-required="true"> --}}
                    @php
                            $imageSrc = null;
                            if(isset($data->dokumen)){
                            $imageSrc = $data->dokumen->toArray();
                            }
                            @endphp
                            <div class="row">
                                <x-form.ImageUploader :imageSrc="isset($imageSrc) ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'foto_petugas')->first()['public_url']) : null" name="foto_petugas" title="Foto Petugas" value="{{{ $data->dokumen  ?? old('foto_petugas') }}}" />
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
        <!-- end panel -->
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
