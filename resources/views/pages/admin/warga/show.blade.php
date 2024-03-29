@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Detail Warga')

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.warga.index') }}">Warga</a></li>
<li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header"> @yield('title')</h1>
<!-- end page-header -->

<div class="panel panel-inverse">
    <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title">Data @yield('title')</h4>
    <div class="panel-heading-btn">
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
    </div>
  </div>
    <div class="panel-body" style="font-size: 14px">
        <div class="content mx-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="image text-center">
                        @php
                        $imageSrc = null;
                        if(isset($data->dokumen)){
                        $imageSrc = $data->dokumen->toArray();
                        }
                        @endphp
                        @if ($imageSrc != null)
                        <img src="{{ $imageSrc != null ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'foto')->first()['public_url']) : null }}" class="img-rounded height-150" data-toggle="modal" data-target="#exampleModal" style="
                        object-fit: cover;
                        border-radius: 50%;
                        width: 150px;
                        height: 150px;"
                        alt="{{ $data->nama }}">
                        @endif
                    </div>
                </div>
                <div class="col-md-7 d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <h3>{{ $data->nama }}</h3>
                        <h5 class="font-weight-normal">{{ $data->nik }}</h5>
                    </div>
                </div>
                {{-- <div class="col-md-2 d-flex align-items-center justify-content-center justify-content-md-start">
                    <a href="{{ route('user.warga.edit', $data->id) }}" class="btn btn-default" style="font-size: 14px; border: 1px solid;">Ubah Data</a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="panel-body" style="font-size: 14px">
        <div class="row mx-4 mt-3">
            <div class="col-md-6">
                <div>
                    <label>Nama</label>
                    <p class="font-weight-bold">{{ $data->nama }}</p>
                </div>
                <div>
                    <label>NIK</label>
                    <p class="font-weight-bold">{{ $data->nik }}</p>
                </div>
                <div>
                    <label>Tempat Lahir</label>
                    <p class="font-weight-bold">{{ $data->tempat_lahir }}</p>
                </div>
                <div>
                    <label>Tanggal Lahir</label>
                    <p class="font-weight-bold">{{ $data->tanggal_lahir->isoFormat('DD MMMM YYYY') }}</p>
                </div>
                <div>
                    <label>Agama</label>
                    <p class="font-weight-bold">{{ $data->agama->nama }}</p>
                </div>
                <div>
                    <label>Golongan Darah</label>
                    <p class="font-weight-bold">{{ $data->golongan_darah->nama }}</p>
                </div>
                <div>
                    <label>Alamat</label>
                    <p class="font-weight-bold">{{ $data->alamat }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <label>Pendidikan</label>
                    <p class="font-weight-bold">{{ $data->pendidikan->nama }}</p>
                </div>
                <div>
                    <label>Pekerjaan</label>
                    <p class="font-weight-bold">{{ $data->pekerjaan->nama }}</p>
                </div>
                <div>
                    <label>Kewarganegaraan</label>
                    <p class="font-weight-bold">{{ $data->warga_negara->nama }}</p>
                </div>
                <div>
                    <label>Status dalam Keluarga</label>
                    <p class="font-weight-bold">{{ $data->status_keluarga->nama }}</p>
                </div>
                <div>
                    <label>Status Kawin</label>
                    <p class="font-weight-bold">{{ $data->status_kawin->nama }}</p>
                </div>
                <div>
                    <label>Status Warga</label>
                    <p class="font-weight-bold">{{ $data->status_warga->nama }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <a href="javascript:history.back(-1);" class="btn btn-success mx-4 my-2">
            <i class="fa fa-arrow-circle-left"></i> Kembali
            </a>
    </div>
</div>
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
