<?php

//$app->group(['prefix' => 'api/v1','namespace' => 'App\Http\Controllers'], function($app)
//{
//	$app->post('test','TestController@post');
// 
//	$app->put('test/{id}','TestController@update');
// 	 
//	$app->delete('test/{id}','TestController@delete');
// 
//	$app->get('test','TestController@get');
//});

$app->get('/test', function() use ($app){
    return response()->json('test');
});