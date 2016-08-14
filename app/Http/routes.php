<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
@include('moduleroutes.php');
Route::get('/', 'UserController@getLogin');

Route::get('/restric',function(){

    return view('errors.blocked');

});

Route::controller('/user', 'UserController');
Route::controller('/dashboard', 'DashboardController');

Route::group(['middleware' => 'auth'], function()
{
    /*
    Route::get('core/elfinder', 'Core\ElfinderController@getIndex');
    Route::post('core/elfinder', 'Core\ElfinderController@getIndex');
    Route::controller('/dashboard', 'DashboardController');
    Route::controllers([
        'core/users'		=> 'Core\UsersController',
        'notification'		=> 'NotificationController',
        'core/logs'			=> 'Core\LogsController',
        'core/pages' 		=> 'Core\PagesController',
        'core/groups' 		=> 'Core\GroupsController',
        'core/template' 	=> 'Core\TemplateController',
    ]);
    */
});