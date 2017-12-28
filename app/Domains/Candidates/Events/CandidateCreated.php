<?php

namespace Candidatozz\Domains\Candidates\Events;

use Candidatozz\Domains\Candidates\Models\Candidate;
use Illuminate\Queue\SerializesModels;

/**
 * class CandidateCreated
 *
 * @package \Candidatozz\Domains\Candidates\Events
 */
class CandidateCreated
{
    use SerializesModels;

    /**
     * candidate instance
     *
     * @var Candidate
     */
    public $candidate;

    /**
     * Create a new event instance.
     *
     * @param  Candidate  $candidate
     * @return void
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }
}
