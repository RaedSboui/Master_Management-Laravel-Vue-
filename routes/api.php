<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Auth */
Route::post('login', 'Back\AuthController@login');
Route::get('test', function () {
    broadcast(new App\Events\WebsocketEvent("some data"));
});

//Back
Route::group(['namespace'=>'Back', 'middleware'=>['jwtauth', 'isLocked', 'role:SUPER ADMIN,ADMIN']], function() {

    Route::post('checkToken', 'AuthController@checkToken');
    Route::post('logout', 'AuthController@logout');

    /* Dashboard */
    Route::get('dashboard', 'DashboardController@index');
    Route::post('/task', 'DashboardController@storeTask');
    Route::put('/task/{task}', 'DashboardController@updateTask');
    Route::delete('/task/{task}', 'DashboardController@destroyTask');

    /* Masters */
    Route::resource('masters', 'MasterController');
    Route::delete('masters/deleteMultiple/{masters}', 'MasterController@deleteMultiple');
    Route::get('masters/export/{masters}', 'MasterController@export');
    Route::post('masters/import', 'MasterController@import');

    /* Users */
    Route::resource('users', 'UserController');
    Route::delete('users/deleteMultiple/{users}', 'UserController@deleteMultiple');
    Route::get('users/export/{users}', 'UserController@export');
    Route::post('users/import', 'UserController@import');

    /* Diplomas */
    Route::resource('diplomas', 'DiplomaController');
    Route::delete('diplomas/deleteMultiple/{diplomas}', 'DiplomaController@deleteMultiple');
    Route::get('diplomas/export/{diplomas}', 'DiplomaController@export');
    Route::post('diplomas/import', 'DiplomaController@import');

    /* Subjects */
    Route::resource('subjects', 'SubjectController');
    Route::delete('subjects/deleteMultiple/{subjects}', 'SubjectController@deleteMultiple');
    Route::get('subjects/export/{subjects}', 'SubjectController@export');
    Route::post('subjects/import', 'SubjectController@import');

    /* Specialities */
    Route::resource('specialities', 'SpecialityController');
    Route::delete('specialities/deleteMultiple/{subjects}', 'SpecialityController@deleteMultiple');
    Route::get('specialities/export/{specialities}', 'SpecialityController@export');
    Route::post('specialities/import', 'SpecialityController@import');

    /* Establishments */
    Route::resource('establishments', 'EstablishmentController');
    Route::delete('establishments/deleteMultiple/{establishments}', 'EstablishmentController@deleteMultiple');
    Route::get('establishments/export/{establishments}', 'EstablishmentController@export');
    Route::post('establishments/import', 'EstablishmentController@import');

    /* Candidacies */
    Route::resource('candidacies', 'CandidacyController');
    Route::delete('candidacies/deleteMultiple/{candidacies}', 'CandidacyController@deleteMultiple');
    Route::get('candidacies/export/{candidacies}', 'CandidacyController@export');
    Route::post('candidacies/import', 'CandidacyController@import');

    /* Messages */
    Route::get('messages/{user}',  'MessageController@fetchMessages');
    Route::post('messages/{user}',  'MessageController@sendMessage');
});

//Front
Route::get('front', 'Front\FrontController@index');
Route::get('front/masters', 'Front\FrontController@getMasters');
/* Candidacies */
Route::resource('candidacies', 'Back\CandidacyController');
/* Auth */
Route::post('candidacy/login', 'Front\AuthController@login');


Route::group(['middleware'=>['jwtauth']], function() {
    Route::post('front/checkToken', 'Front\AuthController@checkToken');
    Route::post('candidacy/logout', 'Front\AuthController@logout');
    
});
Route::get('front/print/{candidacy}', 'Front\FrontController@printCandidacy');