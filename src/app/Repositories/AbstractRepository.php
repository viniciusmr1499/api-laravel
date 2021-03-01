<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package App\Repositories
 */
abstract class AbstractRepository implements RepositoryInterface
{
  protected Model $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function create(array $data): array
  {
    return $this->model::create($data)->toArray();
  }
  
  public function findAll(int $limit = 10, array $orderBy = []): array
  {
    return $this->model::all()->toArray();
  }
  
  public function findById(int $id): array
  {
    return $this->model::findOrFail($id)->toArray();
  }

  public function update(int $id, array $data): bool
  { 
    $result = $this->model::find($id)
      ->update($data);

    return $result ? true : false;
  }
  
  public function delete(string $id): bool
  {
    return $this->model::destroy($id) ? true : false;
  }
}
