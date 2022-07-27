@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Surat')

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
    {{-- <li class="breadcrumb-item"><a href="{{ javascript:; }}">Master Data</a></li> --}}
    <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header"> @yield('title')</h1>
<!-- end page-header -->


<!-- begin panel -->
<div class="panel panel-inverse">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title">Data @yield('title')</h4>
    <div class="panel-heading-btn">
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
      <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
    </div>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="container">
        <form action="{{ route('admin.surat.index') }}" method="GET">
        {{-- <input type="d" class="form-control" name="email" value="{{\Request::get('email')}}"> --}}
        <div class="row my-2">
            {{-- <div class="col-md-2 my-auto">
                <label for="tanggal_awal"><strong>Tanggal Awal</strong></label>
            </div> --}}
            <div class="col-md-3 mx-1">
                <div class="input-group date">
                    <x-form.Dropdown name="keperluan_surat_id" :options="$keperluan_surat" placeholder="Keperluan Surat" selected="{{\Request::get('keperluan_surat_id')}}"/>
                </div>
            </div>
            {{-- <div class="col-md-2 my-auto">
                <label for="tanggal_awal"><strong>Tanggal Awal</strong></label>
            </div> --}}
            <div class="col-md-3 mx-1">
                <div class="input-group">
                    <x-form.Dropdown name="bulan" :options="$bulan" placeholder="Bulan" selected="{{\Request::get('bulan')}}"/>
                </div>
            </div>
            {{-- <div class="col-md-2 my-auto">
                <label for="tanggal_akhir"><strong>Tanggal Akhir</strong></label>
            </div> --}}
            <div class="col-md-3 mx-1">
                <div class="input-group">
                    <x-form.Dropdown name="tahun" :options="$tahun" placeholder="Tahun" selected="{{\Request::get('tahun')}}"/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"> Cari </button>
            {{-- <button type="submit" class="btn btn-primary"> Cari </button> --}}
            <a href="{{ route('admin.surat.index') }}" class="btn btn-white mx-2">Hapus Filter</a>
        </div>
        {{-- <button type="reset" class="btn btn-white"> Reset </button> --}}
        </form>
      </div>
      <hr>
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
@endpush
