@extends('layouts.user')
@section('title', 'Keluarga')

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-body">
        <h3>Formulir Pendataan Keluarga</h3>
        <hr>
		<!-- end panel -->
		<!-- begin wizard-form -->
		<form action="{{ isset($data) ? route('user.keluarga.update', $data->id) : route('user.keluarga.store') }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
			@csrf
            @if(isset($data))
            {{ method_field('PUT') }}
            @endif
			<!-- begin wizard -->
			<div class="row">
                <!-- begin col-8 -->
                <div class="col-md-12 mb-4">
                    <legend class="no-border f-w-700 p-b-0 m-t-2 mb-3 f-s-16 text-inverse text-center">Data Keluarga</legend>
                    <hr>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 my-auto">
                                    <label for="no_kk"><strong>No KK</strong></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" id="no_kk" name="keluarga_no_kk" class="form-control" autofocus data-parsley-required="true" value="{{{ old('keluarga_no_kk') ?? ($data['no_kk'] ?? null) }}}">
                                    </div>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label for="kepala_keluarga"><strong>Nama Kepala Keluarga</strong></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" id="kepala_keluarga" name="keluarga_kepala_keluarga" class="form-control" autofocus data-parsley-required="true" value="{{{ old('keluarga_kepala_keluarga') ?? ($data['kepala_keluarga'] ?? auth()->user()->name) }}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2 my-auto">
                                    <label for="rumah_id"><strong>Nomor Rumah</strong></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        @if (isset($data))
                                        <input type="text" id="rumah_id" name="keluarga_rumah_id" class="form-control" autofocus data-parsley-required="true" disabled  value="{{{ $data->rumah->nomor_rumah }}}">
                                        <input type="hidden" id="rumah_id" name="keluarga_rumah_id" class="form-control" autofocus data-parsley-required="true"  value="{{{ $data->rumah_id }}}">
                                        @else
                                        <x-form.Dropdown name="keluarga_rumah_id" :options="$rumah" selected="{{{ old('keluarga_rumah_id') ?? ($data['rumah_id'] ?? null) }}}" required />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label for="telp"><strong>Nomor Telepon/HP</strong></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" id="telp" name="keluarga_telp" class="form-control" autofocus data-parsley-required="true"  value="{{{ old('keluarga_telp') ?? ($data['telp'] ?? null) }}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end form-group -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
		</form>
		<!-- end wizard-form -->
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