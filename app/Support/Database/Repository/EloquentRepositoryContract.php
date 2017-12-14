<?php

namespace Candidatozz\Support\Database\Repository;

interface EloquentRepositoryContract
{
    /**
     * Get all
     *
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * Get paginate
     *
     * @param int $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, array $columns = ['*']);

    /**
     * Get by id
     *
     * @param  int $id
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * Create a new resource
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update resource
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, $id);

    /**
     * Delete resource
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);
}
