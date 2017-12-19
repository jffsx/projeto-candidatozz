<?php

namespace Candidatozz\Support\Http\Controllers;

use Candidatozz\Support\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * Get responses
     * 
     * @return Candidatozz\Support\Http\Response
     */
    public function response()
    {
        return app(Response::class);
    }
}
