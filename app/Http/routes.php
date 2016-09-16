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
Route::get('/calender', 'EventController@getShowCalendar');
Route::get('/receipt', 'FinancialController@getReceipt');

Route::get('/restric',function(){

    return view('errors.blocked');

});

Route::controller('/user', 'UserController');

Route::group(['middleware' => 'auth'], function()
{
    Route::controller('/dashboard', 'DashboardController');
    Route::controller('/student', 'StudentController');
    Route::controller('/teacher', 'TeacherController');
    Route::controller('/division', 'DivisionController');
    Route::controller('/parents', 'ParentController');
    Route::controller('/class', 'ClassController');
    Route::controller('/subject', 'SubjectController');
    Route::controller('/event', 'EventController');
    Route::controller('/news', 'NewsController');
    Route::controller('/period', 'PeriodController');
    Route::controller('/schedule', 'ScheduleController');
    Route::controller('/gradebook', 'MastergradebookController');
    Route::controller('/gradesheet', 'GradeController');
    Route::controller('/setting', 'GeneralsettingController');
    Route::controller('/finance', 'FinancialController');
    Route::controller('/imagecrop', 'CropAvatarController');

});