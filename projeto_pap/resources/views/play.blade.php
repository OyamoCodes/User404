<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <title>TeachPlayLearn</title>
    <script src="https://unpkg.com/kaboom@3000.0.1/dist/kaboom.js"></script>
</head>

<body>
    <div id="game" data-template='@json($game)'></div>
    <script src="{{ asset('game/main.js') }}"></script>

</body>

</html>