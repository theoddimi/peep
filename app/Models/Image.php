<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['data','image_name'];


    public function setDataAttribute($value)
    {
      // dd($value->encode()->encoded);
      // $img = file_get_contents($value->getRealPath());
      $this->attributes['data'] =  $value->encode()->encoded;
    }
    // public function getDataAttribute($value)
    // {
    //   $image = $this->image_name;
    //   $imageData = base64_encode($value);
    //   $src = 'data:'.pathinfo($image)['extension'].';base64,'.$imageData;
    //   return  $src;
    // }

    public function encodeToBase64()
    {
      $value = $this->data;
      $image = $this->image_name;
      $imageData = base64_encode($value);
      $src = 'data:'.pathinfo($image)['extension'].';base64,'.$imageData;
      return  $src;
    }

}
