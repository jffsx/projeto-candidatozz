<?php

namespace Candidatozz\Domains\Candidates\Services;

use Illuminate\Http\UploadedFile;
use Candidatozz\Domains\Candidates\Models\Candidate;
use Candidatozz\Domains\Candidates\Contracts\CandidateServiceContract;
use Candidatozz\Domains\Candidates\Contracts\CandidateRepositoryContract;

class CandidateService implements CandidateServiceContract
{
    /**
     * @var EasyCurriculo\Domains\Files\Repositories\FileRepository
     */
    private $candidateRepository;

    /**
     * Construct class
     *
     * @param CandidateRepositoryContract $candidateRepository
     */
    public function __construct(CandidateRepositoryContract $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    /**
     * Get all
     *
     * @return mixed
     */
    public function all()
    {
        return $this->candidateRepository->all();
    }

    /**
     * Get paginate
     *
     * @param int $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, array $columns = ['*'])
    {
        return $this->candidateRepository->paginate($limit, $columns);
    }

    /**
     * Get by id
     *
     * @param  int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->candidateRepository->find($id);
    }

    /**
     * Create a new resource
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->candidateRepository->create($attributes);
    }

    /**
     * Update resource
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return $this->candidateRepository->update($attributes, $id);
    }

    /**
     * Delete resource
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->candidateRepository->delete($id);
    }

    /**
     * Save curriculum vitae
     *
     * @param UploadedFile $file
     * @param int $id
     * @return void
     */
    public function saveCurriculum(UploadedFile $file, $id)
    {
        $curriculum = [
            'curriculum_vitae' => $file->store('candidates/curriculum_vitae')
        ];

        $this->candidateRepository->update($curriculum, $id);
    }
}
