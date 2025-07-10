<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'TeachPlayLearn')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        :root {
            --lavender: #e8eaf6;
            --light-purple: #d1c4e9;
            --mid-purple: #b39ddb;
            --deep-purple: #9575cd;
            --violet-gradient-start: #6a1b9a;
            --violet-gradient-end: #8e24aa;
            --white: #ffffff;
            --text-dark: #3e3e3e;
        }

        /* Fonte e background */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--lavender), var(--light-purple));
            min-height: 100vh;
            margin: 0;
            color: var(--text-dark);
        }

        /* Navbar moderna */
        .navbar-custom {
            background-color: var(--deep-purple);
            /* Roxo mais escuro */
            box-shadow: 0 3px 8px rgba(149, 117, 205, 0.5);
            padding: 0.75rem 2rem;
            transition: background-color 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-brand img {
            height: 48px;
            width: 48px;
            border-radius: 8px;
            object-fit: contain;
            filter: drop-shadow(0 0 2px rgba(0, 0, 0, 0.2));
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.1);
        }

        /* Links da navbar */
        .navbar-nav .nav-link {
            color: var(--light-purple);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus {
            color: var(--white);
            background-color: var(--mid-purple);
            text-decoration: none;
        }

        .navbar-nav .nav-link.active {
            background-color: var(--mid-purple);
            color: var(--white);
        }

        /* Container principal */
        main.container {
            max-width: 960px;
            margin: 2.5rem auto 4rem;
            background: var(--white);
            padding: 2.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(179, 157, 219, 0.2);
        }

        /* Botão toggle do menu */
        .navbar-toggler {
            border: none;
            outline: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(149,117,205,0.8)' stroke-width='3' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            filter: drop-shadow(0 0 2px rgba(0, 0, 0, 0.15));
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('game/assets/images/icon.png') }}" alt="Logo TeachPlayLearn" />
                TeachPlayLearn
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jogos.community_index') }}" class="nav-link {{ request()->is('community_games') ? 'active' : '' }}">Jogos da Comunidade</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">Sobre</a>

                    </li>
                    <li>@if (Route::has('login'))
                        <div class="auth-buttons" role="group" aria-label="Ações de autenticação">
                            @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-light ms-2 px-4 py-2 rounded-pill fw-semibold shadow-sm" style="background-color: var(--mid-purple); color: white; border: none;">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>

                            @else
                            <a href="{{ route('login') }}" class="auth-btn login" aria-label="Login"> Log in </a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="auth-btn register" aria-label="Registrar">Registrar</a>
                            @endif
                            @endauth
                        </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>