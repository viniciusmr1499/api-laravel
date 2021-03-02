<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\AbstractController;
use App\Services\Session\SessionService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * SessionController
 */
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
   * findByName
   *
   * @param  mixed $request
   * @return JsonResponse
   */
  public function findByName(Request $request): JsonResponse
  {
    try {
      $session = $this->service->findByName($request->get('name'));
      $response = $this->successResponse($session, Response::HTTP_OK);
    } catch(Exception $e) {
      $response = $this->errorResponse($e);  
    }

    return response()->json($response, $response['status_code']);
  }
  
  /**
   * handleFileUpload
   *
   * @param  mixed $request
   * @return JsonResponse
   */
  public function handleFileUpload(Request $request): JsonResponse
  {
    try {
      $this->service->handleFileUpload($request);
      $response = $this->successResponse(['message' => 'Upload successfully'], Response::HTTP_OK);
    } catch(Exception $e) {
      $response = $this->errorResponse($e);  
    }

    return response()->json($response, $response['status_code']);
  }
}
