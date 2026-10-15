<?php
$quota = 30;
$registered = 18;
$isFull = $registered >= $quota;
$hasSeat = $registered < $quota;

$remaining = max($quota - $registered, 0);
$percent = $quota > 0 ? min(100, (int) round($registered / $quota * 100)) : 0;

$checks = [
    ['variable' => '$isFull',  'expression' => '$registered >= $quota', 'result' => $isFull],
    ['variable' => '$hasSeat', 'expression' => '$registered < $quota',  'result' => $hasSeat],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kuota Kelas</title>
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
            width: min(100%, 38rem);
            padding: clamp(1.5rem, 5vw, 2.75rem);
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            border: 1px solid var(--rose-200);
            border-radius: 1.5rem;
            box-shadow: 0 1px 0 #fff inset, 0 24px 48px -24px rgba(190, 24, 93, 0.35);
        }

        h1 {
            margin: 0 0 1.5rem;
            font-size: clamp(1.6rem, 5vw, 2.1rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--rose-900);
        }

        code, pre {
            font-family: ui-monospace, "Cascadia Code", Consolas, monospace;
        }

        /* Ringkasan kuota */
        .summary {
            margin: 0 0 1.5rem;
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, #fff 0%, var(--rose-50) 100%);
            border: 1px solid var(--rose-200);
            border-left: 6px solid var(--rose-500);
            border-radius: 1rem;
        }

        .summary-top {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem 1rem;
            margin-bottom: 0.9rem;
        }

        .count {
            font-size: clamp(1.8rem, 7vw, 2.4rem);
            font-weight: 800;
            line-height: 1.1;
            color: var(--rose-700);
            font-variant-numeric: tabular-nums;
        }

        .count small {
            font-size: 1rem;
            font-weight: 600;
            color: var(--muted);
        }

        .status {
            padding: 0.3rem 0.9rem;
            font-size: 0.9rem;
            font-weight: 700;
            border-radius: 999px;
        }
        .status.open { color: #0f766e; background: #ccfbf1; }
        .status.full { color: var(--rose-900); background: var(--rose-200); }

        .bar {
            height: 0.85rem;
            overflow: hidden;
            background: var(--rose-100);
            border-radius: 999px;
        }

        .bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--rose-500), var(--rose-700));
            border-radius: 999px;
        }

        .bar-note {
            display: flex;
            justify-content: space-between;
            margin: 0.6rem 0 0;
            font-size: 0.9rem;
            color: var(--muted);
        }

        /* Daftar hasil */
        .results {
            margin: 0 0 1.5rem;
            padding: 0;
            list-style: none;
            overflow: hidden;
            background: #fff;
            border: 1px solid var(--rose-200);
            border-radius: 1rem;
        }

        .results li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.9rem 1.25rem;
            border-bottom: 1px solid var(--rose-100);
        }

        .results li:last-child { border-bottom: 0; }
        .results li:hover { background: #fffafc; }

        .name strong {
            display: inline-block;
            padding: 0.1rem 0.6rem;
            font-family: ui-monospace, "Cascadia Code", Consolas, monospace;
            font-size: 0.9rem;
            color: var(--rose-700);
            background: var(--rose-50);
            border: 1px solid var(--rose-200);
            border-radius: 0.4rem;
        }

        .name code {
            display: block;
            margin-top: 0.2rem;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .badge {
            padding: 0.25rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 700;
            white-space: nowrap;
            border-radius: 999px;
        }
        .badge.is-true { color: #0f766e; background: #ccfbf1; }
        .badge.is-false { color: var(--muted); background: var(--rose-100); }

        /* var_dump */
        details {
            margin: 0 0 1.75rem;
            background: #fff;
            border: 1px solid var(--rose-200);
            border-radius: 1rem;
        }

        summary {
            padding: 0.8rem 1.25rem;
            font-weight: 600;
            color: var(--rose-700);
            cursor: pointer;
            border-radius: 1rem;
        }
        summary:focus-visible { outline: 3px solid var(--rose-900); outline-offset: 2px; }

        pre {
            margin: 0;
            padding: 0.5rem 1.25rem 1.1rem;
            font-size: 0.9rem;
            overflow-x: auto;
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

        @media (prefers-reduced-motion: reduce) {
            .button { transition: none; }
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Kuota Kelas</h1>

        <section class="summary" aria-label="Ringkasan kuota">
            <div class="summary-top">
                <div class="count">
                    <?= $registered ?> <small>dari <?= $quota ?> peserta</small>
                </div>
                <span class="status <?= $isFull ? 'full' : 'open' ?>">
                    <?= $isFull ? 'Kelas penuh' : 'Masih ada kursi' ?>
                </span>
            </div>

            <div class="bar" role="progressbar" aria-label="Kuota terisi"
                 aria-valuemin="0" aria-valuemax="<?= $quota ?>" aria-valuenow="<?= $registered ?>">
                <div class="bar-fill" style="width: <?= $percent ?>%"></div>
            </div>

            <p class="bar-note">
                <span><?= $percent ?>% terisi</span>
                <span>Sisa <?= $remaining ?> kursi</span>
            </p>
        </section>

        <ul class="results">
            <?php foreach ($checks as $check): ?>
                <li>
                    <div class="name">
                        <strong><?= htmlspecialchars($check['variable']) ?></strong>
                        <code><?= htmlspecialchars($check['expression']) ?></code>
                    </div>
                    <span class="badge <?= $check['result'] ? 'is-true' : 'is-false' ?>">
                        <?= $check['result'] ? '✓ true' : '✕ false' ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>

        <details>
            <summary>Lihat output var_dump()</summary>
            <pre><?php var_dump($isFull); var_dump($hasSeat); ?></pre>
        </details>

        <a class="button" href="index.php">Kembali</a>
    </main>
</body>
</html>