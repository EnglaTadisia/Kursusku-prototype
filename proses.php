
<?php

session_start();

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

// Halaman hanya boleh diakses melalui POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

// =====================================
// AMBIL DATA FORM
// =====================================
$name            = trim($_POST['name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$courseCode      = $_POST['course_code'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$learningMode    = $_POST['learning_mode'] ?? '';
$packageCount    = (int) ($_POST['package_count'] ?? 1);
$notes           = trim($_POST['notes'] ?? '');
$interests       = $_POST['interests'] ?? [];

if (!is_array($interests)) {
    $interests = [];
}

// Hanya terima minat yang ada di daftar
$interests = array_values(array_intersect($interests, array_keys($interestOptions)));

// =====================================
// VALIDASI
// =====================================
$errors = [];

if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}

$course = findCourse($courses, $courseCode);

if ($course === null) {
    $errors[] = 'Kursus tidak ditemukan.';
}

if (!in_array($participantType, ['mahasiswa', 'guru', 'umum'], true)) {
    $errors[] = 'Tipe peserta tidak valid.';
}

if (!in_array($learningMode, ['offline', 'online', 'hybrid'], true)) {
    $errors[] = 'Metode belajar tidak valid.';
}

if (!in_array($packageCount, [1, 2, 3], true)) {
    $errors[] = 'Jumlah paket tidak valid.';
}

// =====================================
// KOMPONEN TAMPILAN (header & footer)
// =====================================
function renderHead(string $title): void
{
    ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?> - KursuKu</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
:root {
    --pink: #e91e63;
    --pink-dark: #c2185b;
    --pink-soft: #fde4ee;
    --pink-bg: #fff5f9;
    --text: #444;
}

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
}
.tagline {
    margin-left: auto;
    font-style: italic;
    font-size: 14px;
    color: var(--pink-dark);
    text-align: left;
}

/* PAGE */
.page { padding: 20px; }
.wrapper {
    max-width: 1240px;
    margin: 0 auto;
    background: #fff;
    border-radius: 18px;
    padding: 34px;
    box-shadow: 0 6px 24px rgba(233, 30, 99, .08);
}

/* BANNER */
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
    font-size: 30px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 0 0 8px rgba(233, 30, 99, .15);
}
.banner-error { background: #fff0f0; border-color: #f3b9b9; }
.banner-error h1, .banner-error p { color: #b71c1c; }
.banner-error .banner-icon { background: #d32f2f; }

/* GRID */
.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 26px;
}
.box {
    border: 1px solid #f8c8da;
    border-radius: 14px;
    padding: 22px 26px;
    background: #fff;
}
.box h2 {
    display: flex;
    align-items: center;
    gap: 14px;
    margin: 0 0 16px;
    font-size: 20px;
    color: var(--pink-dark);
}
.icon {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: var(--pink);
    color: #fff;
    font-size: 16px;
    display: flex; align-items: center; justify-content: center;
}

/* TABEL DETAIL */
.detail { border-collapse: collapse; width: 100%; }
.detail td { padding: 7px 0; vertical-align: top; }
.detail td:nth-child(1) { width: 150px; color: #777; }
.detail td:nth-child(2) { width: 24px; color: #777; }

/* TOTAL */
.total {
    display: flex;
    gap: 16px;
    align-items: center;
    margin-top: 14px;
    padding: 14px 18px;
    background: var(--pink-soft);
    border-radius: 10px;
    color: var(--pink-dark);
    font-weight: 600;
}
.total span:first-child { width: 134px; }
.total strong { font-size: 24px; }

.list { margin: 0; padding-left: 20px; }
.muted { color: #999; margin: 0; }
.error-list { margin: 0; padding-left: 20px; color: #b71c1c; }

/* TOMBOL */
.actions { display: flex; gap: 14px; margin-top: 26px; }
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
    .grid { grid-template-columns: 1fr; }
    .actions { flex-direction: column; }
}

    </style>
</head>
<body>

<header class="topbar">
    <a href="index.php" class="brand">🎓 KursusKu</a>

    <nav class="menu">
        <a href="index.php">🏠 Beranda</a>
        <a href="catalog.php">📖 Katalog</a>
        <a href="register.php">👤 Daftar</a>
    </nav>

    <div class="tagline">
        Belajar Hari Ini,<br>
        Untuk Masa Depan yang Lebih Baik
    </div>
</header>

<main class="page">
    <div class="wrapper">
    <?php
}

function renderFoot(): void
{
    ?>
    </div>
</main>

</body>
</html>
    <?php
}

// =====================================
// JIKA DATA TIDAK VALID
// =====================================
if ($errors !== []) {
    renderHead('Data Belum Valid');
    ?>
    <div class="banner banner-error">
        <div class="banner-icon">!</div>
        <div>
            <h1>Data Belum Dapat Diproses</h1>
            <p>Mohon periksa kembali data yang Anda masukkan:</p>
        </div>
    </div>

    <div class="box">
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <a href="register.php" class="btn">← Kembali ke Formulir</a>
    <?php
    renderFoot();
    exit;
}

// =====================================
// PERHITUNGAN BIAYA
// =====================================
$discountPercent   = getDiscountPercent($participantType);
$grossTotal        = $course['fee'] * $packageCount;
$discountAmount    = intdiv($grossTotal * $discountPercent, 100);
$finalTotal        = $grossTotal - $discountAmount;
$learningModeLabel = getLearningModeLabel($learningMode);
$learningModeLabel = getLearningModeLabel($learningMode);

// SIMPAN KE HISTORY
$_SESSION['registrations'][] = [
    'name'   => $name,
    'course' => $course['name'],
    'total'  => $finalTotal,
];
// =====================================
// TAMPILAN RINGKASAN
// =====================================
renderHead('Ringkasan Pendaftaran');
?>

<!-- BANNER SUKSES -->
<div class="banner">
    <div class="banner-icon">✓</div>
    <div>
        <h1>Pendaftaran Berhasil Diproses</h1>
        <p>Data pendaftaran kursus Anda telah berhasil kami terima. Berikut adalah rincian pendaftaran Anda:</p>
    </div>
</div>

<div class="grid">

    <!-- INFORMASI PESERTA -->
    <section class="box">
        <h2><span class="icon">👤</span> Informasi Peserta</h2>

        <table class="detail">
            <tr><td>Nama</td>          <td>:</td> <td><?= e($name) ?></td></tr>
            <tr><td>Email</td>         <td>:</td> <td><?= e($email) ?></td></tr>
            <tr><td>Kursus</td>        <td>:</td> <td><?= e($course['name']) ?></td></tr>
            <tr><td>Tipe peserta</td>  <td>:</td> <td><?= e($participantType) ?></td></tr>
            <tr><td>Metode</td>        <td>:</td> <td><?= e($learningModeLabel) ?></td></tr>
            <tr><td>Jumlah paket</td>  <td>:</td> <td><?= e((string) $packageCount) ?></td></tr>
        </table>
    </section>

    <!-- RINCIAN BIAYA -->
    <section class="box">
        <h2><span class="icon">$</span> Rincian Biaya</h2>

        <table class="detail">
            <tr>
                <td>Subtotal</td><td>:</td>
                <td><?= Rupiah($grossTotal) ?></td>
            </tr>
            <tr>
                <td>Diskon</td><td>:</td>
                <td><?= $discountPercent ?>% (<?= Rupiah($discountAmount) ?>)</td>
            </tr>
        </table>

        <div class="total">
            <span>Total akhir</span>
            <span>:</span>
            <strong><?= Rupiah($finalTotal) ?></strong>
        </div>
    </section>

    <!-- MINAT PEMBELAJARAN -->
    <section class="box">
        <h2><span class="icon">📖</span> Minat Pembelajaran</h2>

        <?php if ($interests === []): ?>
            <p class="muted">Belum memilih minat.</p>
        <?php else: ?>
            <ul class="list">
                <?php foreach ($interests as $interest): ?>
                    <li><?= e($interestOptions[$interest] ?? $interest) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

    <!-- CATATAN -->
    <section class="box">
        <h2><span class="icon">📄</span> Catatan</h2>

        <?php if ($notes !== ''): ?>
            <p><?= nl2br(e($notes)) ?></p>
        <?php else: ?>
            <p class="muted">Tidak ada catatan.</p>
        <?php endif; ?>
    </section>

</div>

<!-- TOMBOL -->
<div class="actions">
    <a href="index.php" class="btn">← Kembali ke Beranda</a>
    <a href="register.php" class="btn">Daftar Kursus Lagi</a>
</div>

<?php renderFoot(); ?>