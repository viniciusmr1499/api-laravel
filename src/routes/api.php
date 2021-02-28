<?php 

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 * ----------------------------------------------------------------------------
 * API ROUTES
 * ----------------------------------------------------------------------------
 * 
 * Here is where you can register API routes for your application.
 */

$router->group(['prefix' => 'api/sessions'], function () use ($router) {
  // $router->get('/', 'Session\SessionTmpController@index'); 
  $router->get('/', 'Session\SessionController@findAll'); 
  $router->get('/me', 'Session\SessionController@show');    

  $router->post('/', 'Session\SessionController@create');    
  // $router->delete('/{sessionId}', 'Session\SessionController@delete');
  // $router->delete('/{sessionId}', 'Session\SessionTmpController@destroy');
  // $router->put('/{sessionId}', 'Session\SessionTmpController@update');    
  // $router->delete('/', 'Session\SessionTmpController@destroyAll');

  // $router->post('/import', 'Session\SessionTmpController@upload');
});