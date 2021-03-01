<?php 

namespace App\Repositories\Session;

use App\Models\Session\Session;
use App\Repositories\AbstractRepository;

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
}