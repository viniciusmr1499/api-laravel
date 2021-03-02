<?php 

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

  /**
   * Interface ControllerInterface
   * @package App\Http\Controllers
   */
interface ControllerInterface 
{
  /**
   * create
   *
   * @param  mixed $request
   * @return JsonResponse
   */
  public function create(Request $request): JsonResponse;

  /**
   * @return JsonResponse
   */
  public function findAll(Request $request): JsonResponse;
    
  /**
   * findById
   *
   * @param  mixed $request
   * @param  mixed $id
   * @return JsonResponse
   */
  public function findById(Request $request, string $id): JsonResponse;

  /**
   * @param int $id
   * @param Request $request
   * @return JsonResponse
   */
  public function update(Request $request, int $id): JsonResponse;

  /**
   * @param int $id
   * @return JsonResponse
   */
  public function delete(Request $request, string $id): JsonResponse;
  
  /**
   * destroyAll
   *
   * @param  mixed $request
   * @return JsonResponse
   */
  public function destroyAll(Request $request): JsonResponse;
}