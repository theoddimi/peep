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
  Route::get('/profile/{username}',function($username){
    $user = \App\Models\User::where('username',$username)->with(['peeps'=>function($query){
      $query->orderBy('created_at','desc');
    }])->firstOrFail();
    return view('profile')->with(compact('user'));
  });

});
