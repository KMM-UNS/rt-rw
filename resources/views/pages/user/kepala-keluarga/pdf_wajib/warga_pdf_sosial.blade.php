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

    <h1 style="font-size: 16px; text-align: center;">LAPORAN IURAN WAJIB</h1>

    <p style="text-align: left;">Periode : {{ date('M Y', strtotime($warga1->tanggal)) }}</p>


    <table class="table table-bordered">
        <thead class="alert-info">
            <tr>
                <th scope="col">No KK</th>
                <th scope="col">Nama Warga</th>
                <th scope="col">Pos</th>
                <th scope="col">Nomor Warga</th>
                <th scope="col">Tanggal Pembayaran</th>
                <th scope="col">Nominal</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($warga as $item)
                <tr>
                    {{-- <td>{{ $item->iuranwajib->jenis_iuran_id }}</td> --}}
                    <td>{{ $item->no_kk }}</td>
                    <td>{{ $item->warga }}</td>
                    <td>{{ $item->pos->nama }}</td>
                    <td>{{ $item->telp }}</td>

                    <td>
                        @foreach ($item->warga_wajib->where('jenis_iuran_id', 7) as $j)
                            <p>{{ date('d M Y', strtotime($j->tanggal)) }}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item->warga_wajib->where('jenis_iuran_id', 7) as $i)
                            <p>Rp. {{ number_format($j->total_biaya, 0) }}</p>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            <td colspan="5">TOTAL</td>
            <td><b>Rp. {{ number_format($total, 0) }}</b></td>


        </tbody>
    </table>
    <div>
        <div class="row">
            <div class="col-10">
                <p class="text-center">Mengetahui</p>
                <p class="text-center">Petugas Tagihan</p>
                <p class="text-center"> <img src="{{ public_path($data['public_url']) }}" alt="Foto Petugas"
                        width="200">
                </p>
                <p class="text-center"> {{ Auth::user()->name }}</p>

            </div>

        </div>
    </div>

</body>

</html>
