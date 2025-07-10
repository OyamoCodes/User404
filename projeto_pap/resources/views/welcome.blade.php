<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TeachPlayLearn</title>
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

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--lavender), var(--light-purple));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text-dark);
        }

        header {
            padding: 1rem;
            text-align: center;
            background: var(--deep-purple);
            box-shadow: 0 3px 8px rgba(149, 117, 205, 0.5);
        }

        header img.logo {
            max-height: 60px;
            width: auto;
            user-select: none;
        }

        .hero {
            text-align: center;
            padding: 3rem 1rem 2rem;
            background: linear-gradient(135deg, var(--violet-gradient-start), var(--violet-gradient-end));
            color: var(--white);
            box-shadow: 0 4px 15px rgba(106, 27, 154, 0.5);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 0.2rem;
            font-weight: 500;
            opacity: 0.9;
        }

        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3rem;
            padding: 1rem 1rem 3rem;
            max-width: 960px;
            margin: 0 auto;
            width: 100%;
        }

        .btn-big {
            background: var(--deep-purple);
            color: var(--white);
            font-weight: 700;
            font-size: 1.5rem;
            padding: 1rem 3rem;
            border-radius: 30px;
            box-shadow: 0 8px 20px rgba(149, 117, 205, 0.5);
            border: none;
            cursor: pointer;
            transition: background-color 0.25s ease, box-shadow 0.25s ease;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
            user-select: none;
        }

        .btn-big:hover {
            background-color: #7e57c2;
            box-shadow: 0 12px 30px rgba(126, 87, 194, 0.7);
            text-decoration: none;
            color: white;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            width: 100%;
        }

        .card-option {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 8px 18px rgba(179, 157, 219, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            user-select: none;
        }

        .card-option:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(149, 117, 205, 0.4);
        }

        .card-option i {
            font-size: 3rem;
            color: var(--deep-purple);
            margin-bottom: 1rem;
        }

        .card-option h5 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 0.6rem;
            color: #5e35b1;
        }

        .card-option p {
            font-size: 1rem;
            color: #444;
        }

        .btn-custom {
            margin-top: 1.2rem;
            background-color: var(--deep-purple);
            color: var(--white);
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(149, 117, 205, 0.5);
            transition: background-color 0.25s ease;
            display: inline-block;
            user-select: none;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #7e57c2;
            box-shadow: 0 5px 15px rgba(126, 87, 194, 0.7);
            text-decoration: none;
            color: white;
        }

        /* Contêiner para login e registo lado a lado */
        .auth-buttons {
            margin-top: 1.5rem;
            display: flex;
            gap: 1.2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .auth-btn {
            min-width: 140px;
            font-size: 1.2rem;
            font-weight: 700;
            padding: 0.85rem 2rem;
            border-radius: 30px;
            cursor: pointer;
            user-select: none;
            border: 2px solid var(--deep-purple);
            background-color: transparent;
            color: var(--deep-purple);
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .auth-btn.login {
            background-color: var(--deep-purple);
            color: var(--white);
            border-color: var(--deep-purple);
            box-shadow: 0 4px 15px rgba(149, 117, 205, 0.7);
        }

        .auth-btn.login:hover {
            background-color: #7e57c2;
            border-color: #7e57c2;
            box-shadow: 0 6px 20px rgba(126, 87, 194, 0.9);
            color: white;
            text-decoration: none;
        }

        .auth-btn.register:hover {
            background-color: var(--deep-purple);
            color: var(--white);
            border-color: var(--deep-purple);
            box-shadow: 0 6px 20px rgba(149, 117, 205, 0.7);
            text-decoration: none;
        }

        footer {
            text-align: center;
            padding: 1.2rem;
            background-color: var(--mid-purple);
            color: var(--white);
            font-weight: 500;
        }

        /* Ícones alinhados verticalmente no botão grande */
        .btn-big i {
            font-size: 1.8rem;
        }
    </style>
</head>

<body>

    <section class="hero">
        <h1>TeachPlayLearn</h1>
        <p>Educação interativa com um toque de magia 💜</p>
    </section>

    <main class="main-container">

        <img src="game/assets/images/icon.png" alt="Logo TeachPlayLearn" class="logo" style="height: 200px; width: 200px;" />
        <a href="{{ route('game.code_form') }}" class="btn-big" aria-label="Join a game">
            <i class="bi bi-box-arrow-in-right"></i> Entrar num jogo
        </a>


        <div class="options-grid" role="list">

            <a href="{{ route('jogos.community_index') }}" class="card-option" role="listitem" aria-label="Jogos da comunidade">
                <i class="bi bi-controller"></i>
                <h5>Jogos da comunidade</h5>
                <p>Explora os jogos educativos feitos por outros utilizadores.</p>
                <span class="btn-custom" aria-hidden="true">Explorar</span>
            </a>

            <a href="{{ route('about') }}" class="card-option" role="listitem" aria-label="Criar um jogo">
                <i class="bi bi-brush"></i>
                <h5>Criar um jogo</h5>
                <p>Desenha o teu próprio jogo educativo personalizado.</p>
                <span class="btn-custom" aria-hidden="true">Começar</span>
            </a>

        </div>
        @if (Route::has('login'))
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

    </main>

    <footer>
        © 2025 TeachPlayLearn | Todos os direitos reservados
    </footer>
    @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
    @endif


</body>

</html>