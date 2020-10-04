<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Image;
use \App\Models\Peep;
use \Intervention\Image\Facades\Image as ImageEditor;

class PeepController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('peep');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('peep');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $request->validate([
      'peep-text'=>'required | max:140',
      'peep_image'=> 'max:2048 | mimes:jpeg,bmp,png'
    ]);


    $peep = \Auth::user()->peeps()->create([
      'text'=>$request->input('peep-text')
    ]);

    #Save image if exists
    if($request->hasFile('peep_image')){
      $imageFileName = time().'_'.$request->file('peep_image')->getClientOriginalName();
      $imageResize = ImageEditor::make($request->file('peep_image')->getRealPath());
      $imageResize->resize(500,250, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
      });
      \Storage::disk('public')->put('\/images\/'.$imageFileName, $imageResize->encode());
      $peep->image()->save(new Image(['data' => $imageResize,
      'image_name'=>$imageFileName])
    );
  }
  return redirect()->route('timeline')->with('success','Ok');
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
  $peep = \App\Models\Peep::findOrFail($id);
  if($peep->image()->exists() ){
    $imageName = $peep->image->image_name;
    if(!\Storage::disk('public')->exists('\/images\/'.$imageName))
    \Storage::disk('public')->put('\/images\/'.$imageName, $peep->image->data);
  }

  return view('peep')->with(compact('peep'));
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
  $peep = Peep::findOrFail($id);
  \Gate::authorize('edit-peep', $peep);

  return view('peep')->with(compact('peep'));
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
  $request->validate([
    'peep-text'=>'required | max:140',
    'peep_image'=> 'max:2048 | mimes:jpeg,bmp,png'
  ]);

  $peep = Peep::findOrFail($id);
  \Gate::authorize('edit-peep', $peep);

  $peep->text = $request->input('peep-text');
  $peep->save();

  if($request->hasFile('peep_image')){
    $imageFileName = time().'_'.$request->file('peep_image')->getClientOriginalName();
    $imageResize = ImageEditor::make($request->file('peep_image')->getRealPath());
    $imageResize->resize(500,250, function ($constraint) {
      $constraint->aspectRatio();
      $constraint->upsize();
    });
    $image = ( $peep->image()->exists() ?   $peep->image :  new Image );

    if(\Storage::disk('public')->exists('\/images\/'.$image->image_name))
    \Storage::disk('public')->delete('\/images\/'.$image->image_name);
    \Storage::disk('public')->put('\/images\/'.$imageFileName, $imageResize->encode());
    $image->data = $imageResize;
    $image->image_name = $imageFileName;
    $peep->image()->save($image);

  }

  return redirect()->route('user.profile',$peep->user->username);
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
  //
}
}
