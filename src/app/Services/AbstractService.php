<?php 

namespace App\Services;

use App\Services\ServiceInterface;
use App\Repositories\RepositoryInterface;

/**
 * Class AbstractService
 * @package App\Services
 */
abstract class AbstractService implements ServiceInterface
{
  protected RepositoryInterface $repository;

  public function __construct(RepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function create(array $data): array
  {
    return $this->repository->create($data);
  }
  
  public function findAll(int $limit = 10, array $orderBy = []): array
  {
    return $this->repository->findAll($limit, $orderBy);
  }
  
  public function findById(string $id): array
  {
    return $this->repository->findById($id);
  }
   
  public function update(int $id, array $data): bool
  {
    $result = $this->repository->update($id, $data);

    return $result ? true : false;
  }
  
  public function delete(string $id): bool
  {
    return $this->repository->delete($id);
  }

  public function destroyAll(): void
  {
    $this->repository->destroyAll();
  }
}