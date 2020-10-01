<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Peep extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['hashid'];

    // public function getEncodeIdAttribute()
    // {
    //   return base64_encode('peep'.$this->attributes['id'].sizeof(array($this->attributes['id')));
    // }


}
