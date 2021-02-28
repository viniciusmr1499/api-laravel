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
   * @param Request $request
   * @return JsonResponse
   */ 
  public function create(Request $request): JsonResponse;

  /**
   * @return JsonResponse
   */
  public function findAll(Request $request): JsonResponse;

  /**
   * @param int $id
   * @return JsonResponse
   */
  public function findById(Request $request, int $id): JsonResponse;

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
}