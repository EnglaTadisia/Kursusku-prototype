<?php
$courseName ='Laravel Fundamental';
$fee =350000;
$participantCount = 2;
$discountPercent = 10;
$adminFee = 25000;
$isActive = true;

$subtotal = $fee * $participantCount;
$discount = intdiv($subtotal * $discountPercent, 100);
$total = $subtotal - $discount + $adminFee;
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator Biaya KursusKu</title>
    <style>
       :root {
            --rose-900: #5b0f3a;
            --rose-700: #be185d;
            --rose-500: #ec4899;
            --rose-200: #fbcfe8;
            --rose-100: #fce7f3;
            --rose-50: #fff1f7;
            --ink: #3b1230;
            --muted: #7a5470;
        }
 
        *, *::before, *::after { box-sizing: border-box; }
 
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: clamp(1rem, 4vw, 3rem);
            font-family: "Plus Jakarta Sans", system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
            line-height: 1.6;
            color: var(--ink);
            background:
                radial-gradient(60rem 30rem at 85% -10%, #ffd6ea 0%, transparent 60%),
                radial-gradient(40rem 25rem at -10% 110%, #ffe4f1 0%, transparent 60%),
                linear-gradient(135deg, #fff5fa 0%, #ffe6f2 100%);
        }
 
        .card {
            width: min(100%, 44rem);
            padding: clamp(1.5rem, 5vw, 2.75rem);
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            border: 1px solid var(--rose-200);
            border-radius: 1.5rem;
            box-shadow: 0 1px 0 #fff inset, 0 24px 48px -24px rgba(190, 24, 93, 0.35);
        }
 
        h1 {
            margin: 0 0 0.9rem;
            font-size: clamp(1.7rem, 5vw, 2.3rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--rose-900);
        }
 
        .course {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.6rem;
            margin: 0 0 1.75rem;
            color: var(--muted);
            font-weight: 500;
        }
 
        .course strong {
            padding: 0.25rem 0.8rem;
            color: var(--rose-700);
            background: var(--rose-50);
            border: 1px solid var(--rose-200);
            border-radius: 999px;
        }
 
        .status {
            padding: 0.25rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 999px;
        }
        .status.active { color: #0f766e; background: #ccfbf1; }
        .status.inactive { color: var(--muted); background: var(--rose-100); }
 
        table {
            width: 100%;
            margin-bottom: 1.75rem;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            background: #fff;
            border: 1px solid var(--rose-200);
            border-radius: 1rem;
        }
 
        th, td { padding: 0.9rem 1.25rem; text-align: left; }
 
        th:last-child, td:last-child {
            text-align: right;
            font-variant-numeric: tabular-nums;
        }
 
        thead th {
            font-size: 0.9rem;
            color: var(--rose-700);
            background: var(--rose-50);
            border-bottom: 1px solid var(--rose-200);
        }
 
        tbody td { border-bottom: 1px solid var(--rose-100); }
        tbody tr:last-child td { border-bottom: 0; }
        tbody td:first-child { color: var(--muted); }
        tbody td:last-child { font-weight: 600; }
        tbody tr:hover td { background: #fffafc; }
 
        .discount td:last-child { color: var(--rose-500); }
 
        .total th, .total td {
            padding-top: 1.15rem;
            padding-bottom: 1.15rem;
            color: #fff;
            background: linear-gradient(135deg, var(--rose-500), var(--rose-700));
        }
        .total th { font-size: 1.05rem; }
        .total td {
            font-size: clamp(1.25rem, 4vw, 1.6rem);
            font-weight: 800;
            letter-spacing: -0.01em;
        }
 
        .button {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            font-weight: 700;
            color: var(--rose-700);
            text-decoration: none;
            background: var(--rose-50);
            border: 1px solid var(--rose-200);
            border-radius: 999px;
            transition: background 0.15s ease, transform 0.15s ease;
        }
        .button:hover { background: var(--rose-100); transform: translateY(-2px); }
        .button:focus-visible { outline: 3px solid var(--rose-900); outline-offset: 3px; }
 
        @media (max-width: 480px) {
            th, td { padding: 0.75rem 0.9rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            .button { transition: none; }
        }
    </style>
</head>
<body>
    <main class="card">
    <h1>Kalkulator Estimasi Biaya</h1>
    <p>Kursus: <strong><?= $courseName ?></strong></p>

    <table>
        <tr><th>Komponen</th><th>Nilai</th></tr>
        <tr><td>Biaya per peserta</td><td>Rp <?= number_format($fee, 0,',','.') ?></td></tr>
    <tr><td>Jumlah peserta</td><td><?= $participantCount ?></td></tr>
    <tr><td>Subtotal</td><td>Rp <?= number_format($subtotal, 0, ', ','.') ?></td></tr>
    <tr><td>Diskon (<?= $discountPercent ?>%)</td><td>- Rp <?=
number_format($discount,0,',',',') ?></td></tr>
    <tr><td>Biaya admin</td><td>Rp <?= number_format($adminFee, 0, ', ','.') ?></td></tr>
    <tr class="total"><td>Total akhir</td><td>Rp <?= number_format($total,0,',','.') ?></
td></tr>
    </table>
<p><a href="index.php">Kembali ke Beranda Kursusku</a></p>
    </main>
</body>
</html>