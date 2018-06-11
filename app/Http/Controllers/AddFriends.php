<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Friend;

class AddFriends extends Controller
{
    public function add($id)
    {
      $user = Auth()->user()->id;
      $friendNr = Friend::where('friend_id' , $id)->where('user_id', '=' , $user)->count();
      $friends = Friend::where('friend_id' , $id)->where('user_id', '=' , $user)->get();

      if ($id == $user ) {
        return back()->with('error','You can\'t add yourself as Friend.');
      }

      if ($friendNr >0) {
        foreach ($friends as $friend) {
          $friend->delete();
        }
        return back()->with('error','You Deleted as Friend.');
      }

      $friend = new Friend;
      $friend->user_id = $user ;
      $friend->friend_id = $id;
      $friend->save();
      return back()->with('success','You Added as a New Friend.');

    }

    public function chat()
    {
      return view('users.chat');
    }
}
