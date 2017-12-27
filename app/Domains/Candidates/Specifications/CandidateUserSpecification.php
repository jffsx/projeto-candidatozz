<?php

namespace Candidatozz\Domains\Candidates\Specifications;

use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Domains\Candidates\Models\Candidate;
use Candidatozz\Support\Specifications\SpecificationContract;

/**
 * class CandidateUserSpecification
 *
 * @package Candidatozz\Domains\Candidates\Specifications
 */
class CandidateUserSpecification implements SpecificationContract
{
    /**
     * @var \Candidatozz\Domains\Candidates\Models\Candidate
     */
    private $candidate;

    /**
     * Candidate user specification constructor.
     *
     * @param \Candidatozz\Domains\Candidates\Models\Candidate $candidate
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * @param  User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        return $this->candidate->user_id === $user->id;
    }
}
