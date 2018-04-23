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

$router->get('/', function () use ($router) {
    return $router->app->version();
});



//$app->get('/post/{id}', ['middleware' => 'auth', function (Request $request, $id) {
//    $user = Auth::user();
//
//    $user = $request->user();
//
//    
//}]);

$router->get('home', function() {
    return 'OK :)!';
});

$router->get('/test', function() {
    return response()->json('test');
});

//$router->post('/test', function(){   ['middleware' => ['key', 'name']]role:editor'
//    var_dump('post');
//});

$router->group(['prefix' => 'api/v1/',], function($router) {
    
    $router->put('test/update/{id}/{key}',['middleware' => 'example', 'uses' => 'TestController@update']);//'middleware' => 'key:est',  
 
    $router->post('test/create/{key}', 'TestController@create');

    $router->delete('test/delete/{id}/{key}','TestController@delete');

    $router->get('test/read/', 'TestController@read');
    
    
});
