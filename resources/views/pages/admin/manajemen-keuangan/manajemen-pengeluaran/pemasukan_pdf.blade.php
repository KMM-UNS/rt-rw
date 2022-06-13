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
            @foreach ($pengeluarann as $item)
                <tr>
                    <td>{{ $item->keterangan }}</td>
                    <td>Rp.{{ $item->nominal }}</td>
                </tr>
            @endforeach

        </tbody>

        <td><b>Total</b></td>
        <td colspan="1"><b>Rp. {{ $pengeluaran }}</b></td>



    </table>


</body>

</html>
