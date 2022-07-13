<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1 style="font-size: 16px; text-align: center;">
        RUKUN TETANGGA 01 RUKUN WARGA 01
    </h1>
    <h1 style="font-size: 16px; text-align: center;">
        KELURAHAN JEBRES KECAMATAN JEBRES
    </h1>
    <h1 style="font-size: 16px; text-align: center;">
        KOTA SURAKARTA
    </h1>
    <h4 style="text-align: center; font-weight: normal; margin-bottom: 0;">
        PERUMAHAN SEBELAS MARET, JEBRES, Kec. JEBRES, Kota SURAKARTA, JAWA TENGAH
    </h4>
    <h4 style="text-align: center; font-weight: normal; margin: 0;">
        Telepon: 08988777788 Surel : uns@mail.com Kode Pos : 5612
    </h4>
    <hr style="border: 3px solid; margin-bottom: 1px;">
    <hr style="margin-top: 0;">

    <h3 style="font-size: 16px; text-align: center;">Rekap Kas Iuran </h1>


        <table style="width:100%" border="1" cellpadding="2" class="table">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jenis Iuran</th>
                    <th scope="col">Petugas</th>
                    <th scope="col">Pos</th>
                    <th scope="col">Warga</th>
                    <th scope="col">Total Biaya</th>
                </tr>
            </thead>
            @foreach ($cetakrekapagenda as $item)
                @php
                    $total_biaya = number_format($item->total_biaya, 2, ',', '.');
                @endphp
                <tbody>
                    <tr>
                        {{-- <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                        <td>{{ $item->iuranagenda->nama }}</td>
                        <td>{{ $item->petugas }}</td>
                        <td>{{ $item->pos }}</td>
                        <td>{{ $item->warga_agenda->warga }}</td>
                        <td>Rp.{{ $item->total_biaya }}</td> --}}
                        <td>banyak</td>
                        <td>banyak</td>
                        <td>banyak</td>
                        <td>banyak</td>
                        <td>banyak</td>
                    </tr>
                </tbody>
            @endforeach
            <td colspan="5">TOTAL</td>
            {{-- <td>Rp.{{ $total }}</td> --}}

        </table>


</body>

</html>
