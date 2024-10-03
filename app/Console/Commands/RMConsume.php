<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RMConsume extends Command
{
    /**
     * @var string
     */
    protected $signature = 'rm:consume';

    /**
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Тестируем прием на брокер RabbitMQ
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection(Config::get('app.rabbitmq.host'), Config::get('app.rabbitmq.port'), Config::get('app.rabbitmq.user'), Config::get('app.rabbitmq.passwd'));
        $channel = $connection->channel();

        $channel->queue_declare('message', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };

        $channel->basic_consume('message', '', false, false, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
