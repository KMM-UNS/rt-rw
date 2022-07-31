<div class="button">
    <a href="#modal-tolak" class="btn btn-sm btn-danger fw-normal float-right" data-toggle="modal" style="font-size: 13px"><i class="fa fa-times mr-2"></i> Tolak</a>
    <a href="#modal-verifikasi" class="btn btn-sm btn-primary fw-normal float-right mx-2" data-toggle="modal" style="font-size: 13px"><i class="fa fa-check mr-2" aria-hidden="true"></i> Verifikasi</a>
</div>


 {{-- begin modal verifikasi --}}
 <div class="modal fade" id="modal-verifikasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Verifikasi Surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.surat.verifikasi', $surat->id) }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
                    @csrf
                    Dengan ini Anda menyetujui jika surat ini valid.
                    Apakah Anda yakin?
                    <hr>
                    <div class="float-right">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tidak</a>
                        <button type="submit" class="btn btn-primary">Ya</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end modal verifikasi --}}
{{-- begin modal tolak --}}
<div class="modal fade" id="modal-tolak">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tolak Surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.surat.tolak', $surat->id) }}" method="POST" name="form-wizard" class="form-control-with-bg"  data-parsley-validate="true" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control w-100" name="surat_alasan" id="alasan" placeholder="Tulis alasan ditolak" required>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end modal tolak --}}
