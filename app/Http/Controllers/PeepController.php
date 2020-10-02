<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Image;

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
      'peep_image'=> 'max:2048'
    ]);


    $peep = \Auth::user()->peeps()->create([
      'text'=>$request->input('peep-text')
    ]);

    #Save image if exists
    if($request->hasFile('peep_image')){
      $imageFileName = $request->file('peep_image')->getClientOriginalName();
      $imageResize = \Intervention\Image\Facades\Image::make($request->file('peep_image')->getRealPath());
      $imageResize->resize(250,500, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
      });
      $peep->image()->save(new Image(['data' => $imageResize,
                                      'image_name'=>$imageFileName])
                                    );
    }
    return redirect()->back()->with('success','Ok');
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
    //
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
    //
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
