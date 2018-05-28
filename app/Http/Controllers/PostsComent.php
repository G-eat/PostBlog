<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Like;
use App\User;
use App\Dislike;

class PostsComent extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('preventBackHistory');
  }

    public function like($id)
    {
        $user = auth()->user()->id;
        $likeNr = Like::where('post_id' , $id)->where('user_id', '=' , $user)->count();
        $dislikeNr = Dislike::where('post_id' , $id)->where('user_id', '=' , $user)->count();
        $likes = Like::where('post_id' , $id)->where('user_id', '=' , $user)->get();
        $dislikes = Dislike::where('post_id' , $id)->where('user_id', '=' , $user)->get();

        foreach ($likes as $like) {
            if ($like->user_id == $user) {
              $like->delete();
          }
        }

        if ($dislikeNr = 1) {
          foreach ($dislikes as $dislike) {
            $dislike->delete();
          }
        }


        if ($likeNr >= 1 ) {
          return back()->with('error','You Liked one time, so we deleted that.');
        }else{
          $like = new Like;
          $like->user_id = auth()->user()->id;
          $like->post_id = $id;
          $like->save();
        }

      return back();
    }

    public function dislike($id)
    {
      $user = auth()->user()->id;
      $dislikeNr = Dislike::where('post_id' , $id)->where('user_id', '=' , $user)->count();
      $likeNr = Like::where('post_id' , $id)->where('user_id', '=' , $user)->count();
      $dislikes = Dislike::where('post_id' , $id)->where('user_id', '=' , $user)->get();
       $likes = Like::where('post_id' , $id)->where('user_id', '=' , $user)->get();

      foreach ($dislikes as $dislike) {
          if ($dislike->user_id == $user) {
            $dislike->delete();
        }
      }

      if ($likeNr = 1) {
        foreach ($likes as $like) {
          $like->delete();
        }
      }

      if ($dislikeNr >= 1 ) {
        return back()->with('error','You Disliked one time, so we deleted that.');
      }else{
      $dislike = new Dislike;
      $dislike->user_id = auth()->user()->id;
      $dislike->post_id = $id;
      $dislike->save();
      }

      return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
      $this->validate($request,[
        'body'=>'required',
      ]);

      $comment = new Comment;
      $comment->user_id = auth()->user()->id;
      $comment->post_id = $id;
      $comment->body=$request->input('body');
      $comment->save();

      return back();
    }

}
