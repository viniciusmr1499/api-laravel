<?php

require __DIR__ . '/src/vendor/autoload.php';

use Predis\Client;
use TelegramBot\Api\BotApi;

$config = [
  'host' => 'localhost',
  'port' => 6379,
  'read_write_timeout' => 0
];

$bot = new  BotApi('1632016081:AAH6CO5XdKXSS7HjWqtOvFa7lXhIHQVGOok');

$redis = new Client($config);

$loop = $redis->pubSubLoop();
$loop->getSubscribed('603e7b14ae7891040b6c8596');

foreach ($loop as $msg) {
  switch ($msg->kind) {
    case 'subscribe':
      $bot->sendMessage(974302180,"Acabei de me inscrever no canal {$msg->channel}");
      break;

    case 'message':
      if($msg->payload === 'exit') {
        $bot->sendMessage(974302180,"Saindo do canal {$msg->channel}");
        $loop->unsubscribe();
      }
      $bot->sendMessage(974302180,$msg->payload);
      // if ($msg->channel == $channel) {
      //     if ($msg->payload == 'quit') {
      //       $loop->unsubscribe();
      //     } else {
      //       $data = [
      //         'userId' => $userId,
      //         'message' => $message
      //       ];
      //       $data = json_encode($data);
      //       $redis->publish($channel, $data);
      //     }
      // }
    break;
  }
}
unset($loop);