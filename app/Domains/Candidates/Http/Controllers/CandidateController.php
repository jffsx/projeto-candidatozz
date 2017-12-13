<?php

namespace Candidatozz\Domains\Http\Controllers;

use Candidatozz\Support\Http\Controllers\Controller;
use Candidatozz\Domains\Candidates\Contracts\CandidateServiceContract;

class CandidateController extends Controller
{
    /**
     * Candidate service.
     *
     * @var CandidateServiceContract
     */
    protected $candidateService;

    /**
     * Create a new controller instance.
     *
     * @param CandidateServiceContract $candidateService
     * @return void
     */
    public function __construct(CandidateServiceContract $candidateService)
    {
        $this->candidateService = $candidateService;
    }
}
