<form action="{{ route('admin.surat.verifikasi', $surat->id) }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="status" name="surat_status" class="form-control" autofocus  value="{{ ($surat->status != "4") ? $surat->status + 1 : $surat->status}}">
    @if($surat->status == '2' && auth()->user()->hasRole('ketua_rt') || $surat->status == '3' && auth()->user()->hasRole('ketua_rw') || $surat->status == '1')
    <div class="row">
        <button type="submit" class="btn btn-primary my-2 ml-3 mr-1"><i class="fa fa-check mr-2" aria-hidden="true"></i>Verifikasi</button>
    </form>
    @endif
    <a href="{{ route('admin.surat.cetak', $surat->id) }}"  class="btn btn-warning my-2 mx-1 {{ ($surat->status != 4) ? 'disabled' : '' }}"><i class="fas fa-print mr-2"></i>Cetak</a>
    </div>
