@extends('layouts.default', ['topMenu' => true, 'sidebarHide' => true])

@section('title', 'Aplikasi')

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
  <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
  <li class="breadcrumb-item"><a href="javascript:;">Master Data</a></li>
  <li class="breadcrumb-item active">@yield('title')</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header"> @yield('title')<small> Master Data</small></h1>
<!-- end page-header -->


<!-- begin panel -->
<form action="{{ isset($data) ? route('admin.master-data.aplikasi.update', $data->id) : route('admin.master-data.aplikasi.store') }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
  @csrf
  @if(isset($data))
  {{ method_field('PUT') }}
  @endif


    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="row">
        <div class="col-xl-8 ui-sortable">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                  <h4 class="panel-title">Form @yield('title')</h4>
                  <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                  </div>
                </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="nama"><strong>Perumahan / Kampung </strong></label>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group">
                                <input type="text" id="nama" name="apps_nama" class="form-control" autofocus data-parsley-required="true" value="{{{ old('apps_nama') ?? ($data['nama'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="rt"><strong>RT</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="rt" name="apps_rt" class="form-control" autofocus data-parsley-required="true" value="{{{ old('apps_rt') ?? ($data['rt'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="rw"><strong>RW</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="rw" name="apps_rw" class="form-control" autofocus data-parsley-required="true" value="{{{ old('apps_rw') ?? ($data['rw'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="provinsi_id"><strong>Provinsi</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <x-form.Dropdown name="apps_provinsi_id" :options="$provinsi" selected="{{{ old('apps_provinsi_id') ?? ($data->provinsi_id ?? null) }}}" required data-parsley-required="true" />
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="kabupaten_id"><strong>Kabupaten / Kota</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <x-form.Dropdown name="apps_kabupaten_id" :options="$kabupaten" placeholder="Pilih" selected="{{{ old('apps_kabupaten_id') ?? ($data->kabupaten_id ?? null) }}}" required data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="kecamatan_id"><strong>Kecamatan</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <x-form.Dropdown name="apps_kecamatan_id" :options="$kecamatan" selected="{{{ old('apps_kecamatan_id') ?? ($data->kecamatan_id ?? null) }}}" required data-parsley-required="true" />
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="kelurahan_id"><strong>Kelurahan</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <x-form.Dropdown name="apps_kelurahan_id" :options="$kelurahan" selected="{{{ old('apps_kelurahan_id') ?? ($data->kelurahan_id ?? null) }}}" required data-parsley-required="true" />
                                </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="kode_pos"><strong>Kode Pos</strong></label>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" id="kode_pos" name="apps_kode_pos" class="form-control" autofocus data-parsley-required="true" value="{{{ old('apps_kode_pos') ?? ($data['kode_pos'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="telepon"><strong>Telepon</strong></label>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" id="telepon" name="apps_telepon" class="form-control" autofocus data-parsley-required="true" value="{{{ old('apps_telepon') ?? ($data['telepon'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="email"><strong>Email</strong></label>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" id="email" name="apps_email" class="form-control" autofocus data-parsley-required="true" value="{{{ old('apps_email') ?? ($data['email'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1 my-auto">
                            <label for="ketua_rt"><strong>Ketua RT</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="ketua_rt" name="apps_ketua_rt" class="form-control" autofocus data-parsley-required="true" value="{{{ old('apps_ketua_rt') ?? ($data['ketua_rt'] ?? null) }}}">
                            </div>
                        </div>
                        <div class="col-md-1 my-auto">
                            <label for="ketua_rw"><strong>Ketua RW</strong></label>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" id="ketua_rw" name="apps_ketua_rw" class="form-control" autofocus data-parsley-required="true" value="{{{ old('apps_ketua_rw') ?? ($data['ketua_rw'] ?? null) }}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
        </div>
        </div>
        <div class="col-xl-2 ui-sortable">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Lampiran Berkas</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <img src="{{ asset($data->foto)}}" alt="" srcset=""> --}}
                        </div>
                        {{-- <img src="{{ asset('storage/app/public/foto')$data->foto }}" alt="" srcset=""> --}}
                    </div>
                    @php
                    $imageSrc = null;
                    if(isset($data->dokumen)){
                    $imageSrc = $data->dokumen->toArray();
                    }
                    @endphp
                    <div class="row">
                        <x-form.ImageUploader :imageSrc="isset($imageSrc) ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'ttd_rt')->first()['public_url']) : null" name="ttd_rt" title="Tanda Tangan RT" value="{{{  old('ttd_rt') }}}" />
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-2 ui-sortable">
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Lampiran Berkas</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <img src="{{ asset($data->foto)}}" alt="" srcset=""> --}}
                            </div>
                            {{-- <img src="{{ asset('storage/app/public/foto')$data->foto }}" alt="" srcset=""> --}}
                        </div>
                        @php
                        $imageSrc = null;
                        if(isset($data->dokumen)){
                        $imageSrc = $data->dokumen->toArray();
                        }
                        @endphp
                        <div class="row">
                            <x-form.ImageUploader :imageSrc="isset($imageSrc) ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'ttd_rw')->first()['public_url']) : null" name="ttd_rw" title="Tanda Tangan RW" value="{{{  old('ttd_rw') }}}" />
                        </div>
                    </div>
                </div>
            </div>
    </div>
  <!-- end panel -->
</form>
<a href="javascript:history.back(-1);" class="btn btn-success">
  <i class="fa fa-arrow-circle-left"></i> Kembali
</a>

@endsection

@push('scripts')
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/js/custom/string-helper.js') }}"></script>
<script src="{{ asset('/assets/js/custom/wilayah-dropdown.js') }}"></script>
<script>
  $(document).on('delete-with-confirmation.success', function() {
    $('.buttons-reload').trigger('click')
  })
</script>
<script>

    $(function() {
                handleWilayahSelectEvent('#apps_provinsi_id', '#apps_kabupaten_id', '#apps_kecamatan_id', '#apps_kelurahan_id');
            })

    </script>
@endpush
