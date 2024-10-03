<html>
    <body>
        <h3>Админ панель</h3>
        <hr>
        <h5>Послать сообщение пользователю</h5>
        <form method="POST" action="/send">
            <input type="number" name="userid" placeholder="ID Пользователя">
            <input type="text" name="message" placeholder="Уведомление">
            <input type="submit">
            @csrf
        </form>
    </body>
</html>
