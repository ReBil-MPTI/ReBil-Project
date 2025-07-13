<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @media print {
            body {
                width: 148mm;
                height: 210mm;
                margin: 0 auto;
            }
        }

        body {
            font-family: sans-serif;
            padding: 2rem;
            max-width: 600px;
            margin: auto;
            position: relative;
        }

        body::before {
            content: "VERIFIED";
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 5rem;
            font-weight: bold;
            color: rgba(211, 255, 16, 0.805);
            white-space: nowrap;
            pointer-events: none;
            z-index: 0;
        }

        .divider {
            border-top: 1px solid #000;
            margin: 1rem 0;
        }

        .dashed-divider {
            border-top: 2px dashed #000;
            margin: 1rem 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin: 0.3rem 0;
        }

        .content {
            position: relative;
            z-index: 1;
        }

        .text-center {
            text-align: center;
        }
    </style>
    <script>
        window.onload = () => window.print();
    </script>
</head>

<body>
    <div class="content">
        <div class="text-center">
            <i class="bi bi-check2" style="font-size: 28px;"></i>
            <h2 style="margin: 10px 0;">Pembayaran berhasil!</h2>
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

        <div class="dashed-divider"></div>

        <div class="info-row" style="font-weight: bold;">
            <span>Total Harga</span>
            <span>IDR {{ number_format($transaction->total_payment, 0, ',', '.') }}</span>
        </div>
        <p style="font-size: 12px; margin-top: 4px;">*Sudah termasuk PPN</p>
    </div>
</body>

</html>
