@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                   <!-- begin panel -->
<form action="{{ isset($data) ? route('admin.kas-rt.kas-iuranwajib.update', $data->id) : route('admin.kas-rt.kas-iuranwajib.store') }}" id="form" name="form" method="POST" data-parsley-validate="true"  enctype="multipart/form-data">
    @csrf
    @if(isset($data))
    {{ method_field('PUT') }}
    @endif

    <div class="panel panel-inverse">
      <!-- begin panel-heading -->
      <div class="panel-heading">
        <h4 class="panel-title">Form @yield('title')</h4>
        <div class="panel-heading-btn">
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                <label for="name">WOI</label>
                <input type="text" id="pemberi" name="kas_iuran_wajibs_pemberi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->pemberi ?? old('kas_iuran_wajibs_pemberi') }}}">
                {{-- <x-form.Dropdown name="kas_iuran_wajibs_jenis_iuran_id" :options="$jenis_iuranwajib" selected="{{{ old('kas_iuran_wajibs_jenis_iuran_id') ?? ($data['jenis_iuran_id'] ?? null) }}}" required /> --}}
                </div>
                <div class="form-group">
                <label for="bulan">Bulan</label>
                <input type="text" id="pemberi" name="kas_iuran_wajibs_pemberi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->pemberi ?? old('kas_iuran_wajibs_pemberi') }}}">
                {{-- <x-form.Dropdown name="kas_iuran_wajibs_bulan" :options="$nama_bulan" selected="{{{ old('kas_iuran_wajibs_bulan') ?? ($data['bulan'] ?? null) }}}" required /> --}}
                </div>
                <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" id="pemberi" name="kas_iuran_wajibs_pemberi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->pemberi ?? old('kas_iuran_wajibs_pemberi') }}}">
                {{-- <x-form.Dropdown name="kas_iuran_wajibs_tahun" :options="$tahun" selected="{{{ old('kas_iuran_wajibs_tahun') ?? ($data['tahun'] ?? null) }}}" required /> --}}
                </div>
                <div class="form-group">
                <label for="petugas">Penerima</label>
                <input type="text" id="pemberi" name="kas_iuran_wajibs_pemberi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->pemberi ?? old('kas_iuran_wajibs_pemberi') }}}">
                {{-- <x-form.Dropdown name="kas_iuran_wajibs_petugas" :options="$nama_petugas" selected="{{{ old('kas_iuran_wajibs_petugas') ?? ($data['petugas'] ?? null) }}}" required /> --}}
                </div>
                <div class="form-group">
                <label for="pemberi">Pemberi</label>
                <input type="text" id="pemberi" name="kas_iuran_wajibs_pemberi" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->pemberi ?? old('kas_iuran_wajibs_pemberi') }}}">
                </div>
                <div class="form-group">
                <label for="total_biaya">Total Biaya</label>
                <input type="text" id="total_biaya" name="kas_iuran_wajibs_total_biaya" class="form-control" autofocus data-parsley-required="true" value="{{{ $data->total_biaya ?? old('kas_iuran_wajibs_total_biaya') }}}">
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="form-group ">
                    <label for="foto_iuranwajib">Bukti Pembayaran</label>
                    {{-- <input type="file" id="foto_iuranwajib" name="foto_iuranwajib" class="form-control @error('image') is-invalid @enderror" autofocus data-parsley-required="true"> --}}
                    @php
                            $imageSrc = null;
                            if(isset($data->dokumen)){
                            $imageSrc = $data->dokumen->toArray();
                            }
                            @endphp
                            <div class="row">
                                <x-form.ImageUploader :imageSrc="isset($imageSrc) ? asset(DataHelper::filterDokumenData($imageSrc, 'nama', 'foto_iuranwajib')->first()['public_url']) : null" name="foto_iuranwajib" title="Foto Kondisional" value="{{{ $data->dokumen  ?? old('foto_iuranwajib') }}}" />
                            </div>
                </div>
            </div>
        </div>
      </div>
      <!-- end panel-body -->
      <!-- begin panel-footer -->
      <div class="panel-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-default">Reset</button>
      </div>
      <!-- end panel-footer -->
    </div>
    <!-- end panel -->
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
