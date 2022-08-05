<h5 class="my-2 text-center">Detail Warga Meninggal</h5>
<table class="table table-bordered my-2">
    <tr>
        <th>Waktu Meninggal</th>
        <td>{{ $warga->waktu->isoFormat('DD MMMM YYYY H:mm z') ?? '-' }}</td>
    </tr>
    <tr>
        <th>Penyebab</th>
        <td>{{ $warga->penyebab ?? '-' }}</td>
    </tr>
    <tr>
        <th>Tempat Pemakaman</th>
        <td>{{ $warga->tempat_pemakaman ?? '-' }}</td>
    </tr>
</table>
