<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RecieveController extends Controller
{
    public function index()
    {
        $message = $this->recieve();
        return view('ui.consumer', ['username' => auth()->user()->name, 'message' => $message]);
    }

    public function recieve() {
        $connection = new AMQPStreamConnection(Config::get('app.rabbitmq.host'), Config::get('app.rabbitmq.port'), Config::get('app.rabbitmq.user'), Config::get('app.rabbitmq.passwd'));
        $channel = $connection->channel();

        $channel->queue_declare('user'.auth()->user()->id, false, true, false, false);

        $result = $channel->basic_get('user'.auth()->user()->id);
        if(isset($result->body)) {
            $message = $result->getBody();
            $result->ack();
        } else {
            $message = null;
        }

        $channel->close();
        $connection->close();

        return $message;
    }
}
