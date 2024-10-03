<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RMPublish extends Command
{
    /**
     * @var string
     */
    protected $signature = 'rm:publish';

    /**
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Тестируем отправку на брокер RabbitMQ
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection(Config::get('app.rabbitmq.host'), Config::get('app.rabbitmq.port'), Config::get('app.rabbitmq.user'), Config::get('app.rabbitmq.passwd'));
        $channel = $connection->channel();

        $channel->queue_declare('message', false, false, false, false);

        $msg = new AMQPMessage('It Work!');
        $channel->basic_publish($msg, '', 'message');

        echo " [x] Sent 'Hello World!'\n";

        $channel->close();
        $connection->close();
    }
}
