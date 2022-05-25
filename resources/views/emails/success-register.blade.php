@php 
    use Carbon\Carbon;
    $data        = $data->data;
    $destination = $data->destination->destination;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <header style="width: 100%; background-color: #FFD238; overflow: auto; padding: 1rem">
        <div style="width: 100%; overflow: auto; max-width: 768px">
            <img style="float: left;" height="100" src="{{ asset('assets/img/phri-logo.png') }}" alt=" ">
            <h1 style="float: right; line-height: 100px">UNPAID</h1>
        </div>
    </header>

    <main style="width: 100%; max-width: 768px; padding: 1rem; text-align: left;">
        <h2 style="margin-top: 1rem; margin-bottom: 2rem;">Kepada {{ $data->receiver->full_name }}</h2>
        <h3 style="margin-bottom: 1rem;">Biodata</h3>
        <table style="margin-bottom: 2rem;">
            <tr>
                <th>Nomer Registrasi</th>
                <td> : {{ $data->code }}</td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td> : {{ $data->receiver->full_name }}</td>
            </tr>
            <tr>
                <th>Nomor ID Card</th>
                <td> : {{ $data->receiver->detail['id_card_number'] }}</td>
            </tr>
            <tr>
                <th>No. Handphone</th>
                <td> : {{ $data->receiver->phone }}</td>
            </tr>
            <tr>
                <th>Kota Yang Diikuti</th>
                <td> : {{ $destination->name }} ({{ Carbon::make($destination->start_at)->format('d M Y') }} - {{ Carbon::make($destination->end_at)->format('d M Y') }})</td>
            </tr>
            <tr>
                <th>Addons</th>
                <td> : {{ $data->addon->addon->name ?? '-'}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td> : {{ strtoupper('Menunggu Pembayaran') }}</td>
            </tr>
            <tr>
                <th>Total Tagihan</th>
                <td> : {{ $data->amount }}</td>
            </tr>
        </table>
    
        <h3 style="margin-bottom: .75rem;">Syarat</h3>
        <ol type="1" style="margin-bottom: 1rem; padding: 0;">
            <li>Silahkan melakukan pembayaran melalui link berikut ini {{ $data->detail['invoices']['pending']['invoice_url'] }}</li>
            <li>Pastikan nominal pembayaran sesuai dan pilih metode pembayaran</li>
            <li>Pembayaran akan otomatis terverifikasi dan bukti pembayaran akan dikirimkan via email</li>
            <li>Jika sudah selesai melakukan pembayaran anda bisa cek nomer registrasi pada link berikut ini https://phri.socyolo.com/verify/bikers-event</li>
        </ol>
        
        <p>Lokasi dan waktu pengambilan racepack akan diinfokan kembali melalui email dan website PHRI BIKE TOUR 2022.</p>
        <p style="display: block; margin: 1rem 0;">Informasi Lebih lanjut kunjungi <a href="https://www.phrionline.com/"><b>https://www.phrionline.com/</b></a></p>
        <p>Salam hangat,<br>Team PHRI BIKE TOUR 2022</p>
    </main>
</body>
</html>