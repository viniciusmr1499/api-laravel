<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\AbstractController;
use App\Services\Session\SessionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SessionController extends AbstractController {  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct(SessionService $service) {
    $this->service = $service;
  }
  
  /**
   * show
   *
   * @param  mixed $request
   * @return void
   */
  public function showByName(Request $request): array
  {
    try {
    //   $session = $this->service->showByName($request);
    }
    catch(Exception $e) {
      return $this->errorResponse($e, Response::HTTP_BAD_REQUEST);
    }
    // return $this->successResponse($session, Response::HTTP_OK);
  }
}
