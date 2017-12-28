<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

$app->withFacades(true, [
    'Illuminate\Support\Facades\Notification' => 'Notification',
    'Illuminate\Support\Facades\Storage' => 'Storage',
]);

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Candidatozz\Support\ExceptionHandler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Candidatozz\Support\ConsoleKernel::class
);

$app->singleton(
    Illuminate\Contracts\Filesystem\Factory::class,
    function ($app) {
        return new Illuminate\Filesystem\FilesystemManager($app);
    }
);

$app->alias('mailer', Illuminate\Contracts\Mail\Mailer::class);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
   Nord\Lumen\Cors\CorsMiddleware::class
]);

$app->routeMiddleware([
    'auth' => Candidatozz\Support\Http\Middleware\Authenticate::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(Illuminate\Filesystem\FilesystemServiceProvider::class);
$app->register(Illuminate\Notifications\NotificationServiceProvider::class);
$app->register(Illuminate\Mail\MailServiceProvider::class);
$app->register(Candidatozz\Support\Providers\AppServiceProvider::class);
$app->register(Candidatozz\Support\Providers\AuthServiceProvider::class);
$app->register(Candidatozz\Domains\Candidates\Providers\DomainServiceProvider::class);
$app->register(Candidatozz\Domains\Users\Providers\DomainServiceProvider::class);
$app->register(Nord\Lumen\Cors\CorsServiceProvider::class);
$app->register(Laravel\Passport\PassportServiceProvider::class);
$app->register(Dusterio\LumenPassport\PassportServiceProvider::class);

$app->configure('auth');
$app->configure('cors');
$app->configure('filesystems');
$app->configure('mail');

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'middleware' => 'auth',
    'prefix' => 'api/v1',
    'namespace' => 'Candidatozz\Domains\Candidates\Http\Controllers',
], function ($router) {
    require __DIR__.'/../app/Domains/Candidates/Http/routes.php';
});

$app->router->group([
    'middleware' => 'auth',
    'prefix' => 'api/v1',
    'namespace' => 'Candidatozz\Domains\Users\Http\Controllers',
], function ($router) {
    require __DIR__.'/../app/Domains/Users/Http/routes.php';
});

return $app;
