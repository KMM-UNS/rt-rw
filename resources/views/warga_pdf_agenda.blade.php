<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>


    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <h5 class="card-title  text-center">TANDA BUKTI PEMBAYARAN</h5>
            <p class="card-text  text-center">RUKUN TETANGGA 01 RUKUN WARGA 01</p>
            <hr style="margin-top: 0;">


            @php
                $status1 = $warga->where('jenis_iuran_id', 1);
                $status2 = $warga->where('jenis_iuran_id', 2);

            @endphp

            <p>Sudah terima dari Bapak/Ibu <b>{{ $wargaa->warga_agenda->warga }}</b></p>
            <p>Keterangan pembayaran:</p>
            @foreach ($status1 as $item)
                <table align="">

                    <tr>
                        <td width="100"></td>
                        <td width="">Jenis Iuran</td>
                        <td width=""> :</td>
                        <td>{{ $item->iuranagenda->nama }}</td>
                    </tr>
                    <tr>
                        <td width="100"></td>
                        <td width="">Nominal</td>
                        <td width=""> :</td>
                        <td> Rp {{ number_format($item->total_biaya, 0) }}</td>
                    </tr>
                    <tr>
                        <td width="100"></td>
                        <td width="">Tanggal Pembayaran</td>
                        <td width=""> :</td>

                        <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                    </tr>
                </table>
            @endforeach
            <br><br>
            @foreach ($status2 as $item2)
                <table align="">

                    <tr>
                        <td width="100"></td>
                        <td width="">Jenis Iuran</td>
                        <td width=""> :</td>
                        <td>{{ $item2->iuranagenda->nama }}</td>
                    </tr>
                    <tr>
                        <td width="100"></td>
                        <td width="">Nominal</td>
                        <td width=""> :</td>
                        <td> Rp {{ number_format($item2->total_biaya, 0) }}</td>
                    </tr>
                    <tr>
                        <td width="100"></td>
                        <td width="">Tanggal Pembayaran</td>
                        <td width=""> :</td>

                        <td>{{ date('d M Y', strtotime($item2->tanggal)) }}</td>
                    </tr>
                </table>
            @endforeach
            <br>
            <div>
                <div class="row">
                    <div class="col-10">
                        <p class="text-center">Petugas Tagihan</p>
                        <p class="text-center"> <img src="{{ public_path($data['public_url']) }}" alt="Foto Petugas"
                                width="200">
                        <p class="text-center">{{ $wargaa->petugastagihan->nama }}</p>
                    </div>

                </div>
            </div>

        </div>
        <div class="card-footer text-muted">

        </div>
        {{-- </div> --}}
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
