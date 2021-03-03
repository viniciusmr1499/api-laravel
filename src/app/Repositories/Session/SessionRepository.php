<?php 

namespace App\Repositories\Session;

use App\Models\Session\Session;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\Redis;

/**
 * SessionRepository
 */
class SessionRepository extends AbstractRepository
{  
    
  /**
   * __construct
   *
   * @param  mixed $session
   * @return void
   */
  public function __construct(Session $session)
  {
    $this->model = $session;
  }
  
  /**
   * findByName
   *
   * @return array
   */
  public function findByName(string $name): array 
  {
    return $this->model::where('name', $name)->get()->toArray();
  }

  public function create(array $data): array
  {
    $result = $this->model::create($data)->toArray();
    $data = [
      'sessionId' => $result['_id'],
      'phone' => $result['contact_identifier'], 
      'chatId' => $result['chatId']
    ];
    
    Redis::set($data['chatId'], json_encode($data));
    return $result;
  }
}