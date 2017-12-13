<?php

namespace Candidatozz\Domains\Candidates\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class File
 *
 * @package Candidatozz\Domains\Candidates\Models
 */
class File extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =  ['first_name', 'last_name', 'email', 'gender', 'cell_phone', 'curriculum'];
    
    /**
     * The attributes dates
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'birth_date'];

}
