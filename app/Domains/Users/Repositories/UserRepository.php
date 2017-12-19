<?php

namespace Candidatozz\Domains\Users\Repositories;

use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Support\Database\Repository\EloquentRepository as BaseRepository;
use Candidatozz\Domains\Users\Contracts\UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * Specify model class name
     *
     * @return Candidatozz\Domains\Users\Models\User
     */
    function model()
    {
        return User::class;
    }
}
