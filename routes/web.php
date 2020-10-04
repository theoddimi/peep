<?php

use Illuminate\Support\Facades\Route;

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
  if(Auth::guest())
  return Redirect::to('login');
  return Redirect::to('/timeline');
});

Auth::routes();

Route::group([ 'middleware' => 'auth:web'], function(){

  Route::get('/timeline', [App\Http\Controllers\TimelineController::class, 'index'])->name('timeline');
  Route::resource('peep' , App\Http\Controllers\PeepController::class);
  Route::post('user/follow',[\App\Http\Controllers\UserController::class,'follow'])->name('user.follow');
  Route::post('user/unfollow',[\App\Http\Controllers\UserController::class,'unfollow'])->name('user.unfollow');
  Route::get('users/list', [\App\Http\Controllers\UserController::class,'listUsers'])->name('user.list');
  Route::get('user/avatar/upload/{username}', function ($username) {
    $user = \App\Models\User::where('username', $username)->where('id', \Auth::id())->firstOrFail();
    return view('partials.user.avatar-upload')->with(compact('user'));
  })->name('user.avatar.edit');
  Route::post('user/avatar/upload', [\App\Http\Controllers\UserController::class,'updateAvatar'])->name('user.avatar.update');
  Route::get('/profile/{username}', [\App\Http\Controllers\UserController::class,'getProfile'])->name('user.profile');



});
