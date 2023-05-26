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
    <br><span>Tanggal/Jam : {{ $gate_checkin_date}} WIB</span>
    <br><span>Nama Operator : {{ $emp_name}}</span>
    <br><span>Nama Truck : {{ $gate_nama_angkutan}}</span>
    <br><span>No Kendaraan : {{ $gate_nomor_plat}}</span>
    <br><span>No. Tanki : {{ $gate_nomor_tangki}}</span>
    <br><span>Alasan Ditolak : {{ $gate_delete_reason}}</span>
    <br>
    <br>
    <p>Jika ingin melihat detail lebih lanjut, dapat dilihat di CMS pada modul Gate Check dengan nomor Referensi : {{ $id }}</p>
    
</body>
</html>