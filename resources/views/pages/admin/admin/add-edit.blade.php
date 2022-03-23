@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', isset($data) ? 'Edit Admin' : 'Create Admin' )

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
<form action="{{ isset($data) ? route('admin.admin.update', $data->id) : route('admin.admin.store') }}" id="form" name="form" method="POST" data-parsley-validate="true">
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
        <label for="name">Nama</label>
        <input type="text" name="name" class="form-control" autofocus data-parsley-required="true" value="{{{ old('name') ?? $data->name ?? null }}}">
      </div>
      <div class="form-group">
        <label for="name">Email</label>
        <input type="email" name="email" class="form-control" autofocus data-parsley-required="true" value="{{{ old('email') ?? $data->email ?? null }}}">
      </div>
      <div class="form-group">
        <label for="name">Pangkat</label>
        <input type="text" name="pangkat" class="form-control" autofocus data-parsley-required="true" value="{{{ old('pangkat') ?? $data->pangkat ?? null }}}">
      </div>
      <div class="form-group">
        <label for="name">NRP</label>
        <input type="number" name="nrp" class="form-control" autofocus data-parsley-required="true" value="{{{ old('nrp') ?? $data->nrp ?? null }}}">
      </div>
      <div class="form-group">
        <label for="name">Kata kunci</label>
        <input type="password" name="password" class="form-control" autofocus data-parsley-required="{{ isset($data) ? 'false' : 'true' }}" data-parsley-minlength="6">
        @isset($data)
        <small>*biarkan kosong jika tidak ada perubahan</small>
        @endisset
      </div>
      <div class="form-group">
        <label for="name">Ulangi Kata kunci</label>
        <input type="password" class="form-control" name="password_confirmation" data-parsley-required="{{ isset($data) ? 'false' : 'true' }}" autocomplete="new-password" data-parsley-minlength="6">
        @isset($data)
        <small>*biarkan kosong jika tidak ada perubahan</small>
        @endisset
      </div>
      <div class="form-group">
        <label for="name">Departemen</label>
        <x-form.dropdown name="department_id" :options="$department" placeholder="Pilih Departemen" selected="{{{ old('department_id') ?? $data->department_id ?? null }}}" data-parsley-required="true" />
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
<script src="{{ asset('/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
@endpush