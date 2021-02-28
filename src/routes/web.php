<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    // phpinfo();
    return $router->app->version();
});

$router->group(['prefix' => 'courses'], function () use ($router) {
    $router->get('/', 'Course\CourseController@findAll');
    $router->get('/{courseId}', 'Course\CourseController@findById');

    /** TESTE */
    // $router->get('/', 'CourseController@index');    
    // $router->get('/{courseId}', 'CourseController@show');    
    // $router->post('/', 'CourseController@store');    
    // $router->put('/{courseId}', 'CourseController@update');    
    // $router->delete('/{courseId}', 'CourseController@destroy');    
});