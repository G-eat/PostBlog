<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comment;
use App\User;
use App\Like;
use App\Dislike;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('preventBackHistory');//don't let to go back afer you logged out
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'body'=>'required',
          'title'=>'required',
          'post_photo'=>'image|max:1999|nullable'
        ]);

        if($request->hasFile('post_photo')){
          // get client photo name
          $fileName = $request->file('post_photo')->getClientOriginalName();

          // get client only phto name without extension
          $fileNameWithoutExt = pathinfo($fileName,PATHINFO_FILENAME);

          // get client photo extension
          $fileExtension = $request->file('post_photo')->getClientOriginalExtension();

          // modify to have only one photo with same name
          $fileNameToStore = $fileNameWithoutExt.'_'.time().'.'.$fileExtension;

          // path to storage
          $path = $request->file('post_photo')->storeAs('public/post_photo' , $fileNameToStore);
        }

        $post = new Post;
        $post->body = $request->input('body');
        $post->title = $request->input('title');


        if($request->hasFile('post_photo')){
          $post->post_photo = $fileNameToStore;
        }
        else{
          $fileNameToStore = 'noImage.jpg';
          $post->post_photo = $fileNameToStore;
        }

        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::orderBy('created_at','desc')->get();
        $users = User::all();
        $user = auth()->user()->id;
        $commentsNr = Comment::where('post_id' , $id)->count();
        $likeNr = Like::where('post_id' , $id)->count();
        $dislikeNr = Dislike::where('post_id' , $id)->count();
        $likes = Like::where('post_id' , $id)->where('user_id', '=' , $user)->get();
        $dislikes = Dislike::where('post_id' , $id)->where('user_id', '=' , $user)->get();

        return view('posts.show')->with('post',$post)->with('comments',$comments)->with('users',$users)->with('commentsNr',$commentsNr)->with('likeNr',$likeNr)->with('dislikeNr',$dislikeNr)->with('dislikes',$dislikes)->with('likes',$likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (auth()->user()->id !== $post->user_id) {
          return redirect('/posts')->with('error','Unauthorized page');
        }
        return view('posts.edit')->with('post',$post);
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
      $this->validate($request,[
        'body'=>'required',
        'title'=>'required',
        'post_photo'=>'image|max:1999|nullable'
      ]);

      if($request->hasFile('post_photo')){
        // get client photo name
        $fileName = $request->file('post_photo')->getClientOriginalName();

        // get client only phto name without extension
        $fileNameWithoutExt = pathinfo($fileName,PATHINFO_FILENAME);

        // get client photo extension
        $fileExtension = $request->file('post_photo')->getClientOriginalExtension();

        // modify to have only one photo with same name
        $fileNameToStore = $fileNameWithoutExt.'_'.time().'.'.$fileExtension;

        // path to storage
        $path = $request->file('post_photo')->storeAs('public/post_photo' , $fileNameToStore);
      }

      $post = Post::find($id);
      $post->body = $request->input('body');
      $post->title = $request->input('title');


      if($request->hasFile('post_photo')){
        if (  $post->post_photo !== 'noImage.jpg') {
          Storage::delete('public/post_photo/'.$post->post_photo);
        }
        $post->post_photo = $fileNameToStore;
      }

      $post->user_id = auth()->user()->id;
      $post->save();

      return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (auth()->user()->id !== $post->user_id) {
          return redirect('/posts')->with('error','Unauthorized page');
        }

        if ($post->post_photo !== 'noImage.jpg') {
          Storage::delete('public/post_photo/'.$post->post_photo);
        }

        $post->delete();

        return redirect('/posts')->with('success','Post Deleted');
    }
}
