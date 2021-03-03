<?php

namespace App\Models\Session;

use Jenssegers\Mongodb\Eloquent\Model;

class Session extends Model
{
  /**
   * @var string
   */
  protected $collection = 'sessions';

  /**
   * @var string
   */
  protected $connection = 'mongodb';

  /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'chatId',
        'platform_type',
        'contact_identifier',
        'messages',
    ];

    /**
     * @var array
     */
    public array $rules = [
        'chatId' => 'required|min:2|max:45|alpha',
        'name' => 'required|min:2|max:45|alpha',
        'platform_type' => 'required:min:10|max:45',
        'contact_identifier' => 'required|min:2|max:45',
        'messages' => 'required'
    ];

    public $timestamps = false;
}