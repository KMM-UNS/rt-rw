
@extends('layouts.user')
@section('title', 'Surat')

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
                <h3>Data Pengajuan Surat</h3>
                <hr>
                <p style="font-size: 14px">Anda belum mengisi data keluarga.</p>
                <a href="{{ route('user.keluarga.create') }}" class="btn btn-primary"><i class="fas fa-pencil-alt fa-fw mr-2"></i>Isi Data Keluarga</a>
            </div>
        </div>
        <!-- end panel -->
    @else
    <div class="panel panel-inverse">
        <div class="panel-body" style="font-size: 14px">
            <h3 class="text-center mb-4">Data Pengajuan Surat</h3>
            <a href="{{ route('user.surat.create') }}" class="btn btn-default mb-2" style="font-size:  14px"><i class="fas fa-envelope fa-fw mr-2"></i>Ajukan Surat</a>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Kode Surat</th>
                        <th>Keperluan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                @foreach ($data as $surat)
                <tbody>
                    <tr>
                        <td class="text-center">{{ $loop->count }}</td>
                        <td>{{ $surat->nomor_surat }}</td>
                        <td>{{ ($surat->keperluan_surat_id == "7") ?  $surat->keterangan : $surat->keperluan_surat->nama }}</td>
                        <td>{{ $surat->tanggal_pengajuan->isoFormat('DD MMMM YYYY') }}</td>
                        <td>{{ $surat->status_surat->nama }}</td>
                        <td class="text-center"><a href="{{ route('user.surat.cetak', $surat->id) }}" class=" {{ ($surat->status != 4) ? 'btn btn-default disabled' : 'btn btn-aqua' }}"><i class="fas fa-download"></i></a></td>
                    </tr>
                </tbody>
                @endforeach
              </table>
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
