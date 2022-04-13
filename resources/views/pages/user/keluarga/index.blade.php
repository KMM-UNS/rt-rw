
@extends('layouts.user')
@section('title', 'Keluarga')

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @if(empty($keluarga) || $keluarga->count() == 0)
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-body mx-3 text-center">
                <h3>Data Keluarga</h3>
                <hr>
                <p>Anda belum mengisi data keluarga.</p>
                <a href="{{ route('user.keluarga.create') }}" class="btn btn-primary">Isi data keluarga</a>
            </div>
        </div>
        <!-- end panel -->
    @else
        <div class="panel panel-inverse">
            <div class="panel-body" style="font-size: 14px">
                <h3 class="text-center">Data Keluarga</h3>
                <hr>
                <div class="row">
                    <div class="col-md-2 my-auto">
                        <label for="no_kk"><strong>No KK</strong></label>
                    </div>
                    <div class="col-md-1 text-center">
                        :
                    </div>
                    <div class="col-md-3">
                        <strong>
                            {{ $keluarga['no_kk'] }}
                        </strong>
                    </div>
                    <div class="col-md-2 my-auto">
                        <label for="kepala_keluarga"><strong>Nama Kepala Keluarga</strong></label>
                    </div>
                    <div class="col-md-1 text-center">
                        :
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            {{ $keluarga['kepala_keluarga'] }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 my-auto">
                        <label for="rumah_id"><strong>Nomor Rumah</strong></label>
                    </div>
                    <div class="col-md-1 text-center">
                        :
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            {{ $keluarga->rumah['nomor_rumah'] }}
                        </div>
                    </div>
                    <div class="col-md-2 my-auto">
                        <label for="telp"><strong>Nomor Telepon/HP</strong></label>
                    </div>
                    <div class="col-md-1 text-center">
                        :
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            {{ $keluarga['telp'] }}
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#" class="btn btn-primary my-2">Isi data warga</a>
                </div>
            </div>
        </div>
    @endif
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
