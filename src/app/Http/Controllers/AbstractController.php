<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\ControllerInterface;
use App\Services\ServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Exception;

/**
 * Class AbstractController
 * @package App\Http\Controllers
 */
class AbstractController extends BaseController implements ControllerInterface
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
    
  /**
   * create
   *
   * @param  mixed $request
   * @return JsonResponse
   */
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
    
  /**
   * findAll
   *
   * @param  mixed $request
   * @return JsonResponse
   */
  public function findAll(Request $request): JsonResponse
  {
    try {
      $limit = $request->get('page') ? $request->get('page') : 10;
      $result = $this->service->findAll($limit);
      $response = $this->successResponse($result, Response::HTTP_OK);
    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response, $response['status_code']);
  } 
   
  /**
   * findById
   *
   * @param  mixed $request
   * @param  mixed $id
   * @return JsonResponse
   */
  public function findById(Request $request, string $id): JsonResponse
  {
    try {
      $result = $this->service->findById($id);
      $response = $this->successResponse($result, Response::HTTP_OK);
    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response, $response['status_code']);
  }
    
  /**
   * update
   *
   * @param  mixed $request
   * @param  mixed $id
   * @return JsonResponse
   */
  public function update(Request $request, int $id): JsonResponse
  {
    try {
      $this->service->update($id, $request->all());

      $result = $this->service->findById($id);
      $response = $this->successResponse($result, Response::HTTP_OK);
    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response, $response['status_code']);
  }
    
  /**
   * delete
   *
   * @param  mixed $request
   * @param  mixed $id
   * @return JsonResponse
   */
  public function delete(Request $request, string $id): JsonResponse
  {
    try {
      $this->service->delete($id);
      $response = $this->successResponse(['message' => 'Deleted with success'], Response::HTTP_OK);

    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response, $response['status_code']);
  }
  
  /**
   * destroyAll
   *
   * @param  mixed $request
   * @return JsonResponse
   */
  public function destroyAll(Request $request): JsonResponse
  {
    try {
      $this->service->destroyAll();
      $response = $this->successResponse(['message' => 'All sessions ended'], Response::HTTP_OK);

    } catch(Exception $e) {
      $response = $this->errorResponse($e);
    }

    return response()->json($response, $response['status_code']);
  }
    
  /**
   * successResponse
   *
   * @param  mixed $data
   * @param  mixed $statusCode
   * @return array
   */
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
  
  /**
   * errorResponse
   *
   * @param  mixed $e
   * @param  mixed $statusCode
   * @return array
   */
  protected function errorResponse(Exception $e, int $statusCode = Response::HTTP_BAD_REQUEST): array
  {
    return [
      'status_code' => $statusCode,
      'error' => true,
      'error_description' => $e->getMessage(),
    ];
  }
}
