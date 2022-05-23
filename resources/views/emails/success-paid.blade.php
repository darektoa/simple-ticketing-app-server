@php $data = $data->data; @endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <header style="width: 100%; background-color: #f79f24; padding: 1rem; display: flex; justify-content: center;">
        <img height="120" src="{{ asset('assets/img/phri-logo.png') }}" alt=" ">
    </header>

    <main style="width: 100%; max-width: 768px; padding: 1rem">
        <div style="margin-bottom: 1rem; padding: 1rem; border-radius: 1rem; background-color: #D4EDDA; width: 100%; display: flex; flex-direction: column; align-items: center;">
            <span style="margin-bottom: .2rem; font-size: 5rem;">✅</span>
            <p style="text-align: center; color: #155724"><b>
                Rp {{ number_format($data->amount) }}<br>
                PEMBAYARAN BERHASIL
            </b></p>
        </div>

        <h2 style="margin-bottom: 2rem;">Kepada {{ $data->receiver->full_name }}</h2>
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
                <td> : {{ $data->destination->destination->name }}</td>
            </tr>
            <tr>
                <th>Addons</th>
                <td> : {{ $data->addon->addon->name ?? '-'}}</td>
            </tr>
        </table>
    
        <h3 style="margin-bottom: 1rem;">Syarat</h3>
        <p class="display: block;">1. Anda harus menunjukan/cetak email konfirmasi ini.</p>
        <p class="display: block;">2. Anda harus menunjukan ID Card anda saat pengambilan Racepack.</p>
        
        <p>Lokasi dan waktu pengambilan racepack akan diinfokan kembali melalui email dan website PHRI BIKE TOUR 2022.</p>
        <p style="display: block; margin: .5rem 0;">Informasi Lebih lanjut kunjungi <a href="https://www.phrionline.com/">https://www.phrionline.com/</a></p>
        <p>Salam hangat,<br>Team PHRI BIKE TOUR 2022</p>
    </main>
</body>
</html>