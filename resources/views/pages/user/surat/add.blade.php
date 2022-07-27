
@extends('layouts.user')
@section('title', 'Surat')

@push('css')
<link href="{{ asset('/assets/plugins/smartwizard/dist/css/smart_wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/default/style.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="panel panel-inverse">
        <div class="panel-body">
        <h3 class="text-center">Formulir Pengajuan<br> Surat Pengantar</h3>
        <hr>
        <form action="{{ route('user.surat.store') }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
            @csrf
            @if(isset($data))
            {{ method_field('PUT') }}
            @endif
            <!-- begin wizard -->
            <div class="row ">
                <div class="col-xl ui-sortable">
                    <div class="panel panel-inverse">
                        <!-- begin panel-body -->
                        <div class="panel-body d-flex justify-content-center">
                            <div class="col-9 form-group my-auto">
                                <div class="col-md my-auto">
                                    <label class="mt-2" for="warga_id"><strong>Warga</strong></label>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <x-form.Dropdown name="surat_warga_id" :options="$warga" selected="{{{ old('surat_warga_id') ?? ($data['warga_id'] ?? null) }}}" required />
                                    </div>
                                </div>
                                <div class="col-md my-auto">
                                <label class="mt-2" for="surat_keperluan_surat_id"><strong>Keperluan</strong></label>
                            </div>
                            <div class="col-md">
                                <div class="input-group">
                                    <x-form.Dropdown name="surat_keperluan_surat_id" :options="$keperluan_surat" onchange="suratChange()" selected="{{{ old('surat_keperluan_surat_id') ?? ($data['keperluan_surat_id'] ?? null) }}}" required />
                                </div>
                            </div>
                            <div class="col-md mt-2">
                                <div class="input-group">
                                    <input type="text" id="keterangan" name="surat_keterangan" class="form-control" autofocus  placeholder="Tuliskan disini. . ." value="{{{ old('surat_keterangan') ?? ($data['keterangan'] ?? null) }}}" style="display: none;">
                                </div>
                                <input type="hidden" id="status" name="surat_status_surat_id" class="form-control" value="1">
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
<script>
    function suratChange() {
    var keperluanSurat = document.getElementById("surat_keperluan_surat_id");
    var keterangan = document.getElementById("keterangan");

        // if lainnya dipilih
        if (keperluanSurat.value == "7"){
            keterangan.style.display = "block";
        }
        else {
            keterangan.style.display = "none";
        }
    }
</script>
@endpush
