<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Laporan</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h2>Data Laporan</h2>
<table>
    <thead>
    <tr>
        <th>No Laporan</th>
        <th>Tanggal Laporan</th>
        <th>Tanggal Hilang</th>
        <th>No Rangka</th>
        <th>No Mesin</th>
        <th>Warna</th>
        <th>Pelapor</th>
        <th>Alamat</th>
        <th>Nomor Telepon</th>
        <th>Deskripsi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($laporan as $data)
        <tr>
            <td>{{ $data->no_laporan }}</td>
            <td>{{ $data->tanggal_laporan }}</td>
            <td>{{ $data->tanggal_hilang }}</td>
            <td>{{ $data->no_rangka }}</td>
            <td>{{ $data->no_mesin }}</td>
            <td>{{ $data->warna }}</td>
            <td>{{ $data->name }}</td>
            <td>{{$data->alamat_pelapor}}</td>
            <td>{{$data->phone_number}}</td>
            <td>{{ $data->deskripsi }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
