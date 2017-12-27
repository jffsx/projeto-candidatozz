<?php

namespace Candidatozz\Support\Specifications;

use Candidatozz\Domains\Users\Models\User;

/**
 * Class OrSpecification
 * @package Candidatozz\Support\Specifications
 */
class OrSpecification implements SpecificationContract
{
    /**
     * @var SpecificationContract[]
     */
    private $specifications;

    /**
     * OrSpecification constructor.
     *
     * @param SpecificationContract[] ...$specifications
     */
    public function __construct(SpecificationContract ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * If at least one specification is true
     *
     * @param  User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($user)) {
                return true;
            }
        }
        
        return false;
    }
}
