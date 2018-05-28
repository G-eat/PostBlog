<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;

class ProfilePic extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('preventBackHistory');
     }


    public function index()
    {
      $user = Auth::user();
      return view('profile.index')->with('user',$user);
    }

    public function edit($id)
    {
      $user = Auth::user();
      return view('profile.edit')->with('user',$user);
    }

    public function update(Request $request ,$id)
    {
      $this ->validate($request,[
        'name' => 'required|max:20',
        'email' => 'required|email',
      ]);

      if($request->hasFile('profile_photo')){
        // get client photo name
        $fileName = $request->file('profile_photo')->getClientOriginalName();

        // get client only phto name without extension
        $fileNameWithoutExt = pathinfo($fileName,PATHINFO_FILENAME);

        // get client photo extension
        $fileExtension = $request->file('profile_photo')->getClientOriginalExtension();

        // modify to have only one photo with same name
        $fileNameToStore = $fileNameWithoutExt.'_'.time().'.'.$fileExtension;

        // path to storage
        $path = $request->file('profile_photo')->storeAs('public/profile_photo' , $fileNameToStore);
      }

      $user = User::find($id);
      $user->name = $request->input('name');
      $user->email = $request->input('email');

      if($request->hasFile('profile_photo')){
        if (  $user->profile_photo !== 'noImage.png') {
          Storage::delete('public/profile_photo/'.$user->profile_photo);
        }
        $user->profile_photo = $fileNameToStore;
      }

      $user->save();

      return redirect('/profile')->with('success','Profile Updated');
    }

}
