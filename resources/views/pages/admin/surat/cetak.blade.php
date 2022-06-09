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
            RUKUN TETANGGA 001 RUKUN WARGA XXI
        </h1>
        <h1 style="font-size: 16px; text-align: center;">
            KELURAHAN JEBRES KECAMATAN JEBRES
        </h1>
        <h1 style="font-size: 16px; text-align: center;">
            KOTA SURAKARTA
        </h1>
        <h4 style="text-align: center; font-weight: normal; margin-bottom: 0;">
            Jl. Ir. Sutami No.36, Kentingan, Kec. Jebres, Kota Surakarta, Jawa Tengah
        </h4>
        <h4 style="text-align: center; font-weight: normal; margin: 0;">
            Telepon: (0271) 646994 Surel : campus@mail.uns.ac.id       Kode Pos : 57126
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
            Ketua RT-001 / RW-XXI Kelurahan Jebres Kecamatan Jebres Kota Surakarta, menerangkan bahwa ;
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
                <td>: {{$surat->warga->keluarga->rumah->alamat }} No.{{$surat->warga->keluarga->rumah->nomor_rumah }} RT-001/RW-XXI Kelurahan Jebres Kecamatan Jebres Kota Surakarta</td>
            </tr>
        </table>
        <p>
            Bahwa benar nama tersebut diatas adalah penduduk / warga yang berdomisili diwilayah Ketua RT-001 / RW-XXI Kelurahan Jebres Kecamatan Jebres Kota Surakarta, Surat pengantar ini diberikan untuk keperluan :
        </p>
        <p>
            <strong>
                {{ $surat->keperluan_surat->nama }}
            </strong>
        </p>
        <p>
            Demikian Surat Keterangan ini kami buat dengan sebenar-benarnya untuk digunakan sebagaimana mestinya.
        </p>
        <div class="row">
            <div class="column">
                <p style="justify-self: center;margin: 0.5cm 0 0 0;">Mengetahui,</p>
                <p style="justify-self: center;margin: 2.5cm 0 0 0;"> <u>Nama</u></p>
                <p style="justify-self: center;margin-top: 0;">Ketua RW XXI</p>
            </div>
            <div class="column">
                <p style="justify-self: center;">Surakarta, {{ $surat->tanggal_pengajuan->isoFormat('DD MMMM YYYY') }} </p>
                <p style="justify-self: center;"></p>
                <p style="justify-self: center;margin: 2.5cm 0 0 0;"> <u>Nama</u></p>
                <p style="justify-self: center;margin-top: 0;">Ketua RT 01</p>
            </div>
        </div>
</body>
</html>
