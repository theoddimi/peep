<?php

namespace App\Http\Controllers\Api\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\Api\IssueTokenTrait;

class RegisterController extends Controller
{
  use IssueTokenTrait;


  public function register(Request $request){

    $this->validate($request, [
      'username' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:8|confirmed'
    ]);

    $user = new User;
    $user->name         =   empty($request->name) ? $request->username :$request->name;
    $user->username     = $request->username;
    $user->email        = $request->email;
    $user->password     = bcrypt($request->password);
    $user->save();


    return $this->issueToken($request, 'password', '*');


  }
}
