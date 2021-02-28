<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\ControllerInterface;
use App\Services\ServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * Class AbstractController
 * @package App\Http\Controllers
 */
abstract class AbstractController extends BaseController implements ControllerInterface
{
  /**
   * @param ServiceInterface $service
   */
  protected ServiceInterface $service;

  /**
   * @param array $searchFields
   */
  protected array $searchFields = [];

  /**
   * AbstractController constructor
   * @param ServiceInterface $service
   */
  public function __construct(ServiceInterface $service)
  { 
    $this->service = $service;
  }
  
  public function create(Request $request): JsonResponse
  {
    try {
      $result = $this->service->create($request->all());
      $response = $this->successResponse($result, Response::HTTP_CREATED);
    }catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response, $response['status_code']);
  }
  
  public function findAll(Request $request): JsonResponse
  {
    try {
      $result = $this->service->findAll();
      $response = $this->successResponse($result, Response::HTTP_OK);
    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }
    return response()->json($response);
  } 
 
  public function findById(Request $request, int $id): JsonResponse
  {
    try {
      $result = $this->service->findById($id);
      $response = $this->successResponse($result, Response::HTTP_OK);
    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response);
  }
  
  public function update(Request $request, int $id): JsonResponse
  {
    try {
      $this->service->update($id, $request->all());

      $result = $this->service->findById($id);
      $response = $this->successResponse($result, Response::HTTP_OK);
    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response);
  }
  
  public function delete(Request $request, string $id): JsonResponse
  {
    try {
      $this->service->delete($id);
      $response = $this->successResponse([], Response::HTTP_OK);

    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response);
  }
  
  protected function successResponse(array $data = [], int $statusCode = Response::HTTP_OK): array
  {
    if(empty($data)) {
      return [
        'status_code' => $statusCode
      ];
    }

    return [
      'status_code' => $statusCode,
      'data' => $data,
    ];
  }

  protected function errorResponse(Exception $e, int $statusCode = Response::HTTP_BAD_REQUEST): array
  {
    return [
      'status_code' => $statusCode,
      'error' => true,
      'error_description' => $e->getMessage(),
    ];
  }
}
