<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table border="1" cellpadding="2" class="table">
        <thead>
            <tr>
                <th scope="col">Jenis Iuran</th>
                <th scope="col">Penerima</th>
                <th scope="col">Pemberi</th>
                <th scope="col">Image</th>
                <th scope="col">Total Biaya</th>
            </tr>
        </thead>
        @foreach ($rekap as $item)
            @php
                $total_biaya = number_format($item->total_biaya, 2, ',', '.');
            @endphp
            <tbody>
                <tr>
                    <td>{{ $item->iuranwajib->nama }}</td>
                    <td>{{ $item->petugastagihan->nama }}</td>
                    <td>{{ $item->pemberi }}</td>
                    <td> <img src="{{ asset($item->dokumen[0]['public_url']) }}" alt="" class="img-rounded height-80">
                    </td>
                    <td>Rp.{{ $item->total_biaya }}</td>
                </tr>
            </tbody>
        @endforeach
        <td colspan="4">TOTAL</td>
        <td>Rp.{{ $total }}</td>

    </table>
</body>

</html>
