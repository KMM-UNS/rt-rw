@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Detail Rumah')

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
    <li class="breadcrumb-item"><a href="{{ route('admin.rumah.index') }}">Rumah</a></li>
    <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">@yield('title')</h1>
<!-- end page-header -->

<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Data @yield('title')</h4>
        <div class="panel-heading-btn">
            {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="panel-body" style="font-size: 14px">
        <div class="row mx-auto">
            <div class="col-md-6">
                <div>
                    <label>Nomor Rumah</label>
                    <p class="font-weight-bold">{{ $data->nomor_rumah }}</p>
                </div>
                <div>
                    <label>Nama Jalan</label>
                    <p class="font-weight-bold">{{ $data->alamat }}</p>
                </div>
                <div>
                    <label>Jumlah KK</label>
                    <p class="font-weight-bold">{{ $data->keluarga->count() }}</p>
                </div>
                <div>
                    <label>Foto Rumah</label>
                    @php
                    $imageSrc = null;
                    if(isset($data->dokumen)){
                    $imageSrc = $data->dokumen->toArray();
                    }
                    @endphp
                    @if ($imageSrc != null)
                    <img class="img-responsive w-50" src="{{ $imageSrc != null ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'foto_rumah')->first()['public_url']) : null}}" alt="Rumah No.{{ $data->nomor_rumah }}">
                    @else
                    <p class="font-weight-bold">-</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <label>Status Penggunaan</label>
                    <p class="font-weight-bold">{{ $data->status_penggunaan_rumah->nama }}</p>
                </div>
                <div>
                    <label>Status Hunian</label>
                    <p class="font-weight-bold">{{ $data->status_hunian->nama }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title">Riwayat Rumah</h4>
    <div class="panel-heading-btn">
      {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
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

<!-- begin panel -->
@if ($keluargas != null)
<div class="panel panel-inverse">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title">Keluarga Penghuni</h4>
    <div class="panel-heading-btn">
      {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
    </div>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="mb-3">
        @foreach ($keluargas as $keluarga)
        <div class="row mx-auto" style="font-size: 14px">
         <div class="col-md-6">
             <div>
                 <label>No KK</label>
                 <p class="font-weight-bold">{{ $keluarga->no_kk }}</p>
             </div>
         </div>
         <div class="col-md-6">
             <div>
                 <label>Nama Kepala Keluarga</label>
                 <p class="font-weight-bold">{{ $keluarga->kepala_keluarga }}</p>
             </div>
         </div>
        </div>
        <table class="table table-bordered">
         <thead>
             <tr>
                 <th>No</th>
                 <th>NIK</th>
                 <th>Nama</th>
                 <th>Jenis Kelamin</th>
                 <th>Agama</th>
                 <th>Tempat Lahir</th>
                 <th>Tanggal Lahir</th>
                 <th>Status dalam Keluarga</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($keluarga->warga as $key => $warga)
             <tr>
                 <td>{{ $key + 1 }}</td>
                 <td>{{ $warga->nik }}</td>
                 <td>{{ $warga->nama }}</td>
                 <td>{{ $warga->jenis_kelamin }}</td>
                 <td>{{ $warga->agama->nama }}</td>
                 <td>{{ $warga->tempat_lahir }}</td>
                 <td>{{ $warga->tanggal_lahir->isoFormat('DD MMMM YYYY') }}</td>
                 <td>{{ $warga->status_keluarga->nama }}</td>
             </tr>
             @endforeach
         </tbody>
        </table>
        @endforeach
    </div>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->
@endif
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
@endpush
