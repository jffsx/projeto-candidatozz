<?php

namespace Candidatozz\Domains\Candidates\Specifications;

use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Support\Specifications\SpecificationContract;
use Candidatozz\Domains\Users\Specifications\Roles\AdministratorSpecification;

/**
 * class CandidateDeleteSpecification
 *
 * @package Candidatozz\Domains\Candidates\Specifications
 */
class CandidateDeleteSpecification implements SpecificationContract
{
    /**
     * @param  User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        return (new AdministratorSpecification())->isSatisfiedBy($user);
    }
}
