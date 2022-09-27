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
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Nominal</th>

                </tr>
            </thead>

            <tbody>
                <tr>
                    <td></td>
                    <td>Kas Iuran Wajib</td>
                    <td>Rp. {{ number_format($total_wajib, 0) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kas Iuran Kondisional</td>
                    <td>Rp. {{ number_format($total_kondisional, 0) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kas Iuran Sukarela</td>
                    <td>Rp. {{ number_format($total_sukarela, 0) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kas Iuran Agenda</td>
                    <td>Rp. {{ number_format($total_agenda, 0) }}</td>
                </tr>
                @foreach ($pemasukann as $item)
                    <tr>
                        <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>Rp. {{ number_format($item->nominal, 0) }}</td>
                    </tr>
                @endforeach

            </tbody>

            <td><b>Total</b></td>
            <td></td>
            <td colspan="1"><b>Rp. {{ number_format($pemasukan, 0) }}</b></td>
        </table>
        <div>
            <div class="row">
                <div class="col-5"></div>
                <div class="col-5">
                    <p class="text-center">Mengetahui</p>
                    <p class="text-center">Bendahara</p>
                    <p class="text-center"> <img src="{{ public_path($data['public_url']) }}" alt="Foto Bendahara"
                            width="200">
                    </p>
                    <p class="text-center"> Ayu Sulastri</p>
                </div>

            </div>
        </div>



</body>

</html>
