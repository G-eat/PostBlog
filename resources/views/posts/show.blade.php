@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="list-group-item">
        <div class="list-group-item">

            <div>
              <h1 class="text-center "><span class='text-primary font-weight-normal'>{{$post->title}}</span></h1>
            </div>
            <br>
            <div style='width:60%' class="mx-auto">
              <img style="width:100%" src="/storage/post_photo/{{$post->post_photo}}" alt="Post Photo">
            </div>

            <div>
              <hr>
              <p>{{$post->body}}</p>
              <hr>
              <h2>User id :{{$post->user_id}}</h2>
            </div>

          </div><br>

          <div class="row">
            <div @foreach($likes as $like) @if ($like->user_id == auth()->user()->id) class='like col-md-6' @endif @endforeach style="font-size:3em; padding: 10px; text-align:center; border:2px solid #666" class="col-md-6">
              <a href="/like/{{$post->id}}"><i class="fas fa-thumbs-up text-info">({{$likeNr}})</i></a>
            </div>
            <div @foreach($dislikes as $dislike) @if ($dislike->user_id == auth()->user()->id) class='dislike col-md-6' @endif @endforeach style="font-size:3em; padding: 10px; text-align:center; border:2px solid #666" class="col-md-6">
              <a href="/dislike/{{$post->id}}"><i class="fas fa-thumbs-down text-danger">({{$dislikeNr}})</i></a>
            </div>
          </div><br>


          <div class="list-group-item">
            <h3 class='text-primary'>Comment's({{$commentsNr}})</h3><br>
            @foreach ($comments as $comment)
              @if ($post->id == $comment->post_id)

              <div class="list-group">
                  <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-10 justify-content-between">
                      <h5 class="mb-1">
                        @foreach ($users as $user)
                          @if ($comment->user_id == $user->id)
                            <img style="width:5%; border-radius:50%" src="/storage/profile_photo/{{$user->profile_photo}}" alt="User Profile Photo">
                            <a href="/user/{{$user->id}}">{{$user->name}}</a>
                          @endif
                        @endforeach
                      </h5>
                      <small>{{$comment->created_at->diffForHumans()}}</small>
                    </div>
                    <hr>
                    <p class="mb-1">{{$comment->body}}</p>
                </div>
              </div>
             <br>

              @endif

            @endforeach
            <br>
              <div class="list-group-item">
                {!!Form::open(['action'=>['PostsComent@store',$post->id] , 'method'=>'POST'])!!}
                  <div class='form-group'>
                    {{Form::textarea('body','' ,['class'=>'form-control','placeholder'=>'Comment'])}}
                  </div>
                  <div class='form-group'>
                    {{Form::submit('Submit',['class'=>"btn btn-primary"])}}
                  </div>
                {!!Form::close()!!}
              </div>

              <br>
              <a class='btn btn-primary' href="/posts">Back</a>

              @auth
                @if (Auth::user()->id === $post->user_id)
                  <a class='btn btn-info' href="/posts/{{$post->id}}/edit">Edit</a>

                  {!!Form::open(["action"=>['PostsController@destroy',$post->id], "method"=>'POST' , 'class'=>'right'])!!}
                  {{Form::hidden('_method','DELETE')}}
                  {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                  {!!Form::close()!!}
                @endif
              @endauth

      </div>  <!--list-group-item -->
    </div> <!--container -->
@endsection


<style media="screen">
  .dislike{
    background: rgba(249, 87, 147,0.5);
  }
  .like{
    background: rgba(87, 168, 249,0.5);
  }
</style>
{{--
<script type="text/javascript">
    function add() {
      var dislike = document.getElementById('dislike');
      dislike.classList.add('active');
    }

</script> --}}
