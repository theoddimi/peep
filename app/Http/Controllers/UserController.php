<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function follow(Request $request){
      DB::table('followers')->insert(['user_id' => $request->input('followId'), 'follower_id' => \Auth::id()]);
      return redirect()->back();
    }

    public function unfollow(Request $request){
      DB::table('followers')->where('user_id',$request->input('unfollowId'))->where('follower_id',\Auth::id())->delete();
      return redirect()->back();
    }

    public function list(){
      $list = \App\Models\User::where('id', '!=', auth()->id())->get();
      return view('user-list')->with(compact('list'));
    }
}
