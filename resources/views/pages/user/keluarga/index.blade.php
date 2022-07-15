
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
                <p style="font-size: 14px">Anda belum mengisi data keluarga.</p>
                <a href="{{ route('user.keluarga.create') }}" class="btn btn-primary"><i class="fas fa-pencil-alt fa-fw mr-2"></i>Isi Data Keluarga</a>
            </div>
        </div>
        <!-- end panel -->
    @else
        {{-- <div class="panel panel-inverse">
            <div class="panel-body" style="font-size: 14px">
                <h3 class="text-center">Data Keluarga</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6 my-auto">
                        No KK
                    </div>
                    <div class="col-md-6 my-auto">
                        Nama Kepala Keluarga
                    </div>
                </div>
                <div class="row" style="font-size: 20px">
                    <div class="col-md-6">
                        {{ $keluarga['no_kk'] }}
                    </div>
                    <div class="col-md-6">
                        {{ $keluarga['kepala_keluarga'] }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 my-auto">
                        Nomor Rumah
                    </div>
                    <div class="col-md-6 my-auto">
                        Nomor Telepon/HP
                    </div>
                </div>
                <div class="row" style="font-size: 20px">
                    <div class="col-md-6">
                        {{ $keluarga->rumah['nomor_rumah']  }}
                    </div>
                    <div class="col-md-6">
                        {{ $keluarga['telp'] }}
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('user.warga.index') }}" class="btn btn-primary mt-4 mb-2" style="font-size: 14px"><i class="fas fa-eye fa-fw mr-2"></i>Lihat Anggota Keluarga</a>
                </div>
            </div>
        </div> --}}
        <div class="panel panel-inverse">
            <div class="panel-body" style="font-size: 14px">
                <h3 class="text-center">Data Keluarga</h3>
                <hr class="m-0">
                <div class="row mx-4 mt-3">
                    <div class="col-md-6">
                        <div>
                            <label>No KK</label>
                            <p class="font-weight-bold">{{ $keluarga['no_kk'] }}</p>
                        </div>
                        <div>
                            <label>Nama Kepala Keluarga</label>
                            <p class="font-weight-bold">{{ $keluarga['kepala_keluarga'] }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label>Nomor Rumah</label>
                            <p class="font-weight-bold">{{ $keluarga->rumah['nomor_rumah'] }}</p>
                        </div>
                        <div>
                            <label>Nomor Telepon/HP</label>
                            <p class="font-weight-bold">{{ $keluarga['telp'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="text-right">
                    <a href="{{ route('user.keluarga.edit', $keluarga->id) }}" class="btn btn-dark mt-2 mb-2" style="font-size: 12px"><i class="fas fa-edit"></i>Edit</a>
                    <a href="{{ route('user.warga.index') }}" class="btn btn-primary mt-2 mb-2" style="font-size: 12px"><i class="fas fa-eye fa-fw mr-2"></i>Lihat Anggota Keluarga</a>
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
