<?php

namespace Candidatozz\Support\Http\Controllers;

use Candidatozz\Support\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function response()
    {
        return app(Response::class);
    }
}
