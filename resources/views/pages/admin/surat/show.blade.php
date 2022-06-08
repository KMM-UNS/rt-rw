<form action="{{ route('admin.surat.verifikasi', $surat->id) }}" id="form" name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
    @csrf
    <input type="type" id="status" name="surat_status" class="form-control" autofocus  value="{{ ($surat->status != "4") ? $surat->status + 1 : $surat->status}}">
    <button type="submit" class="btn btn-primary my-2 mx-1"><i class="fa fa-check mr-2" aria-hidden="true"></i>Verifikasi</button>
</form>
<a href="{{ route('admin.surat.cetak', $surat->id) }}">Cetak</a>
