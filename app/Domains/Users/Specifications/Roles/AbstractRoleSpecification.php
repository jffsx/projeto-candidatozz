<?php

namespace Candidatozz\Domains\Users\Specifications\Roles;

use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Support\Specifications\SpecificationContract;

abstract class AbstractRoleSpecification implements SpecificationContract
{
    /**
     * Role code
     *
     * @var string
     */
    protected $role;

    /**
     * User has role
     *
     * @param  User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        return $user->hasRole($this->role);
    }
}
