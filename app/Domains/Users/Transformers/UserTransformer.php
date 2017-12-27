<?php

namespace Candidatozz\Domains\Users\Transformers;

use League\Fractal\TransformerAbstract;
use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Domains\Users\Transformers\RoleTransformer;
use Candidatozz\Domains\Candidates\Transformers\CandidateTransformer;

class UserTransformer extends TransformerAbstract
{
    /**
     * Include use data by default
     */
    protected $defaultIncludes = ['candidate', 'roles'];

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

    /**
     * Transform the User entity | Candidate
     *
     * @param User $user
     * @return array
     */
    public function includeCandidate(User $user)
    {
        if ($user->candidate) {
            return $this->item($user->candidate, new CandidateTransformer());
        }

        return null;
    }

    /**
     * Transform the User entity | Roles
     *
     * @param User $user
     * @return arrays
     */
    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer());
    }
}
