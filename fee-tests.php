<?php

declare(strict_types=1);

$tests = [
    ['fee' => 350000, 'participants' => 1, 'discount' => 0, 'admin' => 25000, 'expected' => 375000],
    ['fee' => 350000, 'participants' => 1, 'discount' => 10, 'admin' => 25000, 'expected' => 340000],
    ['fee' => 350000, 'participants' => 2, 'discount' => 25, 'admin' => 25000, 'expected' => 550000],
    ['fee' => 0, 'participants' => 1, 'discount' => 10, 'admin' => 0, 'expected' => 0],
    ['fee' => 2500000, 'participants' => 3, 'discount' => 10, 'admin' => 50000, 'expected' => 6800000],
];

foreach ($tests as $index => $test) {
    $subtotal = $test['fee'] * $test['participants'];
    $discountAmount = intdiv($subtotal * $test['discount'], 100);
    $actual = $subtotal - $discountAmount + $test['admin'];
    $tests[$index]['actual'] = $actual;
    $tests[$index]['status'] = $actual === $test['expected'] ? 'PASS' : 'FAIL';
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>5 Test Case - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
<main class="utility-card wide-card">
    <span class="eyebrow">PENGUJIAN MILESTONE 3</span>
    <h1>FEE TESTS KALKULATOR BIAYA</h1>
    <p>Lima skenario dari panduan diuji dengan perbandingan expected dan actual.</p>
    <div class="table-wrap">
        <table class="course-table test-table">
            <thead>
            <tr><th>No.</th><th>Fee</th><th>Peserta</th><th>Diskon</th><th>Admin</th><th>Expected</th><th>Actual</th><th>Status</th></tr>
            </thead>
            <tbody>
            <?php foreach ($tests as $i => $test): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>Rp <?= number_format($test['fee'], 0, ',', '.') ?></td>
                    <td><?= $test['participants'] ?></td>
                    <td><?= $test['discount'] ?>%</td>
                    <td>Rp <?= number_format($test['admin'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($test['expected'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($test['actual'], 0, ',', '.') ?></td>
                    <td><span class="badge <?= $test['status'] === 'PASS' ? 'badge-available' : 'badge-full' ?>"><?= $test['status'] ?></span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a class="button" href="fee-calculator.php">Kembali ke Kalkulator</a>
</main>
</body>
</html>