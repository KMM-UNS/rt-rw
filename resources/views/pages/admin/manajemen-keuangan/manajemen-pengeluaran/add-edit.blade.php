@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Manajemen Pengeluaran' : 'Create Manajemen Pengeluaran')

@push('css')
    <link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
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
        action="{{ isset($data) ? route('admin.manajemen-keuangan.manajemen-pengeluaran.update', $data->id) : route('admin.manajemen-keuangan.manajemen-pengeluaran.store') }}"
        id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
        @csrf
        @if (isset($data))
            {{ method_field('PUT') }}
        @endif

        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">Form @yield('title')</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" id="tanggal" name="manajemen_pengeluarans_tanggal" class="form-control" autofocus
                                data-parsley-required="true" value="{{{ $data->tanggal ?? old('manajemen_pengeluarans_tanggal') }}}">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" id="keterangan" name="manajemen_pengeluarans_keterangan" class="form-control" autofocus
                                data-parsley-required="true" value="{{{ $data->keterangan ?? old('manajemen_pengeluarans_keterangan') }}}">
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" id="nominal" name="manajemen_pengeluarans_nominal" class="form-control" autofocus
                                data-parsley-required="true" value="{{{ $data->nominal ?? old('manajemen_pengeluarans_nominal') }}}">
                        </div>
                    </div>
                    <div class="col-md-5 high-10">
                        <div class="form-group">
                            <label for="foto_iurankondisional">Foto Bukti Pengeluaran</label>
                            {{-- <input type="file" id="foto_iurankondisional" name="foto_iurankondisional" class="form-control @error('image') is-invalid @enderror" autofocus data-parsley-required="true"> --}}
                            @php
                                    $imageSrc = null;
                                    if(isset($data->dokumen)){
                                    $imageSrc = $data->dokumen->toArray();
                                    }
                                    @endphp
                                    <div class="row">
                                        <x-form.ImageUploader :imageSrc="isset($imageSrc) ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'foto_pengeluaran')->first()['public_url']) : null" name="foto_pengeluaran" title="Foto Pengeluaran" value="{{{ $data->dokumen  ?? old('foto_pengeluaran') }}}" />
                                    </div>
                        </div>
                    </div>
                </div>



                <!-- begin panel-footer -->
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>
                <!-- end panel-footer -->
            </div>
            <!-- end panel -->
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
        $(document).ready(function() {
            $("#from-datepicker").datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#from-datepicker").on("change", function() {
                var fromdate = $(this).val();
                alert(fromdate);
            });
        });
    </script>
@endpush
