<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendController extends Controller
{
    public function index()
    {
        return view('ui.admin');
    }

    public function send(Request $request) {
        $userid = Request::input('userid');
        $message = Request::input('message');

        $connection = new AMQPStreamConnection(Config::get('app.rabbitmq.host'), Config::get('app.rabbitmq.port'), Config::get('app.rabbitmq.user'), Config::get('app.rabbitmq.passwd'));
        $channel = $connection->channel();

        $channel->queue_declare('user'.$userid, false, true, false, false);

        $message_packet = new AMQPMessage($message);
        $channel->basic_publish($message_packet, '', 'user'.$userid);

        $channel->close();
        $connection->close();

        return redirect('/send');
    }
}
