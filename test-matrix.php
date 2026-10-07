<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Test Matrix - KursusKu UIN</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #ffeef6;
            color: #3d0f26;
        }

        /* =========================
           NAVBAR
        ========================= */

        nav {
            height: 80px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
            box-shadow: 0 3px 15px rgba(212, 18, 107, 0.08);
        }

        .logo {
            color: #d4126b;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            gap: 35px;
        }

        .nav-menu a {
            text-decoration: none;
            color: #8f2a5c;
            font-size: 15px;
            font-weight: 600;
            transition: 0.2s;
        }

        .nav-menu a:hover {
            color: #d4126b;
        }

        /* =========================
           BACKGROUND
        ========================= */

        .page {
            min-height: calc(100vh - 80px);

            background:
                linear-gradient(
                    135deg,
                    #ffe0ee 0%,
                    #ffffff 50%,
                    #ffd6e8 100%
                );

            padding: 60px 30px;
        }

        /* =========================
           CARD
        ========================= */

        .container {
            max-width: 1150px;
            margin: auto;

            background: #ffffff;

            border-radius: 22px;

            padding: 40px;

            box-shadow:
                0 15px 40px rgba(212, 18, 107, 0.10);
        }

        /* =========================
           HEADER
        ========================= */

        .label {
            color: #d4126b;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        h1 {
            color: #3d0f26;
            font-size: 34px;
            margin-bottom: 10px;
        }

        .description {
            color: #9a5476;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* =========================
           TABLE
        ========================= */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;

            border: 1px solid #f5b5d3;

            border-radius: 14px;

            overflow: hidden;
        }

        thead {
            background: #fbc4de;
        }

        th {
            padding: 16px 14px;

            text-align: left;

            font-size: 12px;

            color: #8a0a4a;

            font-weight: 700;

            border-bottom: 1px solid #f09cc4;
        }

        td {
            padding: 15px 14px;

            font-size: 13px;

            color: #4a1a32;

            background: #ffffff;

            border-bottom: 1px solid #f9d0e3;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover td {
            background: #ffe6f1;
        }

        /* =========================
           NOMOR
        ========================= */

        th:first-child,
        td:first-child {
            width: 55px;
            text-align: center;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-block;

            padding: 6px 12px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: bold;

            background: #e7f8ed;

            color: #249653;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            text-align: center;

            margin-top: 30px;

            color: #a8527a;

            font-size: 12px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            nav {
                height: auto;
                padding: 20px;

                flex-direction: column;

                gap: 20px;
            }

            .nav-menu {
                gap: 15px;

                flex-wrap: wrap;

                justify-content: center;
            }

            .page {
                padding: 30px 15px;
            }

            .container {
                padding: 25px 15px;
            }

            h1 {
                font-size: 27px;
            }

            th,
            td {
                padding: 12px 10px;

                font-size: 12px;
            }
        }
    </style>
</head>

<body>

<!-- =========================
     NAVBAR
========================= -->

<nav>

    <div class="logo">
        KursusKu UIN
    </div>

    <div class="nav-menu">

        <a href="index.php">
            Beranda
        </a>

        <a href="register.php">
            Daftar Kursus
        </a>

        <a href="history.php">
            History
        </a>

        <a href="test-matrix.php">
            Test Matrix
        </a>

    </div>

</nav>


<!-- =========================
     CONTENT
========================= -->

<div class="page">

    <div class="container">

        <div class="label">
            EVIDENCE WEEK 06
        </div>

        <h1>
            Test Matrix Pertemuan 6
        </h1>

        <p class="description">
            Hasil pengujian fitur pendaftaran kursus KursusKu UIN.
        </p>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>NO</th>
                        <th>SKENARIO</th>
                        <th>ACTUAL</th>
                        <th>EXPECTED</th>
                        <th>STATUS</th>
                    </tr>

                </thead>


                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Mahasiswa, Web Dasar, 1 paket</td>
                        <td>Rp 240.000</td>
                        <td>Rp 240.000</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Guru, PHP Dasar, 1 paket</td>
                        <td>Rp 340.000</td>
                        <td>Rp 340.000</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Umum, Laravel Dasar, 1 paket</td>
                        <td>Rp 500.000</td>
                        <td>Rp 500.000</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>Mahasiswa, Web Dasar, 2 paket</td>
                        <td>Rp 480.000</td>
                        <td>Rp 480.000</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td>Nama kosong</td>
                        <td>Nama wajib diisi.</td>
                        <td>Nama wajib diisi.</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>6</td>
                        <td>Email tidak valid</td>
                        <td>Email tidak valid.</td>
                        <td>Email tidak valid.</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>7</td>
                        <td>Minat kosong</td>
                        <td>Belum memilih minat.</td>
                        <td>Belum memilih minat.</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>8</td>
                        <td>3 minat</td>
                        <td>Frontend, Backend, Database</td>
                        <td>Frontend, Backend, Database</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>9</td>
                        <td>Metode offline</td>
                        <td>Tatap Muka</td>
                        <td>Tatap Muka</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>10</td>
                        <td>Metode hybrid</td>
                        <td>Hybrid</td>
                        <td>Hybrid</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>11</td>
                        <td>GET process.php</td>
                        <td>Redirect ke register.php</td>
                        <td>Redirect ke register.php</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                    <tr>
                        <td>12</td>
                        <td>Tambah fasilitas</td>
                        <td>Dirender otomatis dengan foreach</td>
                        <td>Dirender otomatis dengan foreach</td>
                        <td><span class="status">PASS</span></td>
                    </tr>

                </tbody>

            </table>

        </div>


        <div class="footer">
            KursusKu UIN &copy; <?= date('Y') ?>
        </div>

    </div>

</div>

</body>
</html>