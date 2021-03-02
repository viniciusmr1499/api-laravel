<?php 

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 * ----------------------------------------------------------------------------
 * API ROUTES
 * ----------------------------------------------------------------------------
 * Here is where you can register API routes for your application.
 */

$router->group(['prefix' => 'api/sessions'], function () use ($router) {
  $router->get('/', 'Session\SessionController@findAll'); 
  $router->get('/contact', 'Session\SessionController@findByName'); 
  $router->get('/{id}', 'Session\SessionController@findById');
  
  $router->post('/', 'Session\SessionController@create'); 
  $router->post('/import', 'Session\SessionController@handleFileUpload'); 
  $router->delete('/{id}', 'Session\SessionController@delete'); 
  $router->delete('/', 'Session\SessionController@destroyAll'); 
});