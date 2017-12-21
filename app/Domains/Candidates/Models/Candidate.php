<?php

namespace Candidatozz\Domains\Candidates\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Candidatozz\Domains\Users\Models\User;

class Candidate extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =  [
        'first_name', 'last_name', 'email', 'gender', 'birth_date', 'cell_phone', 'curriculum_vitae'
    ];

    /**
     * The attributes dates
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'birth_date'];

    /**
     * Get relationship model Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set birth date
     *
     * @param $value
     */
    public function setBirthDateAttribute($value)
    {
        if ($value) {
            $this->attributes['birth_date'] = Carbon::createFromFormat('d/m/Y', $value);
        }
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAgeAttribute()
    {
        if ($this->birth_date) {
            return $this->birth_date->diffInYears(Carbon::now());
        }

        return null;
    }
}
