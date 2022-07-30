@extends('layouts.user')
@section('title', 'Warga')

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
                <h3>Data Anggota Keluarga</h3>
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
        <!-- end panel -->
    @elseif($keluarga->verified_at == null)
    <div class="panel panel-inverse">
        <div class="panel-body mx-3 text-center">
            <h3>Data Anggota Keluarga</h3>
            <hr>
            @if($keluarga->keterangan != null)
            <div class="alert alert-danger fade show text-center my-2" style="font-size:13px">
                <div class="text-center">
                    <p class="my-2 font-weight-bold" style="font-size: 14px">Pengajuan akun ditolak.</p>
                    <p class="my-2" style="font-size: 14px">Alasan: {{ $keluarga->keterangan }}</p>
                    <p class="my-2" style="font-size: 14px">Silakan <a class="text-danger" href="{{ route('user.keluarga.edit', $keluarga->id) }}">ubah data</a>  Anda.</p>
                </div>
            </div>
            @else
            <div class="alert alert-info fade show text-center my-2" style="font-size:13px">
                <div class="text-center">
                    <p class="my-2" style="font-size: 14px">Data keluarga sedang dalam proses verifikasi.</p>
                </div>
            </div>
            @endif
            {{-- <p style="font-size: 14px">Data keluarga sedang dalam proses verifikasi.</p> --}}
        </div>
    </div>
    @else
    <div class="panel panel-inverse">
        <div class="panel-body" style="font-size: 14px">
            <h3 class="text-center mb-4">Data Anggota Keluarga</h3>
            <a href="{{ route('user.warga.create') }}" class="btn btn-default mb-2" style="font-size:  14px"><i class="fas fa-user-plus fa-fw mr-2"></i>Tambah Anggota Keluarga</a>
            <table class="table table-responsive table-bordered d-sm-table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Foto</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Status dalam Keluarga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                @foreach ($data as $wargaKey => $warga)
                <tbody>
                  <tr>
                    <td class="text-center">{{ $wargaKey + 1 }}</td>
                    <td class="with-img text-center">
                        {{-- {{ $warga->dokumen[0]['public_url'] }} --}}
                        @foreach ($warga['dokumen'] as $dokumen)

                        {{-- image --}}
                        <img src="{{ asset($warga->dokumen->first()['public_url']) }}" class="img-rounded height-70" data-toggle="modal" data-target="#exampleModal" style="
                            object-fit: cover;
                            border-radius: 50%;
                            width: 70px;
                            height: 70px;"
                            >
                        @endforeach
                    </div>
                    </td>
                    <td>
                        {{ $warga->nik }}
                    </td>
                    <td>
                        {{ $warga->nama }}
                    </td>
                    <td>
                        {{ $warga->status_keluarga->nama }}
                    </td>
                    <!-- with button -->
                    <td class="with-btn text-center">
                        <a href="{{ route('user.warga.show', $warga->id) }}" class="btn btn-aqua buttons-delete"><i class="fas fa-eye fa-fw"></i></a>
                        {{-- <a href="{{ route('user.warga.edit', $warga->id) }}" class="btn btn-dark buttons-edit"><i class="fas fa-edit fa-fw"></i></a> --}}
                        {{-- <a href="{{ route('user.warga.destroy', $warga->id) }}" class="btn btn-danger buttons-delete"><i class="fas fa-trash fa-fw"></i></a> --}}
                    </td>
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
