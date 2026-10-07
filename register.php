<?php
require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';
?>

<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar Kursus - KursusKu UIN</title>

    <link rel="stylesheet" href="assets/css/style.css">

    <style>

        /* =====================================================
           RESET & DASAR
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family:
                "Inter",
                "Segoe UI",
                Arial,
                sans-serif;

            background: #fff7fb;

            color: #4a2338;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        header {
            background: #e0237a;

            border-bottom: none;

            box-shadow:
                0 4px 15px rgba(224, 35, 122, 0.15);
        }

        nav {
            max-width: 1200px;

            margin: auto;

            min-height: 70px;

            padding: 0 25px;

            display: flex;

            align-items: center;

            gap: 25px;
        }

        nav a {
            color: #ffffff;

            text-decoration: none;

            font-size: 14px;

            font-weight: 500;

            transition: 0.2s;
        }

        nav a:hover {
            color: #ffe4f0;
        }

        nav a:first-child {
            margin-right: auto;

            color: #ffffff;

            font-size: 19px;
        }

        nav a:last-child {
            background: #ffffff;

            color: #c21868;

            padding: 10px 16px;

            border-radius: 8px;

            font-weight: 600;
        }

        nav a:last-child:hover {
            background: #fde7f2;

            color: #a91558;
        }


        /* =====================================================
           CONTAINER UTAMA
        ===================================================== */

        .register-wrapper {
            max-width: 1150px;

            margin: 55px auto;

            padding: 0 20px;
        }


        /* =====================================================
           JUDUL HALAMAN
        ===================================================== */

        .page-title {
            margin-bottom: 35px;
        }

        .page-title .badge {
            display: inline-block;

            background: #fce0ed;

            color: #c21868;

            padding: 7px 14px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 700;

            margin-bottom: 13px;
        }

        .page-title h1 {
            margin: 0 0 10px;

            font-size: 38px;

            line-height: 1.2;

            color: #831843;
        }

        .page-title p {
            margin: 0;

            color: #70445a;

            font-size: 15px;
        }


        /* =====================================================
           LAYOUT
        ===================================================== */

        .register-layout {
            display: grid;

            grid-template-columns: 340px 1fr;

            gap: 25px;

            align-items: start;
        }


        /* =====================================================
           PANEL KIRI - PINK
        ===================================================== */

        .info-panel {
            background:
                linear-gradient(
                    145deg,
                    #e0237a 0%,
                    #d91f73 55%,
                    #c21868 100%
                );

            color: white;

            border-radius: 20px;

            padding: 30px;

            position: sticky;

            top: 25px;

            overflow: hidden;

            box-shadow:
                0 15px 35px rgba(192, 24, 104, 0.20);
        }


        /* Lingkaran dekorasi */

        .info-panel::before {
            content: "";

            position: absolute;

            width: 190px;

            height: 190px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.10);

            right: -75px;

            top: -65px;
        }

        .info-panel::after {
            content: "";

            position: absolute;

            width: 140px;

            height: 140px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.08);

            left: -65px;

            bottom: -45px;
        }


        .info-content {
            position: relative;

            z-index: 2;
        }


        /* =====================================================
           ICON
        ===================================================== */

        .university-icon {
            width: 58px;

            height: 58px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                rgba(255, 255, 255, 0.18);

            border-radius: 16px;

            font-size: 27px;

            margin-bottom: 25px;

            box-shadow:
                0 5px 15px rgba(0, 0, 0, 0.08);
        }


        /* =====================================================
           TEXT PANEL KIRI
        ===================================================== */

        .info-panel h2 {
            margin: 0 0 12px;

            font-size: 25px;

            line-height: 1.3;

            color: #ffffff;
        }

        .info-panel > .info-content > p {
            color: #ffe5f0;

            line-height: 1.7;

            font-size: 14px;

            margin-bottom: 30px;
        }


        /* =====================================================
           LIST FASILITAS
        ===================================================== */

        .info-list {
            list-style: none;

            padding: 0;

            margin: 0;
        }

        .info-list li {
            display: flex;

            gap: 12px;

            align-items: flex-start;

            margin-bottom: 19px;

            color: #fff1f7;

            font-size: 13px;

            line-height: 1.5;
        }

        .check {
            flex-shrink: 0;

            width: 25px;

            height: 25px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.18);

            color: white;

            font-weight: bold;

            font-size: 13px;
        }


        /* =====================================================
           HELP BOX
        ===================================================== */

        .help-box {
            margin-top: 30px;

            padding-top: 25px;

            border-top:
                1px solid
                rgba(255, 255, 255, 0.22);
        }

        .help-box strong {
            display: block;

            margin-bottom: 5px;

            font-size: 14px;

            color: white;
        }

        .help-box span {
            color: #ffe5f0;

            font-size: 12px;

            line-height: 1.5;
        }


        /* =====================================================
           FORM CARD
        ===================================================== */

        .form-card {
            background: #ffffff;

            border:
                1px solid
                #f1d7e4;

            border-radius: 20px;

            padding: 35px;

            box-shadow:
                0 15px 40px
                rgba(190, 24, 93, 0.07);
        }


        /* =====================================================
           FORM HEADER
        ===================================================== */

        .form-heading {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;

            padding-bottom: 20px;

            border-bottom:
                1px solid
                #f5e3eb;
        }

        .form-heading h2 {
            margin: 0 0 5px;

            font-size: 20px;

            color: #4a2338;
        }

        .form-heading p {
            margin: 0;

            color: #a18492;

            font-size: 13px;
        }

        .required-info {
            color: #a18492;

            font-size: 12px;
        }

        .required-info span {
            color: #e11d48;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .form-group {
            margin-bottom: 21px;
        }

        .form-row {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 18px;
        }

        label,
        legend {
            color: #5b394b;

            font-size: 13px;

            font-weight: 700;
        }

        label {
            display: block;

            margin-bottom: 7px;
        }

        .required {
            color: #e11d48;
        }


        /* =====================================================
           INPUT
        ===================================================== */

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;

            padding: 12px 14px;

            border:
                1px solid
                #ead5df;

            border-radius: 9px;

            background: #fffafd;

            color: #4a2338;

            font-family: inherit;

            font-size: 14px;

            transition: 0.2s;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        textarea::placeholder {
            color: #bba5b0;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            outline: none;

            background: #ffffff;

            border-color: #e0237a;

            box-shadow:
                0 0 0 3px
                rgba(224, 35, 122, 0.10);
        }

        textarea {
            resize: vertical;

            min-height: 100px;
        }


        /* =====================================================
           FIELDSET
        ===================================================== */

        fieldset {
            border:
                1px solid
                #ead5df;

            border-radius: 12px;

            padding: 20px;

            margin: 0 0 21px;

            background: #fffafd;
        }

        legend {
            padding: 0 8px;

            color: #c21868;
        }


        /* =====================================================
           RADIO BUTTON
        ===================================================== */

        .radio-options {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 10px;

            margin-top: 5px;
        }

        .radio-option {
            position: relative;
        }

        .radio-option input {
            position: absolute;

            opacity: 0;
        }

        .radio-option label {
            margin: 0;

            padding: 12px 8px;

            text-align: center;

            border:
                1px solid
                #ead5df;

            border-radius: 8px;

            background: white;

            color: #806675;

            cursor: pointer;

            font-weight: 500;

            transition: 0.2s;
        }

        .radio-option label:hover {
            border-color: #f3a6c7;

            background: #fff5fa;
        }

        .radio-option input:checked + label {
            border-color: #e0237a;

            background: #fff0f6;

            color: #c21868;

            font-weight: 700;

            box-shadow:
                0 0 0 2px
                rgba(224, 35, 122, 0.07);
        }


        /* =====================================================
           MINAT BELAJAR
        ===================================================== */

        .interest-options {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 9px;

            margin-top: 5px;
        }

        .interest-option {
            display: flex;

            align-items: center;

            gap: 9px;

            padding: 11px;

            border:
                1px solid
                #ead5df;

            border-radius: 8px;

            color: #806675;

            background: white;

            cursor: pointer;

            font-weight: 500;

            transition: 0.2s;
        }

        .interest-option:hover {
            background: #fff5fa;

            border-color: #f3a6c7;
        }

        .interest-option input {
            accent-color: #e0237a;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .submit-button {
            width: 100%;

            border: none;

            padding: 15px;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #e0237a,
                    #c21868
                );

            color: white;

            font-family: inherit;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.2s;

            margin-top: 5px;

            box-shadow:
                0 8px 20px
                rgba(224, 35, 122, 0.20);
        }

        .submit-button:hover {
            background:
                linear-gradient(
                    135deg,
                    #d61f73,
                    #a91558
                );

            transform: translateY(-2px);

            box-shadow:
                0 12px 25px
                rgba(194, 24, 104, 0.25);
        }

        .submit-button:active {
            transform: translateY(0);
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            text-align: center;

            padding: 25px;

            color: #a18492;

            font-size: 12px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            nav {
                flex-wrap: wrap;

                padding: 15px 20px;

                gap: 12px 18px;
            }

            nav a:first-child {
                width: 100%;

                margin-right: 0;
            }

            .register-layout {
                grid-template-columns: 1fr;
            }

            .info-panel {
                position: relative;

                top: 0;
            }

        }


        @media (max-width: 600px) {

            .register-wrapper {
                margin: 30px auto;
            }

            .page-title h1 {
                font-size: 28px;
            }

            .form-card {
                padding: 22px;
            }

            .form-row {
                grid-template-columns: 1fr;

                gap: 0;
            }

            .radio-options {
                grid-template-columns: 1fr;
            }

            .interest-options {
                grid-template-columns: 1fr;
            }

            .form-heading {
                display: block;
            }

            .required-info {
                display: block;

                margin-top: 8px;
            }

            nav a:not(:first-child) {
                font-size: 12px;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<header>

    <nav aria-label="Navigasi utama">

        <a href="index.php">
            <strong>KursusKu UIN</strong>
        </a>

        <a href="index.php#keunggulan">
            Keunggulan
        </a>

        <a href="index.php#katalog">
            Katalog
        </a>

        <a href="index.php#alur">
            Cara Daftar
        </a>

        <a href="index.php#kontak">
            Kontak
        </a>
        <a href="registration.php#Form P5">
            Form P5
        </a>

        <a href="register.php">
            Daftar P6
        </a>

        <a href="history.php">
            History Dummy
        </a>

    </nav>

</header>


<!-- =====================================================
     MAIN
===================================================== -->

<main class="register-wrapper">


    <!-- JUDUL -->

    <section class="page-title">

        <span class="badge">
            PROGRAM KURSUS UIN
        </span>

        <h1>
            Pendaftaran Kursus
        </h1>

        <p>
            Lengkapi data diri Anda untuk mengikuti
            program pembelajaran pilihan.
        </p>

    </section>


    <!-- =================================================
         LAYOUT KIRI + KANAN
    ================================================= -->

    <div class="register-layout">


        <!-- =================================================
             PANEL KIRI
        ================================================= -->

        <aside class="info-panel">

            <div class="info-content">


                <div class="university-icon">
                    🎓
                </div>


                <h2>
                    Belajar untuk berkembang.
                </h2>


                <p>
                    Bergabunglah dalam program kursus
                    KursusKu UIN dan tingkatkan kemampuan
                    Anda bersama pengajar berpengalaman.
                </p>


                <!-- FASILITAS -->

                <ul class="info-list">

                    <?php foreach ($facilities as $facility): ?>

                        <li>

                            <span class="check">
                                ✓
                            </span>

                            <span>
                                <?= e($facility) ?>
                            </span>

                        </li>

                    <?php endforeach; ?>

                </ul>


                <!-- BANTUAN -->

                <div class="help-box">

                    <strong>
                        Butuh bantuan?
                    </strong>

                    <span>
                        Hubungi admin KursusKu UIN
                        untuk informasi lebih lanjut.
                    </span>

                </div>


            </div>

        </aside>


        <!-- =================================================
             FORM KANAN
        ================================================= -->

        <section class="form-card">


            <div class="form-heading">

                <div>

                    <h2>
                        Data Pendaftaran
                    </h2>

                    <p>
                        Isi informasi dengan data yang benar.
                    </p>

                </div>


                <div class="required-info">

                    <span>*</span>
                    Wajib diisi

                </div>

            </div>


            <!-- FORM -->

            <form
                method="POST"
                action="proses.php"
            >


                <!-- NAMA + EMAIL -->

                <div class="form-row">


                    <div class="form-group">

                        <label for="name">

                            Nama lengkap

                            <span class="required">
                                *
                            </span>

                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            placeholder="Nama lengkap"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="email">

                            Email

                            <span class="required">
                                *
                            </span>

                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="nama@email.com"
                            required
                        >

                    </div>


                </div>


                <!-- KURSUS -->

                <div class="form-group">

                    <label for="course_code">

                        Pilih kursus

                        <span class="required">
                            *
                        </span>

                    </label>


                    <select
                        id="course_code"
                        name="course_code"
                        required
                    >

                        <option value="">
                            -- Pilih kursus --
                        </option>


                        <?php foreach ($courses as $course): ?>

                            <option
                                value="<?= e($course['code']) ?>"
                            >

                                <?= e($course['name']) ?>

                                -

                                <?= rupiah($course['fee']) ?>

                            </option>

                        <?php endforeach; ?>


                    </select>

                </div>


                <!-- TIPE PESERTA -->

                <fieldset>

                    <legend>
                        Tipe peserta
                    </legend>


                    <div class="radio-options">


                        <div class="radio-option">

                            <input
                                type="radio"
                                id="mahasiswa"
                                name="participant_type"
                                value="mahasiswa"
                                required
                            >

                            <label for="mahasiswa">
                                Mahasiswa
                            </label>

                        </div>


                        <div class="radio-option">

                            <input
                                type="radio"
                                id="guru"
                                name="participant_type"
                                value="guru"
                            >

                            <label for="guru">
                                Guru
                            </label>

                        </div>


                        <div class="radio-option">

                            <input
                                type="radio"
                                id="umum"
                                name="participant_type"
                                value="umum"
                            >

                            <label for="umum">
                                Umum
                            </label>

                        </div>


                    </div>

                </fieldset>


                <!-- MINAT -->

                <fieldset>

                    <legend>
                        Minat belajar
                    </legend>


                    <div class="interest-options">


                        <?php foreach ($interestOptions as $value => $label): ?>

                            <label class="interest-option">

                                <input
                                    type="checkbox"
                                    name="interests[]"
                                    value="<?= e($value) ?>"
                                >

                                <?= e($label) ?>

                            </label>

                        <?php endforeach; ?>


                    </div>

                </fieldset>


                <!-- METODE + PAKET -->

                <div class="form-row">


                    <div class="form-group">

                        <label for="learning_mode">

                            Metode belajar

                            <span class="required">
                                *
                            </span>

                        </label>


                        <select
                            id="learning_mode"
                            name="learning_mode"
                            required
                        >

                            <option value="">
                                -- Pilih metode --
                            </option>

                            <option value="offline">
                                Tatap muka
                            </option>

                            <option value="online">
                                Online
                            </option>

                            <option value="hybrid">
                                Hybrid
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="package_count">

                            Jumlah paket

                            <span class="required">
                                *
                            </span>

                        </label>


                        <select
                            id="package_count"
                            name="package_count"
                            required
                        >

                            <?php for ($i = 1; $i <= 3; $i++): ?>

                                <option value="<?= $i ?>">
                                    <?= $i ?> paket
                                </option>

                            <?php endfor; ?>

                        </select>

                    </div>


                </div>


                <!-- CATATAN -->

                <div class="form-group">

                    <label for="notes">
                        Catatan tambahan
                    </label>


                    <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        maxlength="300"
                        placeholder="Tuliskan catatan tambahan..."
                    ></textarea>

                </div>


                <!-- TOMBOL -->

                <button
                    type="submit"
                    class="submit-button"
                >

                    Daftar Sekarang →

                </button>


            </form>


        </section>


    </div>

</main>


<!-- =====================================================
     FOOTER
===================================================== -->

<footer>

    <small>
        &copy; <?= date('Y') ?> KursusKu UIN
    </small>

</footer>


</body>

</html>
