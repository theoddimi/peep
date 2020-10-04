<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimelineController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Contracts\Support\Renderable
  */
  public function index()
  {
    // $peeps = DB::table('peeps')->whereExists(function($query){
    //   $query->select(DB::raw(1))
    //         ->from('followers')
    //         ->whereRaw('followers.user_id = peeps.user_id')
    //         ->whereRaw('followers.follower_id = '.\Auth::id());
    // })->orderBy('created_at','desc')->get();
    $peeps = \App\Models\Peep::whereIn('user_id',function($query){
      $query->select('user_id')
            ->from('followers')
            ->whereRaw('followers.user_id = peeps.user_id')
            ->whereRaw('followers.follower_id = '.\Auth::id());
    })->orderByDesc('created_at')->get();

    return view('timeline')->with(compact('peeps'));
  }
}
