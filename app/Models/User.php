<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function peeps()
    {
        return $this->hasMany('\App\Models\Peep');
    }

    public function followers(){
      $followers =  \Illuminate\Support\Facades\DB::table('followers')->where('user_id',$this->id)->pluck('follower_id');
      return $this->find($followers);
    }
    public function following(){
      $following = \Illuminate\Support\Facades\DB::table('followers')->where('follower_id',$this->id)->pluck('user_id');
      return $this->find($following);
    }
    public function followersCount(){
      return \Illuminate\Support\Facades\DB::table('followers')->where('user_id',$this->id)->count();
    }
    public function followingCount(){
      return \Illuminate\Support\Facades\DB::table('followers')->where('follower_id',$this->id)->count();
    }

    public function alreadyFollow(){
      return \Illuminate\Support\Facades\DB::table('followers')->where('follower_id',\Auth::id())->where('user_id',$this->id)->exists();
    }
}
