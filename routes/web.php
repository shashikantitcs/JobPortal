<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// login route

Route::get('getProductdata/{getProductdata}',['uses'=>'DepartmentController@getProductdata']);
Route::post('createDepartment',['uses'=>'DepartmentController@createDepartment']);

Route::post('updateProduct',['uses'=>'DepartmentController@updateProduct']);
Route::get('deleteDepatment/{deleteDepatment}',['uses'=>'DepartmentController@deleteDepatment']);


Route::post('uploadimages',['as' => 'uploadimages.upload','uses'=>'DepartmentController@uploadimages']);



Route::group(['middleware' => 'web'], function() {

Route::get('home',['as' => 'home.index','uses'=>'HomeController@index']);

Route::get('captchaRefresh',['as' => 'captcha.refresh','uses'=>'LoginController@captchaRefresh']);

Route::get('login',['as' => 'login.index','uses'=>'LoginController@index']);

Route::get('logout', ['as' => 'user.logout', 'uses' => 'LoginController@logout']);

Route::post('login/attemptLogin',['as' => 'login.attemptLogin','uses'=>'LoginController@attemptLogin']);

Route::get('/resetpassword/{email}/{key}', ['as' => 'user.resetpassword', 'uses' => 'UserController@resetPassword']);

Route::match(['get', 'post'], '/forgotpassword', ['as' => 'user.forgotpassword', 'uses' => 'UserController@forgotPassword']);

Route::post('updatepassword', ['as' => 'user.updatepassword', 'uses' => 'UserController@updatePassword']);

//for admin route start

Route::post('/employer',['as' => 'employer.store','uses'=>'EmployerRegistration@store']);

Route::group(['middleware' => ['check.sessionTimeout','check.auth&access:E']], function(){
// user Route management


    Route::get('/user',['as' => 'user.index','uses'=>'UserController@index']);

    Route::post('/user',['as' => 'user.store','uses'=>'UserController@store']);

    Route::post('user/getSectionDetail',['as' => 'user.getSectionDetail','uses'=>'UserController@getSectionDetail']);

    Route::get('/user/create',['as' => 'user.create','uses'=>'UserController@create']);

    Route::get('/user/{user}/edit',['as' => 'user.edit','uses'=>'UserController@edit']);

    Route::put('/user/{user}',['as' => 'user.update','uses'=>'UserController@update']);

    Route::delete('/user/{user}',['as' => 'user.destroy','uses'=>'UserController@destroy']);
// user Route management
// dartment Route management
Route::get('/department',['as' => 'department.index','uses'=>'DepartmentController@index']);
Route::post('/department',['as' => 'department.store','uses'=>'DepartmentController@store']);
Route::get('/department/create',['as' => 'department.create','uses'=>'DepartmentController@create']);

Route::get('/department/{department}/edit',['as' => 'department.edit','uses'=>'DepartmentController@edit']);
Route::put('/department/{department}',['as' => 'department.update','uses'=>'DepartmentController@update']);
Route::delete('/department/{department}',['as' => 'department.destroy','uses'=>'DepartmentController@destroy']);
// dartment Route management

// section Route management
Route::get('/section',['as' => 'section.index','uses'=>'SectionController@index']);
Route::post('/section',['as' => 'section.store','uses'=>'SectionController@store']);
Route::get('/section/create',['as' => 'section.create','uses'=>'SectionController@create']);
// Route::get('/section/{section}',['as' => 'section.show','uses'=>'SectionController@show']);
Route::get('/section/{section}/edit',['as' => 'section.edit','uses'=>'SectionController@edit']);
Route::put('/section/{section}',['as' => 'section.update','uses'=>'SectionController@update']);
Route::delete('/section/{section}',['as' => 'section.destroy','uses'=>'SectionController@destroy']);
// section Route management

});
//for admin route end

// for meeting admin and admin
Route::group(['middleware' => ['check.sessionTimeout','check.auth&access:E']], function(){
    Route::post('/meeting',['as' => 'meeting.store','uses'=>'MeetingMasterController@store']);
    Route::get('/meeting/create',['as' => 'meeting.create','uses'=>'MeetingMasterController@create']);
    Route::get('/meeting/{meeting}/edit',['as' => 'meeting.edit','uses'=>'MeetingMasterController@edit']);
    Route::put('/meeting/{meeting}',['as' => 'meeting.update','uses'=>'MeetingMasterController@update']);

    Route::delete('/meeting/{meeting}',['as' => 'meeting.destroy','uses'=>'MeetingMasterController@destroy']);
    // meeting master route
});
// for meeting admin and admin  

// for meeting admin and admin and user
//Route::group(['middleware' => ['check.sessionTimeout','check.auth&access:A,MA,U']], function(){
Route::group(['middleware' => ['check.sessionTimeout','check.auth&access:E']], function(){
// JOB AD POST 

Route::get('/fresherjobad',['as' => 'jobad.index','uses'=>'JobadController@fresherjobad']);
Route::get('/deputationjobad',['as' => 'jobad.deputationjobad','uses'=>'JobadController@deputationjobad']);

Route::get('/jobad/create',['as' => 'jobad.create','uses'=>'JobadController@create']);
Route::post('jobad',['as' => 'jobad.store','uses'=>'JobadController@store']);


    // agenda master
Route::get('faq',['as' => 'user.faq','uses'=>'UserController@faq']);

Route::get('passwordreset',['as' => 'user.passwordreset','uses'=>'UserController@passwordreset']);
Route::post('passwordreset',['as' => 'user.passwordresetStore','uses'=>'UserController@passwordresetStore']);
    // meeting master route
Route::get('/meeting',['as' => 'meeting.index','uses'=>'MeetingMasterController@index']);


// meeting schedule
Route::get('/meetingschedule/{meetingschedule}/edit',['as' => 'meetingschedule.edit','uses'=>'MeetingScheduleController@edit']);
Route::put('/meetingschedule/{meetingschedule}',['as' => 'meetingschedule.update','uses'=>'MeetingScheduleController@update']);
// meeting schedule

// agenda master
Route::get('agenda/{meetingId}/create',['as' => 'agenda.addagenda','uses'=>'AgendaMasterController@create']);
Route::post('agenda',['as' => 'agenda.store','uses'=>'AgendaMasterController@store']);
Route::get('agenda/{agenda}/edit',['as' => 'agenda.edit','uses'=>'AgendaMasterController@edit']);

Route::put('agenda/{agenda}',['as' => 'agenda.update','uses'=>'AgendaMasterController@update']);
Route::post('agenda/getAgendaUser',['as' => 'agenda.getAgendaU','uses'=>'AgendaMasterController@getAgendaUser']);

Route::delete('/agenda/{agenda}',['as' => 'agenda.destroy','uses'=>'AgendaMasterController@destroy']);

Route::post('agenda/getSectionByDepartment',['as' => 'user.getSectionByDepartment','uses'=>'AgendaMasterController@getSectionByDepartment']);
// agenda master

//agenda task
Route::post('agendatask/getAgendatask',['as' => 'agendatask.getAgendatask','uses'=>'AgendaTaskController@getAgendatask']);
Route::post('agendatask',['as' => 'agendatask.store','uses'=>'AgendaTaskController@store']);
Route::put('agendatask/{agendatask}',['as' => 'agendatask.update','uses'=>'AgendaTaskController@update']);
Route::post('agendatask/getAgendaDetail',['uses'=>'AgendaTaskController@getAgendaDetail']);
Route::post('agendatask/edit/{agendatask}',['as' => 'agendatask.edit','uses'=>'AgendaTaskController@edit']);
Route::post('getAgendatask',['as' => 'agendatask.getAgendatask','uses'=>'AgendaTaskController@getAgendatask']);

Route::match(['get', 'post'],'agendatask/create/{meetingId}',['as' => 'agendatask.create','uses'=>'AgendaTaskController@create'])->where('meetingId', '[0-9]+');
//agenda task

//agenda task action
Route::post('agendataskaction',['as' => 'agendataskaction.create','uses'=>'AgnedaTaskAction@store']);

Route::post('getAgendataskaction',['as' => 'agendataskaction.getAgendaActionList','uses'=>'AgnedaTaskAction@getAgendaTaskActionList']);
Route::post('updateAgendaTaskS',['as' => 'agendataskaction.updateAgendaTaskS','uses'=>'AgnedaTaskAction@updateTaskStatus']);
//agenda task action


// dashbaord
Route::get('dashboard',['as' => 'dashboard.index','uses'=>'DashboardController@index']);

Route::match(['get','post'],'getCalendarData',['as' => 'dashboard.getCalendarData','uses'=>'DashboardController@getCalendarData']);

});

// for meeting admin and admin and user








// meeting schedule
// Route::get('meetingschedule',['as' => 'meetingschedule.index','uses'=>'MeetingScheduleController@index']);
// Route::post('/meetingschedule',['as' => 'meetingschedule.store','uses'=>'MeetingScheduleController@store']);




// agenda master

// Route::get('agenda/{meetingId?}',['as' => 'agenda.index','uses'=>'AgendaMasterController@index'])->where('meetingId', '[0-9]+');

// Route::get('agenda/create',['as' => 'agenda.create','uses'=>'AgendaMasterController@create']);





//agenda task
// Route::get('agendatask/{amId?}',['as' => 'agendatask.index','uses'=>'AgendaTaskController@index'])->where('amId', '[0-9]+');



// agendatask store




// dashbaord
// Route::get('dashboard',['as' => 'dashboard.adminindex','uses'=>'DashboardController@adminindex']);
// Route::get('dashboardmeetingadmin',['as' => 'dashboard.meetingadminindex','uses'=>'DashboardController@meetingadminindex']);
// Route::get('userdashboard',['as' => 'dashboard.userindex','uses'=>'DashboardController@userindex']);
// // dashbaord



});
