<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,700,900|source-sans-3:300,400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        :root {
            --primary: #1a1a1a;
            --accent: #d4af37;
            --text: #2d2d2d;
            --text-light: #6b6b6b;
            --bg: #fafaf8;
            --card-bg: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Source Sans 3', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.7;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 30px,
                    rgba(212, 175, 55, 0.03) 30px,
                    rgba(212, 175, 55, 0.03) 60px
                );
            pointer-events: none;
        }

        /* Auth Links */
        .auth-links {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 1000;
            display: flex;
            gap: 1rem;
        }

        .auth-links a {
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.75rem 2rem;
            border: 2px solid var(--primary);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .auth-links a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--primary);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .auth-links a:hover {
            color: #fff;
            border-color: var(--primary);
        }

        .auth-links a:hover::before {
            left: 0;
        }

        .auth-links a:last-child {
            background: var(--primary);
            color: #fff;
        }

        .auth-links a:last-child::before {
            background: var(--accent);
        }

        /* Main Container */
        .main-container {
            text-align: center;
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 2rem;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 5rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 1rem;
            letter-spacing: -3px;
            animation: fadeInDown 1s ease;
        }

        .tagline {
            color: var(--accent);
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 4px;
            text-transform: uppercase;
            animation: fadeInUp 1s ease 0.2s backwards;
            margin-bottom: 3rem;
        }

        .description {
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto 3rem;
            animation: fadeIn 1s ease 0.4s backwards;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            animation: fadeInUp 1s ease 0.6s backwards;
        }

        .btn {
            padding: 1rem 3rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid var(--primary);
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--accent);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-primary:hover::before {
            left: 0;
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary);
        }

        .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--primary);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-secondary:hover {
            color: #fff;
        }

        .btn-secondary:hover::before {
            left: 0;
        }

        .version {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            color: var(--text-light);
            font-size: 0.85rem;
            animation: fadeIn 1s ease 0.8s backwards;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo {
                font-size: 3.5rem;
            }

            .tagline {
                font-size: 1rem;
                letter-spacing: 2px;
            }

            .description {
                font-size: 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                padding: 0.9rem 2rem;
            }

            .auth-links {
                top: 1rem;
                right: 1rem;
                gap: 0.5rem;
            }

            .auth-links a {
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .auth-links {
                flex-direction: column;
                align-items: flex-end;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --primary: #ffffff;
                --text: #e5e5e5;
                --text-light: #a0a0a0;
                --bg: #0f0f0f;
                --card-bg: #1a1a1a;
            }

            body::before {
                background: 
                    repeating-linear-gradient(
                        45deg,
                        transparent,
                        transparent 30px,
                        rgba(212, 175, 55, 0.05) 30px,
                        rgba(212, 175, 55, 0.05) 60px
                    );
            }

            .auth-links a:last-child {
                background: var(--accent);
                color: var(--primary);
            }

            .btn-primary {
                background: var(--accent);
                color: #0f0f0f;
                border-color: var(--accent);
            }

            .btn-primary::before {
                background: var(--primary);
            }

            .btn-primary:hover {
                color: #0f0f0f;
            }

            .btn-secondary {
                border-color: var(--accent);
                color: var(--accent);
            }

            .btn-secondary::before {
                background: var(--accent);
            }

            .btn-secondary:hover {
                color: #0f0f0f;
            }
        }
    </style>
</head>
<body>
    @if (Route::has('login'))
        <div class="auth-links">
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="main-container">
        <h1 class="logo">Élégance</h1>
        <p class="tagline">Votre blog Laravel</p>
        <p class="description">
            Bienvenue sur votre nouveau blog propulsé par Laravel. 
            Une plateforme élégante pour partager vos idées et créations avec le monde.
        </p>
        <div class="cta-buttons">
            <a href="{{ route('login') }}" class="btn btn-primary">Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Créer un compte</a>
        </div>
    </div>

    <div class="version">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} • PHP v{{ PHP_VERSION }}
    </div>
</body>
</html>