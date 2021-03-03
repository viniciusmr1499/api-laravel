<?php

namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */

interface RepositoryInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array;

    /**
     * @param int $limit
     * @param array $orderBy
     * @return array
     */
    public function findAll(int $limit = 10, array $orderBy = []): array;
        
    /**
     * findByUuid
     *
     * @param  mixed $id
     * @return array
     */
    public function findById(string $id): array;
        
    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(string $id): bool;
    
    /**
     * destroyAll
     *
     * @return array
     */
    public function destroyAll(): void;
}
