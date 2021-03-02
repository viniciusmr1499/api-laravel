<?php 

namespace App\Services;

/**
 * Interface ServiceInterface
 * @package App\Services
 */
interface ServiceInterface 
{
    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array;

        
    /**
     * findAll
     *
     * @param  mixed $limit
     * @param  mixed $orderBy
     * @return array
     */
    public function findAll(int $limit = 10, array $orderBy = []): array;
       
    /**
     * findById
     *
     * @param  mixed $id
     * @return array
     */
    public function findById(string $id): array;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(string $id): bool;
    
    /**
     * destroyAll
     *
     * @return bool
     */
    public function destroyAll(): void;
}