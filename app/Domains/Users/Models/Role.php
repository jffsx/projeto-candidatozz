<?php

namespace Candidatozz\Domains\Users\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN        = 'administrador';
    const ROLE_CANDIDATE    = 'candidato';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

}
