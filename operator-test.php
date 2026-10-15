<?php
$fee = 350000;
$participants = 2;
$subtotal = $fee * $participants;
$comparisonPositive = $fee > 0;
$comparisonStrict = $fee === 350000;
$message = 'Biaya: Rp ' . $fee;

$operators = [
    [
        'symbol'     => '*',
        'label'      => 'Perkalian',
        'expression' => '$fee * $participants',
        'result'     => (string) $subtotal,
        'type'       => 'text',
    ],
    [
        'symbol'     => '>',
        'label'      => 'Comparison > 0',
        'expression' => '$fee > 0',
        'result'     => $comparisonPositive,
        'type'       => 'bool',
    ],
    [
        'symbol'     => '===',
        'label'      => 'Strict ===',
        'expression' => '$fee === 350000',
        'result'     => $comparisonStrict,
        'type'       => 'bool',
    ],
    [
        'symbol'     => '.',
        'label'      => 'Concatenation',
        'expression' => "'Biaya: Rp ' . \$fee",
        'result'     => $message,
        'type'       => 'text',
    ],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operator Test</title>
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
            width: min(100%, 40rem);
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

        code {
            font-family: ui-monospace, "Cascadia Code", Consolas, monospace;
        }

        /* Ringkasan perkalian */
        .summary {
            margin: 0 0 1.5rem;
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, #fff 0%, var(--rose-50) 100%);
            border: 1px solid var(--rose-200);
            border-left: 6px solid var(--rose-500);
            border-radius: 1rem;
        }

        .summary p { margin: 0; color: var(--muted); font-size: 0.95rem; }

        .summary .equation {
            margin-top: 0.25rem;
            font-size: clamp(1.15rem, 4.5vw, 1.6rem);
            font-weight: 800;
            color: var(--rose-700);
            font-variant-numeric: tabular-nums;
            overflow-wrap: anywhere;
        }

        .summary .equation span { color: var(--rose-500); }

        /* Daftar operator */
        .results {
            margin: 0 0 1.75rem;
            padding: 0;
            list-style: none;
            overflow: hidden;
            background: #fff;
            border: 1px solid var(--rose-200);
            border-radius: 1rem;
        }

        .results li {
            display: grid;
            grid-template-columns: 3.25rem 1fr auto;
            align-items: center;
            gap: 0.9rem;
            padding: 0.9rem 1.25rem;
            border-bottom: 1px solid var(--rose-100);
        }

        .results li:last-child { border-bottom: 0; }
        .results li:hover { background: #fffafc; }

        .symbol {
            display: grid;
            place-items: center;
            height: 2.5rem;
            font-family: ui-monospace, "Cascadia Code", Consolas, monospace;
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--rose-700);
            background: var(--rose-50);
            border: 1px solid var(--rose-200);
            border-radius: 0.7rem;
        }

        .info strong { display: block; font-weight: 700; }

        .info code {
            font-size: 0.85rem;
            color: var(--muted);
            overflow-wrap: anywhere;
        }

        .value {
            font-weight: 700;
            text-align: right;
            font-variant-numeric: tabular-nums;
            overflow-wrap: anywhere;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 999px;
        }
        .badge.is-true { color: #0f766e; background: #ccfbf1; }
        .badge.is-false { color: var(--muted); background: var(--rose-100); }

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
            .results li { grid-template-columns: 2.75rem 1fr; }
            .results .value { grid-column: 2; text-align: left; }
        }
        @media (prefers-reduced-motion: reduce) {
            .button { transition: none; }
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Operator PHP</h1>

        <section class="summary" aria-label="Hasil perkalian">
            <p>Subtotal biaya kursus</p>
            <div class="equation">
                <?= $fee ?> <span>&times;</span> <?= $participants ?> <span>=</span> <?= $subtotal ?>
            </div>
        </section>

        <ul class="results">
            <?php foreach ($operators as $op): ?>
                <li>
                    <span class="symbol"><?= htmlspecialchars($op['symbol']) ?></span>
                    <div class="info">
                        <strong><?= htmlspecialchars($op['label']) ?></strong>
                        <code><?= htmlspecialchars($op['expression']) ?></code>
                    </div>
                    <?php if ($op['type'] === 'bool'): ?>
                        <span class="badge <?= $op['result'] ? 'is-true' : 'is-false' ?>">
                            <?= $op['result'] ? '✓ true' : '✕ false' ?>
                        </span>
                    <?php else: ?>
                        <span class="value"><?= htmlspecialchars($op['result']) ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <a class="button" href="fee-calculator.php">Kembali ke Kalkulator</a>
    </main>
</body>
</html>