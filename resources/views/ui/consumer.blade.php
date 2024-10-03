<html>
    <head>
        <meta http-equiv="refresh" content="5">
    </head>
    <body>
        <h3>Добро пожаловать {{ $username }}!</h3>
        <hr>
        @if($message != null)
            <p>Сообщение от администратора: {{ $message }}</p>
        @endif
    </body>
</html>
