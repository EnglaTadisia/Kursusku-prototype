<?php
$READ = 1;
$WRITE = 2;
$DELETE = 4;
$permission = $READ | $WRITE;
$canRead = ($permission & $READ) === $READ;
$canWrite = ($permission & $WRITE) === $WRITE;
$canDelete = ($permission & $DELETE) === $DELETE;

// Urutan dari bit paling kiri (DELETE) ke paling kanan (READ)
$flags = [
    ['name' => 'DELETE', 'value' => $DELETE, 'allowed' => $canDelete],
    ['name' => 'WRITE',  'value' => $WRITE,  'allowed' => $canWrite],
    ['name' => 'READ',   'value' => $READ,   'allowed' => $canRead],
];
$binary = str_pad(decbin($permission), 3, '0', STR_PAD_LEFT);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bitwise Test</title>
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

        /* Ringkasan nilai permission */
        .summary {
            margin: 0 0 1.5rem;
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, #fff 0%, var(--rose-50) 100%);
            border: 1px solid var(--rose-200);
            border-left: 6px solid var(--rose-500);
            border-radius: 1rem;
        }

        .formula {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem 0.75rem;
            margin: 0 0 1rem;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .formula code {
            padding: 0.15rem 0.6rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--rose-700);
            background: var(--rose-50);
            border: 1px solid var(--rose-200);
            border-radius: 0.4rem;
        }

        .formula strong { color: var(--rose-700); font-size: 1.1rem; }

        /* Kotak bit */
        .bits {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .bits li {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.9rem 0.5rem;
            text-align: center;
            border: 1px solid var(--rose-200);
            border-radius: 0.9rem;
        }

        .bits li.is-on {
            color: #fff;
            background: linear-gradient(135deg, var(--rose-500), var(--rose-700));
            border-color: transparent;
            box-shadow: 0 10px 20px -12px rgba(190, 24, 93, 0.7);
        }

        .bits li.is-off { color: var(--muted); background: #fff; }

        .bit {
            font-family: ui-monospace, "Cascadia Code", Consolas, monospace;
            font-size: clamp(1.8rem, 7vw, 2.4rem);
            font-weight: 800;
            line-height: 1.1;
        }

        .bit-name { font-weight: 700; font-size: 0.95rem; }
        .bit-value { font-size: 0.8rem; opacity: 0.85; }

        /* Daftar status */
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
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--rose-100);
        }

        .results li:last-child { border-bottom: 0; }
        .results li:hover { background: #fffafc; }

        .results code {
            padding: 0.15rem 0.6rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--rose-700);
            background: var(--rose-50);
            border: 1px solid var(--rose-200);
            border-radius: 0.4rem;
        }

        .status {
            padding: 0.25rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 700;
            text-align: right;
            border-radius: 999px;
        }
        .status.is-on { color: #0f766e; background: #ccfbf1; }
        .status.is-off { color: var(--muted); background: var(--rose-100); }

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
        <h1>Bitwise Permission Test</h1>

        <section class="summary" aria-label="Nilai permission">
            <p class="formula">
                <code>$permission = $READ | $WRITE</code>
                <span>= <strong><?= $permission ?></strong> (biner <?= $binary ?>)</span>
            </p>

            <ol class="bits">
                <?php foreach ($flags as $flag): ?>
                    <li class="<?= $flag['allowed'] ? 'is-on' : 'is-off' ?>">
                        <span class="bit"><?= $flag['allowed'] ? 1 : 0 ?></span>
                        <span class="bit-name"><?= htmlspecialchars($flag['name']) ?></span>
                        <span class="bit-value">nilai <?= $flag['value'] ?></span>
                    </li>
                <?php endforeach; ?>
            </ol>
        </section>

        <ul class="results">
            <?php foreach (array_reverse($flags) as $flag): ?>
                <li>
                    <code>$can<?= ucfirst(strtolower($flag['name'])) ?></code>
                    <span class="status <?= $flag['allowed'] ? 'is-on' : 'is-off' ?>">
                        <?= $flag['allowed'] ? '✓ true, diizinkan' : '✕ false, ditolak' ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>

        <details>
            <summary>Lihat output var_dump()</summary>
            <pre><?php var_dump($canRead, $canWrite, $canDelete); ?></pre>
        </details>

        <a class="button" href="index.php">Kembali</a>
    </main>
</body>
</html>