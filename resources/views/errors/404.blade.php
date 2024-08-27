<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kapal Pintar</title>
    <link rel="icon" href="{{ asset('img/1.PNG') }}" />
</head>

<body style="background: rgb(241, 240, 240)">
    <br>
    <br>
    <br>
    <center>
        <div
            style="width: 300px;margin-top:90px;padding:30px;border:solid 1px white;border-radius:30px;background:white;height:300px">
            <img src="{{ asset('lib/assets/logokplpntr.png') }}" alt="" style="width: 300px">
            <h3>HALAMAN YANG ANDA CARI TIDAK ADA</h3>
            <h3>Silakan klik tombol dibawah ini untuk kembali ke beranda</h3>
            <br>
            <br>
            <a href="{{ route('home') }}" style="background: rgb(0, 0, 121);padding:10px;margin-top: 40px;color:white;border-radius:30px;text-decoration:none">
                KEMBALI KE BERANDA
            </a>
        </div>
    </center>
</body>

</html>
