<?php

namespace Candidatozz\Domains\Users\Specifications\Roles;

use Candidatozz\Domains\Users\Models\Role;

/**
 * class CandidateSpecification
 *
 * @package Candidatozz\Domains\Users\Specifications\Roles
 */
class CandidateSpecification extends AbstractRoleSpecification
{
    /**
     * Access role
     *
     * @var string
     */
    protected $role = Role::ROLE_CANDIDATE;
}
