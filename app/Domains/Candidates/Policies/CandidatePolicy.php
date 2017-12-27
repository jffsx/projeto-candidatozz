<?php

namespace Candidatozz\Domains\Candidates\Policies;

use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Domains\Candidates\Models\Candidate;
use Candidatozz\Support\Specifications\OrSpecification;
use Candidatozz\Domains\Candidates\Specifications\CandidateListSpecification;
use Candidatozz\Domains\Candidates\Specifications\CandidateCreateSpecification;
use Candidatozz\Domains\Candidates\Specifications\CandidateShowSpecification;
use Candidatozz\Domains\Candidates\Specifications\CandidateUpdateSpecification;
use Candidatozz\Domains\Candidates\Specifications\CandidateDeleteSpecification;
use Candidatozz\Domains\Candidates\Specifications\CandidateCurriculumDownloadSpecification;
use Candidatozz\Domains\Candidates\Specifications\CandidateUserSpecification;

/**
 * class CandidatePolicy
 *
 * @package Candidatozz\Domains\Candidates\Policies
 */
class CandidatePolicy
{
    /**
     * Ability list candidates
     *
     * @param  User $user
     * @return bool
     */
    public function index(User $user)
    {
        return (new CandidateListSpecification())->isSatisfiedBy($user);
    }

    /**
     * Ability create candidate
     *
     * @param  User $user
     * @return bool
     */
    public function create(User $user)
    {
        return (new CandidateCreateSpecification())->isSatisfiedBy($user);
    }

    /**
     * Ability show candidate
     *
     * @param  User $user
     * @return bool
     */
    public function show(User $user, Candidate $candidate)
    {
        return (new OrSpecification(
            new CandidateShowSpecification(),
            new CandidateUserSpecification($candidate)
        ))->isSatisfiedBy($user);
    }

    /**
     * Ability update candidate
     *
     * @param  User $user
     * @return bool
     */
    public function update(User $user)
    {
        return (new CandidateUpdateSpecification())->isSatisfiedBy($user);
    }

    /**
     * Ability delete candidate
     *
     * @param  User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return (new CandidateDeleteSpecification())->isSatisfiedBy($user);
    }

    /**
     * Ability curriculum download candidate
     *
     * @param  User $user
     * @return bool
     */
    public function curriculumDownload(User $user, Candidate $candidate)
    {
        return (new OrSpecification(
            new CandidateCurriculumDownloadSpecification(),
            new CandidateUserSpecification($candidate)
        ))->isSatisfiedBy($user);
    }
}
