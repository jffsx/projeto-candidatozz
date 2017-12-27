<?php

namespace Candidatozz\Support\Specifications;

use Candidatozz\Domains\Users\Models\User;

interface SpecificationContract
{
    /**
     * @param  User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user);
}
