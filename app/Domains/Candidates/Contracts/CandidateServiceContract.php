<?php

namespace Candidatozz\Domains\Candidates\Contracts;

use Illuminate\Http\UploadedFile;

interface CandidateServiceContract
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

    /**
     * Save curriculum vitae
     *
     * @param UploadedFile $file
     * @param int $id
     * @return mixed
     */
    public function saveCurriculum(UploadedFile $file, $id);
}
