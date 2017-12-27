<?php

namespace Candidatozz\Support\Specifications;

use Candidatozz\Domains\Users\Models\User;

/**
 * Class AndSpecification
 * @package Candidatozz\Support\Specifications
 */
class AndSpecification implements SpecificationContract
{
    /**
     * @var SpecificationContract[]
     */
    private $specifications;

    /**
     * AndSpecification constructor.
     *
     * @param SpecificationContract[] ...$specifications
     */
    public function __construct(SpecificationContract ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * If all specifications are true
     *
     * @param  User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($user)) {
                return false;
            }
        }
        
        return true;
    }
}
