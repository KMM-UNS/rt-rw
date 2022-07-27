@extends('layouts.user')
@section('title', 'Warga')

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-body">
        <h3>Formulir Pendataan Warga</h3>
        <hr>
		<!-- end panel -->
		<!-- begin wizard-form -->
		<form action="{{ isset($data) ? route('user.warga.update', $data->id) : route('user.warga.store') }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
			@csrf
            @if(isset($data))
            {{ method_field('PUT') }}
            @endif
			<!-- begin wizard -->
			<div class="row">
                <div class="col-xl-9 ui-sortable">
                    <div class="panel panel-inverse">
                      <!-- begin panel-body -->
                      <div class="panel-body">
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-2 my-auto">
                                      <label for="nik"><strong>NIK</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="">
                                          <input type="text" id="nik" name="warga_nik" class="form-control" autofocus data-parsley-required="true" minlength="16" data-parsley-minlength="16" data-parsley-maxlength="16" value="{{{ old('warga_nik') ?? ($data['nik'] ?? null) }}}">
                                      </div>
                                  </div>
                                  <div class="col-md-2 my-auto">
                                      <label for="nama"><strong>Nama</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="">
                                          <input type="text" id="nama" name="warga_nama" class="form-control" autofocus data-parsley-required="true" value="{{{ old('warga_nama') ?? ($data['nama'] ?? null) }}}">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-2 my-auto">
                                      <label for="tempat_lahir"><strong>Tempat Lahir</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="">
                                          <input type="text" id="nama" name="warga_tempat_lahir" class="form-control" autofocus data-parsley-required="true" value="{{{ old('warga_tempat_lahir') ?? ($data['tempat_lahir'] ?? null) }}}">
                                      </div>
                                  </div>
                                  <div class="col-md-2 my-auto">
                                      <label for="tanggal_lahir"><strong>Tanggal Lahir</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="date input-group">
                                          <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                          <input type="text" id="tanggal_lahir" name="warga_tanggal_lahir" class="form-control date-picker" autofocus data-parsley-required="true" value="{{{ old('warga_tanggal_lahir') ?? (isset($data['tanggal_lahir']) ? $data['tanggal_lahir']->format('dd-mm-YYYY') : null) ?? null}}}">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-2 my-auto">
                                      <label for="jenis_kelamin"><strong>Jenis Kelamin</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="">
                                          <x-form.genderRadio name="warga_jenis_kelamin" selected="{{{ old('warga_jenis_kelamin') ?? ($data['jenis_kelamin'] ?? null) }}}" />
                                      </div>
                                  </div>
                                  <div class="col-md-2 my-auto">
                                      <label for="alamat"><strong>Alamat</strong><sup> sesuai KTP</sup></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="mb-2">
                                          <input type="text" id="alamat" name="warga_alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ old('warga_alamat') ?? ($data['alamat'] ?? null) }}}">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-2 my-auto">
                                      <label for="agama_id"><strong>Agama</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="input-group">
                                          <x-form.Dropdown name="warga_agama_id" :options="$agama" selected="{{{ old('warga_agama_id') ?? ($data['agama_id'] ?? null) }}}" required />
                                      </div>
                                  </div>
                                  <div class="col-md-2 my-auto">
                                      <label for="golongan_darah_id"><strong>Golongan Darah</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="input-group">
                                          <x-form.Dropdown name="warga_golongan_darah_id" :options="$golongan_darah" selected="{{{ old('warga_golongan_darah_id') ?? ($data['golongan_darah_id'] ?? null) }}}" required />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-2 my-auto">
                                      <label for="pendidikan_id"><strong>Pendidikan</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="input-group">
                                          <x-form.Dropdown name="warga_pendidikan_id" :options="$pendidikan" selected="{{{ old('warga_pendidikan_id') ?? ($data['pendidikan_id'] ?? null) }}}" required />
                                      </div>
                                  </div>
                                  <div class="col-md-2 my-auto">
                                      <label for="pekerjaan_id"><strong>Pekerjaan</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="input-group">
                                          <x-form.Dropdown name="warga_pekerjaan_id" :options="$pekerjaan" selected="{{{ old('warga_pekerjaan_id') ?? ($data['pekerjaan_id'] ?? null) }}}" required />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-2 my-auto">
                                      <label for="warga_negara_id"><strong>Kewarganegaraan</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="input-group">
                                          <x-form.Dropdown name="warga_warga_negara_id" :options="$warga_negara" selected="{{{ old('warga_warga_negara_id') ?? ($data['warga_negara_id'] ?? null) }}}" required />
                                      </div>
                                  </div>
                                  <div class="col-md-2 my-auto">
                                      <label for="status_keluarga_id"><strong>Status dalam Keluarga</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="input-group">
                                          <x-form.Dropdown name="warga_status_keluarga_id" :options="$status_keluarga" selected="{{{ old('warga_status_keluarga_id') ?? ($data['status_keluarga_id'] ?? null) }}}" required />
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-2 my-auto">
                                      <label for="status_kawin_id"><strong>Status Kawin</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="input-group">
                                          <x-form.Dropdown name="warga_status_kawin_id" :options="$status_kawin" selected="{{{ old('warga_status_kawin_id') ?? ($data['status_kawin_id'] ?? null) }}}" required />
                                      </div>
                                  </div>
                                  <div class="col-md-2 my-auto">
                                      <label for="status_warga_id"><strong>Status Warga</strong></label>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="input-group">
                                          <x-form.Dropdown name="warga_status_warga_id" :options="$status_warga" selected="{{{ old('warga_status_warga_id') ?? ($data['status_warga_id'] ?? null) }}}" required />
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- end panel-body -->
                      <!-- begin panel-footer -->

                      <!-- end panel-footer -->
                    </div>
                </div>
                <div class="col-xl-3 ui-sortable">
                  <div class="panel panel-inverse">
                      <!-- begin panel-body -->
                      <div class="panel-body">
                          <div class="row">
                              <div class="col-md-2">
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
                            <x-form.ImageUploader :imageSrc="$imageSrc != null ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'foto')->first()['public_url']) :  null" name="foto" title="Pas Foto" />
                          </div>
                      </div>
                  </div>
                  <!-- end panel-body -->
              </div>
            </div>
            <div class="panel-footer">
                <a href="javascript:history.back(-1);" class="btn btn-success">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                  </a>
                <div style="float: right">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
		</form>
		<!-- end wizard-form -->
      </div>
    </div>
@endsection


@push('scripts')
<script src="{{ asset('/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
<script src="{{ asset('/assets/js/demo/form-wizards-validation.demo.js') }}"></script>
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/js/parsley/language-id.js') }}"></script>
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
