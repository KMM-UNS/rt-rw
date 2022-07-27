
@extends('layouts.user')
@section('title', 'Tamu')

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="panel panel-inverse">
        <div class="panel-body">
        <h3 class="text-center">Formulir Tamu</h3>
        <hr>
        <form action="{{ route('user.tamu.store') }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
            @csrf
            <!-- begin wizard -->
            <div class="row ">
                <div class="col-xl ui-sortable">
                    <div class="panel panel-inverse">
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2 my-auto">
                                        <label for="jumlah"><strong>Jumlah</strong></label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input type="number" id="jumlah" name="tamu_jumlah" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_jumlah') ?? ($data['jumlah'] ?? null) }}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label for="nama"><strong>Nama</strong><sup> (isi satu nama tamu)</sup></label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input type="text" id="nama" name="tamu_nama" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_nama') ?? ($data['nama'] ?? null) }}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2 my-auto">
                                        <label for="alamat"><strong>Alamat</strong></label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input type="text" id="alamat" name="tamu_alamat" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_alamat') ?? ($data['alamat'] ?? null) }}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label for="hubungan"><strong>Hubungan</strong></label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input type="text" id="hubungan" name="tamu_hubungan" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_hubungan') ?? ($data['hubungan'] ?? null) }}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2 my-auto">
                                        <label for="tanggal_tiba"><strong>Tanggal Tiba</strong></label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" id="tanggal_tiba" name="tamu_tanggal_tiba" class="form-control date-picker" autofocus data-parsley-required="true" value="{{{ old('tamu_tanggal_tiba') ?? (isset($data['tanggal_tiba']) ? $data['tanggal_tiba']->format('dd-mm-YYYY') : null) ?? null}}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label for="keluarga_id"><strong>Lama Menetap</strong><sup> (dalam hari)</sup></label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input type="number" id="lama_menetap" name="tamu_lama_menetap" class="form-control" autofocus data-parsley-required="true" value="{{{ old('tamu_lama_menetap') ?? ($data['lama_menetap'] ?? null) }}}">
                                        </div>
                                    </div>
                                    <input type="hidden" id="keluarga_id" name="tamu_keluarga_id" class="form-control" autofocus data-parsley-required="true" value="{{{ $keluarga }}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end panel-body -->
                    <!-- begin panel-footer -->

                    <!-- end panel-footer -->
                    </div>
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
        </div>
    </div>
@endsection


@push('scripts')
<script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
<script src="{{ asset('/assets/js/parsley/language-id.js') }}"></script>
<script src="{{ asset('/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js') }}"></script>
<script src="{{ asset('/assets/js/demo/form-wizards-validation.demo.js') }}"></script>
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
