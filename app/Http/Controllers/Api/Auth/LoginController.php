<?php

namespace App\Http\Controllers\Api\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Helpers\Api\IssueTokenTrait;

class LoginController extends Controller
{
  use IssueTokenTrait;

  public function login(Request $request){
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    return $this->issueToken($request, 'password', '*');
  }


  public function refresh(Request $request){
    $this->validate($request,[
      'refresh_token' =>'required'
    ]);
    return $this->issueToken($request, 'refresh_token', '*');
  }


  public function logout(){
    $accessToken = \Auth::user()->token();
    $refreshToken = Passport::refreshToken();
    $refreshToken::where('access_token_id', $accessToken->id)->update(['revoked' => true]);
    $accessToken->revoke();

    return response()->json([], 204);
  }
}
