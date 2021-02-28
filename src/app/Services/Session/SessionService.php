<?php 

namespace App\Services\Session;

use App\Repositories\Session\SessionRepository;
use \App\Services\AbstractService;
use Illuminate\Http\Request;

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
    
  /**
   * showByName
   *
   * @param  mixed $request
   * @return array
   */
  public function showByName(Request $request): array
  {
    $name = $request->get('name');
    return $this->repository->showByName($name)->toArray();
  }
}