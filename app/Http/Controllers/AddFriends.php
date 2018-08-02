<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Friend;
use App\Message;
use App\User;

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

    public function chat($id)
    {
      $friend = User::find($id);
      $you = Auth::user()->name;
      return view('users.chat')->with('friend',$friend)->with('you',$you);
    }

    public function postchat($id)
    {
      $user = Auth::user()->name;
      // $mes = Message::where('user_id' , 'LIKE' , $user)->where('friend_id' , 8)->get();
      // return $mes;
      $friend = Friend::where('friend_id' ,$id)->get();
      return Message::where(function($query) use($id){$query->where('user_id' , 'LIKE' , Auth::user()->name)->where('friend_id' , $id);})->orWhere(function($query) use($id){$query->where('user_id',$id)->where('friend_id','LIKE',Auth::user()->name);})->get();
    }

    public function ch()
    {
      $message = new Message;
      $message->user_id = Auth::user()->name;
      $message->friend_id = request()->get('friend_id');
      $message->message = request()->get('message');
      $message->save();

        return [];

      //event(new App\Events\BroadcastChat($message));
    }

    public function chatrom()
    {
      $user = Auth()->user()->id;
      $friends = Friend::where('user_id',$user)->get();
      $users = User::all();
      // foreach ($friends as $friend) {
      //   foreach ($users as $user) {
      //     // code...
      //   }
      // }
      return view('users.chatrom')->with('friends',$friends)->with('users',$users);
    }
}
