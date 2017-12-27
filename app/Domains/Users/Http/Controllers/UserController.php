<?php

namespace Candidatozz\Domains\Users\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Candidatozz\Support\Http\Controllers\Controller;
use Candidatozz\Support\Database\Repository\ModelNotFoundException;
use Candidatozz\Domains\Users\Contracts\UserServiceContract;
use Candidatozz\Domains\Users\Transformers\UserTransformer;

class UserController extends Controller
{
    /**
     * User service.
     *
     * @var userServiceContract
     */
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @param userServiceContract $userService
     * @return void
     */
    public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function me(Request $request)
    {
        return $this->response()->item($request->user(), new UserTransformer);
    }
}
