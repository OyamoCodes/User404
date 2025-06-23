<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'XP Style App' }}</title>
    @vite('resources/css/xp-style.css')
</head>
<body>

    <nav class="xp-hotbar">
        <ul class="xp-hotbar-list">
            <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ url('/quizz-host') }}" class="{{ request()->is('quizz-host') ? 'active' : '' }}">Quizz Host</a></li>
            @auth
                <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            @else
                <li><a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">Login</a></li>
                <li><a href="{{ route('register') }}" class="{{ request()->is('register') ? 'active' : '' }}">Register</a></li>
            @endauth
        </ul>
    </nav>

    <main class="xp-main">
        @yield('content')
    </main>

</body>
</html>
