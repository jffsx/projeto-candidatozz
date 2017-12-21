<?php

namespace Candidatozz\Domains\Users\Transformers;

use League\Fractal\TransformerAbstract;
use Candidatozz\Domains\Users\Models\Role;

class RoleTransform extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array.
     *
     * @param  \Candidatozz\Domains\Users\Models\Role  $role
     * @return array
     */
    public function transform(Role $role)
    {
        return [
            'id'    => $role->id,
            'name'  => $role->name,
            'code'  => $role->code,
        ];
    }
}
