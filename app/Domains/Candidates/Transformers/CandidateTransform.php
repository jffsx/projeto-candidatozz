<?php

namespace Candidatozz\Domains\Candidates\Transformers;

use Storage;
use League\Fractal\TransformerAbstract;
use Candidatozz\Domains\Candidates\Models\Candidate;

class CandidateTransform extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array.
     *
     * @param  \Candidatozz\Domains\Candidates\Models\Candidate  $candidate
     * @return array
     */
    public function transform(Candidate $candidate)
    {
        return [
            'id'                => $candidate->id,
            'first_name'        => $candidate->first_name,
            'last_name'         => $candidate->last_name,
            'email'             => $candidate->email,
            'birth_date'        => $candidate->birth_date ? $candidate->birth_date->format('d/m/Y') : '',
            'gender'            => $candidate->gender,
            'gender_name'       => $candidate->gender == 'male' ? 'Masculino' : 'Feminino',
            'cell_phone'        => $candidate->cell_phone,
            // 'curriculum_vitae'  => $candidate->curriculum_vitae,
            'created_at'        => $candidate->created_at->format('d/m/Y H:i'),
            'updated_at'        => $candidate->updated_at->format('d/m/Y H:i')
        ];
    }
}
