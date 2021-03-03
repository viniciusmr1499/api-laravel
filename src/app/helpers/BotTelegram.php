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
  
  /**
   * sendMessage
   *
   * @param  mixed $channel
   * @param  mixed $message
   * @return void
   */
  public function sendMessage(string $channel, string $message, bool $isBot = false): bool
  {
    if(empty($channel)) {
      throw new Exception('Failed the send message to channel on telegram');
    }

    if($isBot) {
      $this->bot->sendMessage($channel, $message);
      return true;
    }
    
    $character = substr($channel, 0, 1);
    $channel = $character === '@' ? $channel : "@{$channel}";
    $this->bot->sendMessage($channel, $message);
    return true;
  }
    
  /**
   * getKey
   *
   * @return string
   */
  private static function getKey(): string
  {
    return  env('PHP_TELEGRAM_BOT_API_KEY');
  }
}