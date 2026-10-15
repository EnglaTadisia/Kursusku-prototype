<?php
$rawName = ' Laravel Fundamental ';
$cleanName = trim($rawName);
$upperName = strtoupper($cleanName);
$lowerName = strtolower($cleanName);
$length = strlen($cleanName);
$short = substr($cleanName, 0, 7);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>String Test</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
<main class="utility-card">
    <h1>String Function Test</h1>

    <p class="string-source">
        Teks awal (tanda kurung siku menunjukkan spasi di awal dan akhir)
        <code>[<?= htmlspecialchars($rawName) ?>]</code>
    </p>

    <ul class="result-list">
        <li><code>trim()</code> <strong><?= htmlspecialchars($cleanName) ?></strong></li>
        <li><code>strtoupper()</code> <strong><?= htmlspecialchars($upperName) ?></strong></li>
        <li><code>strtolower()</code> <strong><?= htmlspecialchars($lowerName) ?></strong></li>
        <li><code>strlen()</code> <strong><?= $length ?></strong></li>
        <li><code>substr()</code> <strong><?= htmlspecialchars($short) ?></strong></li>
    </ul>

    <a class="button" href="index.php">Kembali</a>
</main>
</body>
</html>