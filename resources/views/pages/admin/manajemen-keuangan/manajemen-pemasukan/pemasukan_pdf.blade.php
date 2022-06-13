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
