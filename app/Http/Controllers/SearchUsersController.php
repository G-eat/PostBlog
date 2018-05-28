<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Friend;
use App\Post;

class SearchUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
      $users = User::orderBy('created_at','desc')->paginate(10);
      return view('users.index')->with('users',$users);
    }

    public function show($id)
    {
      $user = User::find($id);
      $user_id = Auth()->user()->id;
      $postsNr = Post::where('user_id', '=' ,$user_id)->count();
      $friend = Friend::where('friend_id' , $id)->where('user_id', '=' , $user_id)->count();
      $followingNr = Friend::where('user_id', '=' , $id)->count();
      $followersNr = Friend::where('friend_id', $id)->where('user_id', '!=' , $id)->count();
      $you = $user_id == $id ? '1' : '0';

      return view('users.show')->with('user_id',$user_id)->with('user',$user)->with('posts',$user->posts)->with('friend',$friend)->with('followersNr',$followersNr)->with('followingNr',$followingNr)->with('postsNr',$postsNr)->with('you',$you);
    }
}
