<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 16px;
        }

        * {
            box-sizing: border-box;
            }


        .column-image {
            float: left;
            width: 70%;
            padding: 10px;
            height: 4cm;
            }

        .column {
            float: left;
            width: 30%;
            padding: 10px;
            height: 4cm;
            }

            /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
            }

        table {
            table-layout: auto;
            width: 100%;
            }

        .float-right {
            float: right;
        }

        /* Create two equal columns that floats next to each other */
        .column {
        float: left;
        width: 50%;
        padding: 10px;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
    </style>
</head>
<body>
        <h1 style="font-size: 16px; text-align: center;">
            RUKUN TETANGGA {{ strtoupper($app->rt) }} RUKUN WARGA {{ strtoupper($app->rw) }}
        </h1>
        <h1 style="font-size: 16px; text-align: center;">
            KELURAHAN {{ strtoupper($app->kelurahan->name) }} KECAMATAN {{ strtoupper($app->kecamatan->name) }}
        </h1>
        <h1 style="font-size: 16px; text-align: center;">
            {{ strtoupper($app->kabupaten->name) }}
        </h1>
        <h4 style="text-align: center; font-weight: normal; margin-bottom: 0;">
            {{ strtoupper($app->nama) }}, {{ $app->kelurahan->name }}, KEC. {{ $app->kecamatan->name }}, {{ $app->kabupaten->name }}, {{ $app->provinsi->name }}
        </h4>
        <h4 style="text-align: center; font-weight: normal; margin: 0;">
            TELEPON: {{ $app->telepon }} SUREL: {{ $app->email }}     KODE POS: {{ $app->kode_pos }}
        </h4>
        <hr style="border: 3px solid; margin-bottom: 1px;">
        <hr style="margin-top: 0;">
        <h1 style="font-size: 16px; text-align: center;">
            SURAT PENGANTAR
        </h1>
        <h4 style="text-align: center; font-weight: normal;">
            No : {{ $surat->nomor_surat }}
        </h4>
        <p>
            Ketua RT-{{ $app->rt }} / RW-{{ $app->rw }}, Kelurahan {{ ucwords(strtolower($app->kelurahan->name)) }}, Kecamatan {{ ucwords(strtolower($app->kecamatan->name)) }}, {{ ucwords(strtolower($app->kabupaten->name)) }}, menerangkan bahwa
        </p>
        <table>
            <tr>
                <td>Nama Lengkap </td>
                <td>: {{$surat->warga->nama}}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ Str::ucfirst($surat->warga->jenis_kelamin)}}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>: {{$surat->warga->tempat_lahir}}, {{$surat->warga->tanggal_lahir->isoFormat('DD MMMM YYYY')}}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: {{$surat->warga->agama->nama }}</td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td>: {{$surat->warga->warga_negara->nama }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: {{$surat->warga->pekerjaan->nama}}</td>
            </tr>
            <tr>
                <td>No. KTP / KK</td>
                <td>: {{ $surat->warga->nik }} / {{ $surat->warga->keluarga->no_kk }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{$surat->warga->alamat }} </td>
            </tr>
        </table>
        <p>
            Bahwa benar nama tersebut diatas adalah penduduk / warga yang berdomisili diwilayah RT-{{ $app->rt }} / RW-{{ $app->rw }}, Kelurahan {{ ucwords(strtolower($app->kelurahan->name)) }}, Kecamatan {{ ucwords(strtolower($app->kecamatan->name)) }}, {{ ucwords(strtolower($app->kabupaten->name)) }}, Surat pengantar ini diberikan untuk keperluan :
        </p>
        <p>
            <strong>
                {{ $surat->keperluan_surat_id != 7 ? $surat->keperluan_surat->nama : $surat->keterangan }}
            </strong>
        </p>
        <p>
            Demikian Surat Keterangan ini kami buat dengan sebenar-benarnya untuk digunakan sebagaimana mestinya.
        </p>
        <div class="row">
            <div class="column" style="text-align:center;">
                <p style="justify-self: center;margin: 1cm 0 0 0;">Mengetahui,</p>
                <img src="{{ asset($ttd_rw->first()['public_url']) }}" alt="ttd_rw" style= "width: 50%; height: 2.5cm;">
                <p style="justify-self: center;margin: 0 0 0 0;"> <u>{{ $app->ketua_rw }}</u></p>
                <p style="justify-self: center;margin-top: 0;">Ketua RW {{ $app->rw }}</p>
            </div>
            <div class="column" style="text-align:center;">
                <p style="justify-self: center;">{{ str_replace("Kabupaten", "",ucwords(strtolower($app->kabupaten->name))) }}, {{ $surat->tanggal_disetujui->isoFormat('DD MMMM YYYY') }} </p>
                    <img src="{{ asset($ttd_rt->first()['public_url']) }}" alt="ttd_rw" style="width: 50%; height: 2.5cm;">
                <p style="justify-self: center;margin: 0 0 0 0;"> <u>{{ $app->ketua_rt }}</u></p>
                <p style="justify-self: center;margin-top: 0;">Ketua RT {{ $app->rt }}</p>
            </div>
        </div>
</body>
</html>
