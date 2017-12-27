<?php

namespace Candidatozz\Domains\Users\Specifications\Roles;

use Candidatozz\Domains\Users\Models\Role;

/**
 * class AdministratorSpecification
 *
 * @package Candidatozz\Domains\Users\Specifications\Roles
 */
class AdministratorSpecification extends AbstractRoleSpecification
{
    /**
     * Access role
     *
     * @var string
     */
    protected $role = Role::ROLE_ADMIN;
}
