<?php

session_start();
require __DIR__ . '/helpers.php';

$dataAwal = [
    ['name' => 'Alya',  'course' => 'Web Dasar',     'total' => 240000],
    ['name' => 'Bima',  'course' => 'PHP Dasar',     'total' => 340000],
    ['name' => 'Citra', 'course' => 'Laravel Dasar', 'total' => 500000],
];

$pendaftarBaru = $_SESSION['registrations'] ?? [];

$history = array_merge($dataAwal, $pendaftarBaru);

$grandTotal = array_sum(array_column($history, 'total'));

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pendaftaran - KursuKu</title>

    <style>
        :root {
            --pink: #e91e63;
            --pink-dark: #c2185b;
            --pink-soft: #fde4ee;
            --pink-bg: #fff5f9;
            --text: #444;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--text);
            background: linear-gradient(180deg, #fff 0%, var(--pink-bg) 100%);
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            align-items: center;
            gap: 40px;
            padding: 20px 80px;
            background: var(--pink-bg);
        }
        .brand {
            font-size: 28px;
            font-weight: 700;
            color: var(--pink-dark);
            text-decoration: none;
        }
        .menu { display: flex; gap: 30px; }
        .menu a {
            color: var(--pink-dark);
            text-decoration: none;
            font-weight: 500;
            padding-bottom: 4px;
        }
        .menu a.active { border-bottom: 3px solid var(--pink); }
        .tagline {
            margin-left: auto;
            font-style: italic;
            font-size: 14px;
            color: var(--pink-dark);
        }

        /* KONTEN */
        .page { padding: 20px; }
        .wrapper {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            border-radius: 18px;
            padding: 34px;
            box-shadow: 0 6px 24px rgba(233, 30, 99, .08);
        }

        .banner {
            display: flex;
            align-items: center;
            gap: 20px;
            background: var(--pink-soft);
            border: 1px solid #f8c8da;
            border-radius: 14px;
            padding: 22px 26px;
            margin-bottom: 26px;
        }
        .banner h1 { margin: 0 0 6px; font-size: 28px; color: var(--pink-dark); }
        .banner p  { margin: 0; color: var(--pink-dark); }
        .banner-icon {
            width: 58px; height: 58px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--pink);
            color: #fff;
            font-size: 28px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 0 8px rgba(233, 30, 99, .15);
        }

        /* TABEL */
        .table-box {
            border: 1px solid #f8c8da;
            border-radius: 14px;
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: var(--pink);
            color: #fff;
            text-align: left;
            padding: 14px 18px;
            font-weight: 600;
        }
        tbody td {
            padding: 14px 18px;
            border-bottom: 1px solid #fbe0ea;
        }
        tbody tr:nth-child(even) { background: var(--pink-bg); }
        tbody tr:hover { background: var(--pink-soft); }
        tbody tr:last-child td { border-bottom: none; }

        .col-no    { width: 70px; text-align: center; }
        .col-total { text-align: right; white-space: nowrap; }
        thead .col-no { text-align: center; }
        thead .col-total { text-align: right; }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            background: var(--pink-soft);
            color: var(--pink-dark);
            font-size: 14px;
            font-weight: 500;
        }

        tfoot td {
            padding: 16px 18px;
            background: var(--pink-soft);
            color: var(--pink-dark);
            font-weight: 700;
        }
        tfoot .col-total { font-size: 18px; }

        /* TOMBOL */
        .actions { margin-top: 26px; display: flex; gap: 14px; }
        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: var(--pink);
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: background .2s;
        }
        .btn:hover { background: var(--pink-dark); }

        @media (max-width: 800px) {
            .topbar { flex-wrap: wrap; padding: 16px; gap: 14px; }
            .tagline { display: none; }
            .wrapper { padding: 18px; }
            .table-box { overflow-x: auto; }
        }
    </style>
</head>
<body>

<header class="topbar">
    <a href="index.php" class="brand">🎓 KursusKu</a>

    <nav class="menu">
        <a href="index.php">🏠 Beranda</a>
        <a href="register.php">👤 Daftar Kursus</a>
        <a href="history.php" class="active">🕘 History</a>
    </nav>

    <div class="tagline">
        Belajar Hari Ini,<br>
        Untuk Masa Depan yang Lebih Baik
    </div>
</header>

<main class="page">
    <div class="wrapper">

        <div class="banner">
            <div class="banner-icon">🕘</div>
            <div>
                <h1>History Pendaftaran</h1>
                <p>Daftar peserta yang telah mendaftar kursus di KursusKu.</p>
            </div>
        </div>

        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th>Nama</th>
                        <th>Kursus</th>
                        <th class="col-total">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($history as $i => $row): ?>
                        <tr>
                            <td class="col-no"><?= $i + 1 ?></td>
                            <td><?= e($row['name']) ?></td>
                            <td><span class="badge"><?= e($row['course']) ?></span></td>
                            <td class="col-total"><?= Rupiah($row['total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3">Total Keseluruhan</td>
                        <td class="col-total"><?= Rupiah($grandTotal) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="actions">
            <a href="index.php" class="btn">← Kembali ke Beranda</a>
            <a href="register.php" class="btn">+ Daftar Kursus</a>
        </div>

    </div>
</main>

</body>
</html>