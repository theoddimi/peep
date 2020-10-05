<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', 'App\Http\Controllers\Api\Auth\RegisterController@register');
Route::post('login', 'App\Http\Controllers\Api\Auth\LoginController@login');
Route::post('refresh', 'App\Http\Controllers\Api\Auth\LoginController@refresh');

Route::group([ 'middleware' => 'auth:api'], function(){
  Route::post('logout','App\Http\Controllers\Api\Auth\LoginController@logout');
  Route::get('/users', function (Request $request) {
      $users =   DB::select('SELECT u.id,u.username, u.email,
        (SELECT COUNT(*) FROM followers f1 WHERE u.id = f1.user_id) AS followers,
        (SELECT COUNT(*) FROM followers f2 WHERE u.id = f2.follower_id) AS following,
        COUNT(p.id) AS \'Total peeps\',
        concat(:profile,"/",u.username) as Profile
        FROM users u
        LEFT JOIN peeps p
        ON p.user_id = u.id
        GROUP BY u.id ',['profile'=>url('profile')]);
        return $users;

  });
});
  // Route::middleware('auth:api')->get('/user', function (Request $request) {
  //     return $request->user();
  // });
