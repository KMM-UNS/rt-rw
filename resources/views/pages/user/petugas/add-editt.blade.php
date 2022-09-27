@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- begin panel -->
                    <form
                        action="{{ isset($data) ? route('user.petugas-iuran.data-petugas.update', $data->id) : route('user.petugas-iuran.data-petugas.store') }}"
                        id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data))
                            {{ method_field('PUT') }}
                        @endif

                        <div class="panel panel-inverse">
                            <!-- begin panel-heading -->
                            <div class="panel-heading">
                                <h4 class="panel-title">Form @yield('title')</h4>
                                <div class="panel-heading-btn">
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                        data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                        data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                </div>
                            </div>
                            <!-- end panel-heading -->
                            <!-- begin panel-body -->
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" id="warga" name="warga" class="form-control" autofocus data-parsley-required="true" value=" {{ Auth::user()->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_kk">No.KK</label>
                                            <input type="int" id="no_kk" name="no_kk" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->no_kk ?? old('no_kk') }}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_id">user_id</label>
                                            <input type="int" id="user_id" name="user_id" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->user_id ?? old('user_id') }}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="rumah_id">rumah_id</label>
                                            <input type="int" id="rumah_id" name="rumah_id" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->rumah_id ?? old('rumah_id') }}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">No.Telpon</label>
                                            <input type="text" id="telp" name="telp" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->telp ?? old('telp') }}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_tinggal">status_tinggal</label>
                                            <input type="int" id="status_tinggal" name="status_tinggal" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->status_tinggal ?? old('status_tinggal') }}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="createable_id">createable_id</label>
                                            <input type="int" id="createable_id" name="createable_id" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->createable_id ?? old('createable_id') }}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="createable_type">createable_type</label>
                                            <input type="int" id="createable_type" name="createable_type" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->createable_type ?? old('createable_type') }}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pos_tagihan">pos_tagihan</label>
                                            <input type="int" id="pos_tagihan" name="pos_tagihan" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->pos_tagihan ?? old('pos_tagihan') }}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">status</label>
                                            <input type="int" id="status" name="status" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->status ?? old('status') }}}">
                                        </div>

                                    </div>
                                    {{-- <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="foto_iuranwajib">Upload Foto</label>
                                            @php
                                                    $imageSrc = null;
                                                    if(isset($data->dokumen)){
                                                    $imageSrc = $data->dokumen->toArray();
                                                    }
                                                    @endphp
                                                    <div class="row">
                                                        <x-form.ImageUploader :imageSrc="isset($imageSrc) ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'foto_petugas')->first()['public_url']) : null" name="foto_petugas" title="Foto Petugas" value="{{{ $data->dokumen  ?? old('foto_petugas') }}}" />
                                                    </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- end panel-body -->
                        </div>
                        <!-- end panel -->
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>

                    </form>
                    <a href="javascript:history.back(-1);" class="btn btn-success">
                        <i class="fa fa-arrow-circle-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/parsleyjs/dist/parsley.js') }}"></script>
    <script src="{{ asset('/assets/js/custom/string-helper.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#from-datepicker").datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#from-datepicker").on("change", function() {
                var fromdate = $(this).val();
                alert(fromdate);
            });
        });
    </script>
@endpush
