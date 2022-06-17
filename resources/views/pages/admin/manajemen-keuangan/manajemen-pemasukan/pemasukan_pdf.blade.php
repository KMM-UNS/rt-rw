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

    <h3 style="font-size: 16px; text-align: center;">LAPORAN PEMASUKAN</h1>


        <table style="width:100%" border="1" cellpadding="2" class="table">
            <thead>
                <tr>
                    <th scope="col">Nominal</th>
                    <th scope="col">Keterangan</th>

                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Kas Iuran Wajib</td>
                    <td>Rp.{{ $total_wajib }}</td>
                </tr>
                <tr>
                    <td>Kas Iuran Kondisional</td>
                    <td>Rp.{{ $total_kondisional }}</td>
                </tr>
                <tr>
                    <td>Kas Iuran Sukarela</td>
                    <td>Rp.{{ $total_sukarela }}</td>
                </tr>
                <tr>
                    <td>Kas Iuran Agenda</td>
                    <td>Rp.{{ $total_agenda }}</td>
                </tr>
                @foreach ($pemasukann as $item)
                    <tr>
                        <td>{{ $item->keterangan }}</td>
                        <td>Rp.{{ $item->nominal }}</td>
                    </tr>
                @endforeach

            </tbody>

            <td><b>Total</b></td>
            <td colspan="1"><b>Rp. {{ $pemasukan }}</b></td>



        </table>


</body>

</html>
