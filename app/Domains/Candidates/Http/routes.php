<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'candidates'], function () use ($router) {
    $router->get('/', 'CandidateController@index');
    $router->get('{id}', 'CandidateController@show');
    $router->post('/', 'CandidateController@store');
    $router->put('{id}', 'CandidateController@update');
    $router->delete('{id}', 'CandidateController@destroy');
    $router->get('/{id}/curriculum-download', 'CandidateController@curriculumDownload');
});
