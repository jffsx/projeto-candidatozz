<?php

namespace Candidatozz\Domains\Candidates\Repositories;

use Candidatozz\Domains\Candidates\Models\Candidate;
use Candidatozz\Support\Database\Repository\EloquentRepository as BaseRepository;
use Candidatozz\Domains\Candidates\Contracts\CandidateRepositoryContract;

class CandidateRepository extends BaseRepository implements CandidateRepositoryContract
{
    /**
     * Specify model class name
     *
     * @return Candidatozz\Domains\Candidates\Models\Candidate
     */
    function model()
    {
        return Candidate::class;
    }
}
