<h5 class="my-2 text-center">Detail Warga Pindah</h5>
<table class="table table-bordered my-2">
    <tr>
        <th>Alamat Tujuan</th>
        <td>{{ $warga->alamat_tujuan ?? '-' }}</td>
    </tr>
    <tr>
        <th>Tanggal Pindah</th>
        <td>{{ $warga->tanggal_pindah->isoFormat('DD MMMM YYYY') ?? '-' }}</td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>{{ $warga->keterangan ?? '-' }}</td>
    </tr>
</table>
