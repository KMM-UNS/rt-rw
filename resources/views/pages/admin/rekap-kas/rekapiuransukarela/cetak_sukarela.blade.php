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

    <h3 style="font-size: 16px; text-align: center;">LAPORAN IURAN SUKARELA</h1>
        <br>
        <p style="text-align: left;"> Jenis Iuran : {{ $dataa->iuransukarela->nama }}</p>
        <p style="text-align: left;">Periode : {{ date('d M Y', strtotime($tglawal)) }} -
            {{ date('d M Y', strtotime($tglakhir)) }}</h4>

        <table style="width:100%" border="1" cellpadding="2" class="table">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jenis Iuran</th>
                    <th scope="col">Petugas</th>
                    <th scope="col">Pos</th>
                    <th scope="col">Nama Warga</th>
                    <th scope="col">Total Biaya</th>
                </tr>
            </thead>
            @foreach ($data as $item)
                <tbody>
                    <tr>
                        <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                        <td>{{ $item->iuransukarela->nama }}</td>
                        <td>{{ $item->petugastagihan->nama }}</td>
                        <td>{{ $item->postagihansukarela->nama }}</td>
                        <td>{{ $item->warga_sukarela->warga }}</td>
                        <td>Rp. {{ number_format($item->total_biaya, 0) }}</td>
                    </tr>
                </tbody>
            @endforeach
            <td colspan="5">TOTAL</td>
            <td><b>Rp. {{ number_format($total, 0) }}</b></td>

        </table>
</body>

</html>
