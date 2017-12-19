<?php

namespace Candidatozz\Domains\Users\Contracts;

interface UserRepositoryContract
{
    /**
     * Get all
     *
     * @return mixed
     */
    public function all();

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
    public function find($id);

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
     * @return mixed
     */
    public function delete($id);
}
