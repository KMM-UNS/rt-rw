@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Kas Iuran Sukarela' : 'Create Kas Iuran Sukarela' )

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
<form action="{{ isset($data) ? route('admin.kas-rt.kas-iuransukarela.update', $data->id) : route('admin.kas-rt.kas-iuransukarela.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
        <label for="name">jenis Iuran</label>
        <x-form.Dropdown name="jenis_iuran_id" :options="$jenis_iuransukarela" selected="{{{ old('jenis_iuran_id') ?? ($data['jenis_iuran_id'] ?? null) }}}" required />
      </div>
      <div class="form-group">
        <label for="bulan">Bulan</label>
        <input type="text" id="bulan" name="bulan" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->bulan ?? old('bulan') }}}">
      </div>
      <div class="form-group">
        <label for="tahun">Tahun</label>
        <input type="text" id="tahun" name="tahun" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->tahun ?? old('tahun') }}}">
      </div>
      <div class="form-group">
        <label for="penerima">Penerima</label>
        <input type="text" id="penerima" name="penerima" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->penerima ?? old('penerima') }}}">
      </div>
      <div class="form-group">
        <label for="pemberi">Pemberi</label>
        <input type="text" id="pemberi" name="pemberi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->pemberi ?? old('pemberi') }}}">
      </div>
      <div class="form-group">
        <label for="total_biaya">Total Biaya</label>
        <input type="text" id="total_biaya" name="total_biaya" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->total_biaya ?? old('total_biaya') }}}">
      </div>
      <div class="form-group">
        <label for="bukti_pembayaran">Bukti Pembayaran</label>
        <input type="text" id="bukti_pembayaran" name="bukti_pembayaran" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->bukti_pembayaran ?? old('bukti_pembayaran') }}}">
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
</form>
<a href="javascript:history.back(-1);" class="btn btn-success">
  <i class="fa fa-arrow-circle-left"></i> Kembali
</a>

@endsection

@push('scripts')
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
@endpush
