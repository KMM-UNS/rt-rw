
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
                @if (auth()->user()->email_verified_at == null)
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success text-center" style="font-size:13px;">
                            <strong>
                                Email verifikasi terkirim.
                            </strong>
                        </div>
                    @endif
                <div class="alert alert-danger fade show text-center" style="font-size:13px">
                    <div class="text-center">
                        <h3>Verifikasi E-mail</h3>
                        <p>Silakan cek email Anda atau klik tombol di bawah jika belum mendapatkan email verifikasi.</p>
                    </div>
                    <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                        @csrf
                        <button type="submit" class="btn btn-dark font-weight-normal" style="font-size:13px">Kirim ulang email verifikasi</button>
                    </form>
                </div>
                @else
                <p style="font-size: 14px">Anda belum mengisi data keluarga.</p>
                <a href="{{ route('user.keluarga.create') }}" class="btn btn-primary"><i class="fas fa-pencil-alt fa-fw mr-2"></i>Isi Data Keluarga</a>
                @endif
            </div>
        </div>
    @else
        <div class="panel panel-inverse">
            <div class="panel-body" style="font-size: 14px">
                <h3 class="text-center">Data Keluarga</h3>
                <hr class="m-0">
                @if ($keluarga->verified_at == null)
                @if($keluarga->keterangan != null)
                <div class="alert alert-danger fade show text-center my-2" style="font-size:13px">
                    <div class="text-center">
                        <p class="my-2 font-weight-bold" style="font-size: 14px">Pengajuan akun ditolak.</p>
                        <p class="my-2" style="font-size: 14px">Alasan: {{ $keluarga->keterangan }}</p>
                    </div>
                </div>
                @else
                <div class="alert alert-info fade show text-center my-2" style="font-size:13px">
                    <div class="text-center">
                        <p class="my-2" style="font-size: 14px">Data keluarga sedang dalam proses verifikasi.</p>
                    </div>
                </div>
                @endif
                @endif
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
