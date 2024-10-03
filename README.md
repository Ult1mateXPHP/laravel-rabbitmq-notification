<h1>Laravel 11 + RabbitMQ Notification Test</h1>
<hr>
<h3>Установка</h3>
<code>git clone https://github.com/Ult1mateXPHP/laravel-rabbitmq-notification.git</code><br>
<code>cp .env.example .env</code>
<p>Заполнить .env DB_</p>
<code>sudo chmod -R 777 ./storage</code><br>
<code>sudo chmod -R 777 ./bootstrap/cache/</code><br>
<code>php artisan config:clear</code><br>
<code>php artisan key:generate</code><br>
<code>php artisan migrate</code>
<hr>
<h3>Запуск</h3>
<code>docker compose up -d</code>

