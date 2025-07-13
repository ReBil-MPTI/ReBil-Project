<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        window.onload = () => window.print()
    </script>
    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
            max-width: 600px;
            margin: auto;
        }

        .divider {
            border-top: 1px solid #ddd;
            margin: 1rem 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin: 0.3rem 0;
        }
    </style>
</head>

<body>

    <div style="text-align: center;">
        <div style="width: 64px; height: 64px; margin: auto; background-color: #ccc; border-radius: 50%;">
            <i class="bi bi-check2" style="font-size: 32px; line-height: 64px; display: inline-block;"></i>
        </div>
        <h2 style="margin-top: 10px;">Pembayaran berhasil!</h2>
        <h1>IDR {{ number_format($transaction->total_payment, 0, ',', '.') }}</h1>
    </div>

    <div class="divider"></div>

    <div class="info-row">
        <span>Nomor Pemesanan</span>
        <span>{{ $transaction->noref }}</span>
    </div>
    <div class="info-row">
        <span>Waktu Pembayaran</span>
        <span>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y, H:i') }}</span>
    </div>
    <div class="info-row">
        <span>Metode Pembayaran</span>
        <span>Bank Transfer</span>
    </div>
    <div class="info-row">
        <span>Nama Pemesan</span>
        <span>{{ $transaction->user->name }}</span>
    </div>

    <div class="divider" style="border-style: dashed;"></div>

    <div class="info-row" style="font-weight: bold;">
        <span>Total Harga</span>
        <span>IDR {{ number_format($transaction->total_payment, 0, ',', '.') }}</span>
    </div>
    <p style="font-size: 12px; margin-top: 4px;">*Sudah termasuk PPN</p>
</body>

</html>
