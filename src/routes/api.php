<?php 

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 * ----------------------------------------------------------------------------
 * API ROUTES
 * ----------------------------------------------------------------------------
 * 
 * Here is where you can register API routes for your application. These routes
 * are loaded by the RouteServiceProvider within a group which is assigned the 
 * "API" middleware group. Enjoy building your API
 */

$router->group(['prefix' => 'api/sessions'], function () use ($router) {
  $router->get('/', 'Session\SessionController@index'); 
  $router->get('/me', 'Session\SessionController@show');    

  $router->post('/', 'Session\SessionController@store');    
  $router->put('/{sessionId}', 'Session\SessionController@update');    
  $router->delete('/{sessionId}', 'Session\SessionController@destroy');
  $router->delete('/', 'Session\SessionController@destroyAll');

  $router->post('/import', 'Session\SessionController@upload');
});