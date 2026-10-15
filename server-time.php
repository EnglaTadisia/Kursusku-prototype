<?php

declare(strict_types=1);

$serverTime = date('Y-m-d H:i:s');
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Waktu Server - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
<main class="utility-card">
    <span class="eyebrow">PERTEMUAN 2</span>
    <h1>PHP Diproses oleh Server</h1>
    <p class="server-time">Waktu server: <strong><?= htmlspecialchars($serverTime) ?></strong></p>
    <p>Refresh halaman beberapa detik kemudian. Nilai berubah karena fungsi <code>date()</code> dijalankan ulang oleh PHP pada setiap request.</p>
    <a class="button" href="index.php">Kembali ke Beranda</a>
</main>
</body>
</html>