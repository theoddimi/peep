<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use \Intervention\Image\Facades\Image as ImageEditor;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyForFollower;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function follow(Request $request){
      $user = \App\Models\User::findOrFail($request->input('followId'));
      DB::table('followers')->insert(['user_id' => $request->input('followId'), 'follower_id' => \Auth::id()]);
      Mail::to($user->email)->send(new NotifyForFollower(auth()->user()));
      return redirect()->back();
    }

    public function unfollow(Request $request){
      DB::table('followers')->where('user_id',$request->input('unfollowId'))->where('follower_id',\Auth::id())->delete();
      return redirect()->back();
    }

    public function listUsers(){
      $list = \App\Models\User::where('id', '!=', auth()->id())->simplePaginate(5);
      return view('user-list')->with(compact('list'));
    }

    public function getProfile($username){

      Log::channel('mysql')->info('', ['type'=>'visits','page' => url()->current(), 'user' => \Auth::id()]);
      $user = \App\Models\User::where('username',$username)->firstOrFail();
      $peeps = $user->peeps()->orderByDesc('created_at')->simplePaginate(5);
      return view('profile')->with(['user'=>$user, 'peeps' => $peeps]);
    }

    public function updateAvatar(Request $request){
        $request->validate([
          'avatar_image'=> 'max:1024',
          'avatar_image'=> 'mimes:jpeg,bmp,png'
        ]);
        $user = \Auth::user();

        #Save image if exists
        if($request->hasFile('avatar_image')){
          if(\Storage::disk('public')->has('avatars/'.$user->avatar))
          \Storage::disk('public')->delete('avatars/'.$user->avatar);
          $imageFileName = time().'_'.$request->file('avatar_image')->getClientOriginalName();
          $imageResize = ImageEditor::make($request->file('avatar_image')->getRealPath());
          $imageResize->resize(250,250, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
          });
          $imageResize->fit(250, 250);
          \Storage::disk('public')->put('\/avatars\/'.$imageFileName, $imageResize->encode());
          $user->avatar = $imageFileName;
          $user->save();

      }
      return redirect()->back();
    }
}
