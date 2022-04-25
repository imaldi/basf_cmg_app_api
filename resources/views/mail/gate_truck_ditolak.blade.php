<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>BASF Truck Apps - Form Masuk Ditolak</p>
    <br><span>Tanggal/Jam : {{ $data->created_at}} WIB</span>
    <br><span>Nama Operator : </span>
    <br><span>Nama Truck : {{ $data->gate_nama_angkutan}}</span>
    <br><span>No Kendaraan : {{ $data->gate_nomor_plat}}</span>
    <br><span>No. Tanki : {{ $data->gate_nomor_tangki}}</span>
    <br><span>Alasan Ditolak : </span>
    <br>
    <br>
    <p>Jika ingin melihat detail lebih lanjut, dapat dilihat di CMS pada modul Gate Check dengan nomor Referensi : {{ $data->id}}</p>
    
</body>
</html>