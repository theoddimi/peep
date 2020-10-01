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
//Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/timeline', [App\Http\Controllers\TimelineController::class, 'index'])->name('timeline');

Route::resource('peep' , App\Http\Controllers\PeepController::class);//->names([
//     // 'index' => 'peep.index',
//     // 'create' => 'peep.create',
//     // 'index' => 'peep.',
// ]);
//TODO --> Create Timeline
