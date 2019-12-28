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

    Route::group(['middleware' => 'VerifyJwtToken'], function (){
        Route::post('/api/groups/', 'GroupController@CreateGroup');
        Route::get('/api/groups/', 'GroupController@GetAllGroups');
        Route::get('/api/groups/{id}', 'GroupController@GetGroupDetails')
            ->middleware('VerifyUserOfGroup');
        

        Route::post('/api/categories/', 'CategoryController@CreateCategory');
        Route::get('/api/categories/', 'CategoryController@GetAllCategories');
    });
};

$subdomains = explode(',',env('APP_URL'));

foreach ($subdomains as $subdomain) {
    Route::group(['domain' => $subdomain], $apiRoutes);   
}