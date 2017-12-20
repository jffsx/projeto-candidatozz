<?php

namespace Candidatozz\Domains\Users\Transformers;

use League\Fractal\TransformerAbstract;
use Candidatozz\Domains\Users\Models\User;

class UserTransform extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array.
     *
     * @param  \Candidatozz\Domains\Users\Models\User  $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'                => $user->id,
            'first_name'        => $user->first_name,
            'last_name'         => $user->last_name,
            'email'             => $user->email,
            'active'            => $user->active,
            'active_name'       => $user->active ? 'Ativo' : 'Inativo',
            'created_at'        => $user->created_at->format('d/m/Y H:i'),
            'updated_at'        => $user->updated_at->format('d/m/Y H:i')
        ];
    }
}
