<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * AbstractRepository
 */
abstract class AbstractRepository implements RepositoryInterface
{
  protected Model $model;
  
  /**
   * __construct
   *
   * @param  mixed $model
   * @return void
   */
  public function __construct(Model $model)
  {
    $this->model = $model;
  }
  
  /**
   * create
   *
   * @param  mixed $data
   * @return array
   */
  public function create(array $data): array
  {
    return $this->model::create($data)->toArray();
  }
    
  /**
   * findAll
   *
   * @param  mixed $limit
   * @param  mixed $orderBy
   * @return array
   */
  public function findAll(int $limit = 10, array $orderBy = []): array
  {
    return $this->model::paginate($limit)->toArray();
  }
    
  /**
   * findByUuid
   *
   * @param  mixed $id
   * @return array
   */
  public function findById(string $id): array
  {
    return $this->model::find($id)->toArray();
  }
   
  /**
   * update
   *
   * @param  mixed $id
   * @param  mixed $data
   * @return bool
   */
  public function update(string $id, array $data): bool
  { 
    $result = $this->model::find($id)
      ->update($data);

    return $result ? true : false;
  }
    
  /**
   * delete
   *
   * @param  mixed $id
   * @return bool
   */
  public function delete(string $id): bool
  {
    return $this->model::destroy($id) ? true : false;
  }
  
  /**
   * destroyAll
   *
   * @return void
   */
  public function destroyAll(): void
  {
    $this->model::truncate();
  }
}
