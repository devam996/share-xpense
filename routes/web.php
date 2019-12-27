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

Route::get('/', function () {
    return view('welcome');
});

$apiRoutes = function () {
    Route::post('/api/user/register', 'AuthController@Register');
    Route::post('/api/user/login', 'AuthController@Login');

    Route::group(['middleware' => 'JwtToken'], function (){
        // Route::post('/api/group/', 'GroupController@CreateGroup');
        // Route::post('/api/group/', 'GroupController@GetAllGroups');
        // Route::post('/api/group/{id}', 'GroupController@UpdateGroup');
        // Route::get('/api/group/{id}', 'GroupController@GetGroupDetails');
        // Route::post('/api/group/{id}/add', 'GroupController@AddFriends');

        Route::post('/api/categories/', 'CategoryController@CreateCategory');
    });
};

$subdomains = explode(',',env('APP_URL'));

foreach ($subdomains as $subdomain) {
    Route::group(['domain' => $subdomain], $apiRoutes);   
}