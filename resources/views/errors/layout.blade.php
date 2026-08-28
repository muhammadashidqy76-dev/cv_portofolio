<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Error' }} — Ashidqy</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/images/logo-web.svg">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { font-family: 'Figtree', system-ui, sans-serif; background: #0b0f19; color: #e2e8f0; min-height: 100vh; }
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 2rem 1rem; background: #0b0f19; }

        /* Ambient blobs */
        .blob { position: fixed; border-radius: 9999px; filter: blur(100px); pointer-events: none; opacity: 0.5; }
        .blob-red  { width: 400px; height: 400px; top: -100px; right: -100px; background: rgba(220,38,38,0.06); }
        .blob-indigo { width: 400px; height: 400px; bottom: -100px; left: -100px; background: rgba(99,102,241,0.05); }

        /* Grid overlay */
        .grid-overlay {
            position: fixed; inset: 0; pointer-events: none;
            background-image: linear-gradient(to right, #1f293712 1px, transparent 1px),
                              linear-gradient(to bottom, #1f293712 1px, transparent 1px);
            background-size: 4rem 4rem;
            mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
        }

        .card {
            position: relative; z-index: 10;
            width: 100%; max-width: 560px;
            background: rgba(15, 20, 34, 0.9);
            border: 1px solid rgba(51, 65, 85, 0.8);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        }

        /* Window chrome bar */
        .window-bar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 18px;
            background: #0f172a;
            border-bottom: 1px solid rgba(51, 65, 85, 0.6);
        }
        .dots { display: flex; gap: 6px; }
        .dot { width: 10px; height: 10px; border-radius: 9999px; }
        .dot-red   { background: rgba(244,63,94,0.7); }
        .dot-amber { background: rgba(251,191,36,0.7); }
        .dot-green { background: rgba(52,211,153,0.7); }
        .window-label {
            font-family: monospace; font-size: 11px;
            color: #64748b; background: rgba(11,15,25,0.6);
            padding: 2px 10px; border-radius: 4px;
            border: 1px solid rgba(51,65,85,0.5);
        }

        /* Card body */
        .card-body { padding: 2.5rem 2rem; text-align: center; }

        /* Error code badge */
        .error-code {
            display: inline-block;
            font-family: monospace; font-size: clamp(4rem, 15vw, 6rem);
            font-weight: 800; letter-spacing: -0.04em; line-height: 1;
            background: linear-gradient(135deg, #f43f5e, #fb923c);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.25rem;
        }

        .error-title {
            font-size: 1.25rem; font-weight: 700;
            color: #f1f5f9; letter-spacing: -0.01em;
            margin-bottom: 0.625rem;
        }
        .error-desc {
            font-size: 0.875rem; color: #94a3b8; line-height: 1.6;
            max-width: 360px; margin: 0 auto 2rem;
        }

        /* Terminal/code hint block */
        .code-hint {
            font-family: monospace; font-size: 0.75rem;
            background: #090d16; border: 1px solid rgba(51,65,85,0.7);
            border-radius: 10px; padding: 1rem 1.25rem;
            color: #64748b; text-align: left;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .code-hint .prompt { color: #ef4444; margin-right: 6px; user-select: none; }
        .code-hint .output { color: #94a3b8; }
        .code-hint .accent { color: #fb923c; }

        /* Back home button */
        .btn-home {
            display: inline-flex; align-items: center; gap: 8px;
            background: #dc2626; color: #fff;
            font-size: 0.875rem; font-weight: 600;
            padding: 0.75rem 1.75rem; border-radius: 10px;
            text-decoration: none; border: none; cursor: pointer;
            box-shadow: 0 4px 20px rgba(220,38,38,0.25);
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-home:hover {
            background: #ef4444;
            box-shadow: 0 4px 28px rgba(220,38,38,0.4);
            transform: translateY(-1px);
        }
        .btn-home svg { width: 14px; height: 14px; }

        /* Brand logo at bottom */
        .brand {
            margin-top: 2.5rem; padding-top: 1.5rem;
            border-top: 1px solid rgba(51,65,85,0.5);
            font-family: monospace; font-size: 0.8125rem; color: #64748b;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .brand .dots-sm { display: flex; gap: 4px; }
        .brand .dot-sm { width: 6px; height: 6px; border-radius: 9999px; }
        .brand-name { color: #f43f5e; font-weight: 700; }
    </style>
</head>
<body>
    <div class="blob blob-red"></div>
    <div class="blob blob-indigo"></div>
    <div class="grid-overlay"></div>

    <div class="card">
        <!-- Window Mockup Chrome Bar -->
        <div class="window-bar">
            <div class="dots">
                <span class="dot dot-red"></span>
                <span class="dot dot-amber"></span>
                <span class="dot dot-green"></span>
            </div>
            <span class="window-label">error.log</span>
            <div style="width:58px"></div>{{-- spacer --}}
        </div>

        <!-- Card Body -->
        <div class="card-body">
            {{ $slot }}

            <div class="brand">
                <div class="dots-sm">
                    <span class="dot-sm" style="background:rgba(244,63,94,0.7)"></span>
                    <span class="dot-sm" style="background:rgba(251,191,36,0.7)"></span>
                    <span class="dot-sm" style="background:rgba(52,211,153,0.7)"></span>
                </div>
                <span>&lt;<span class="brand-name">Ashidqy</span>/&gt;</span>
            </div>
        </div>
    </div>
</body>
</html>
