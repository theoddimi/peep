<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Peep extends Model
{
    use HasFactory, SoftDeletes;

    // protected $appends = ['hashid'];
    protected $guarded = ['id', 'user_id'];

    // public function getEncodeIdAttribute()
    // {
    //   return base64_encode('peep'.$this->attributes['id'].sizeof(array($this->attributes['id')));
    // }


    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function image()
    {
        return $this->hasOne('\App\Models\Image');
    }

    public function getCreatedAtAttribute($peep){
      $dateFormat = date('h:i A', strtotime($peep))." &centerdot; ".date('M d, Y', strtotime($peep));
      return $dateFormat;
    }


}
