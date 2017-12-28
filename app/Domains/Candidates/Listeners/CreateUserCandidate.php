<?php

namespace Candidatozz\Domains\Candidates\Listeners;

use Candidatozz\Domains\Candidates\Events\CandidateCreated;
use Candidatozz\Domains\Users\Contracts\UserServiceContract;
use Candidatozz\Domains\Candidates\Notifications\UserNeedsConfirmation;

/**
 * class CreateUserCandidate
 *
 * @package \Candidatozz\Domains\Candidates\Listeners
 */
class CreateUserCandidate
{
    /**
     * User service instance
     *
     * @var Candidatozz\Domains\Users\Contracts\UserServiceContract
     */
    protected $userService;

    /**
     * Create the event listener.
     *
     * @param UserServiceContract $userService
     * @return void
     */
    public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     *
     * @param  CandidateCreated  $event
     * @return void
     */
    public function handle(CandidateCreated $event)
    {
        $user = $this->userService->create([
            'first_name' => $event->candidate->first_name,
            'last_name' => $event->candidate->last_name,
            'email' => $event->candidate->email,
            'password' => app('hash')->make($event->candidate->first_name),
        ]);

        $event->candidate->user()->associate($user);
        $event->candidate->save();
        
        $user->notify(new UserNeedsConfirmation());
    }
}
