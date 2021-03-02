<?php 

namespace App\helpers;

use Exception;
use TelegramBot\Api\BotApi;

/**
 * BotTelegram
 */
class BotTelegram 
{
  protected $bot;
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->bot = new  BotApi(self::getKey());
  }

  public function sendMessage(string $channel, string $message): void
  {
    if(empty($channel)) {
      throw new Exception('Failed the send message to channel on telegram');
    }

    $character = substr($channel, 0, 1);
    $channel = $character === '@' ? $channel : "@{$channel}";

    $this->bot->sendMessage($channel, $message);
  }

  private static function getKey(): string
  {
    return  env('PHP_TELEGRAM_BOT_API_KEY');
  }
}