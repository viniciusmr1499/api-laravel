<?php 

namespace App\Services\Session;

use App\Repositories\Session\SessionRepository;
use \App\Services\AbstractService;

/**
 * SessionService
 */
class SessionService extends AbstractService 
{  
  /**
   * __construct
   *
   * @param  mixed $sessionRepository
   * @return void
   */
  public function __construct(SessionRepository $sessionRepository)
  {
    $this->repository = $sessionRepository;
  }
}