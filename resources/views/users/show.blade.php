@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="list-group-item">
        <div class="list-group-item">
          <div class="row">
              <div class="col-md-4 col-sd-4 ">
                <img style="width:275px; height:275px; border-radius: 50%;" src="/storage/profile_photo/{{$user->profile_photo}}" alt="User Profile Photo">
              </div>

              <div class="col-md-1 col-sd-1"></div>

              <div class="col-md-7 col-sd-7">
                <div class="row">
                  <div class="col-md-9 col-sd-9">
                    <h2 class='font-weight-bold'>{{$user->name}}<a href="/add_friend/{{$user->id}}" @if ($you == 1) @elseif ($friend > 0) class="btn btn-primary right" @else class='btn btn-info right' @endif>@if ($you == 1)
                      <a href="/profile/edit/{{$user_id}}" class='btn btn-info right'>Edit Profile</a>
                      @else
                        @if ($friend > 0)
                          Following
                        @else
                          Follow
                        @endif</a></h2>
                    @endif
                    <hr>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sd-3">
                      <p class="font-weight-bold">{{$postsNr}} posts</p>
                    </div>
                    <div class="col-md-3 col-sd-3">
                      <a href="#" id = 'a' class="font-weight-bold">{{$followersNr}} followers</a>
                    </div>
                    <div class="col-md-3 col-sd-3">
                      <a href="#" id = 'a' class="font-weight-bold">{{$followingNr}} following</a>
                    </div>
                </div>


            </div>
            </div><hr><br><hr>

            <div>
              <h1 class="text-center "><span class='text-primary font-weight-normal'>{{$user->name}}'s Post</span></h1>
            </div>
            <br><hr><br>

            @foreach ($posts as $post)
              <div>
                <h1 class="text-center "><span class='text-primary font-weight-normal'><a href="/posts/{{$post->id}}">{{$post->title}}</a></span></h1>
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
              <br><hr><br><br>
            @endforeach

            <a class='btn btn-primary' href="/users">Back</a>

      </div>  <!--list-group-item -->
    </div> <!--container -->
@endsection

<style media="screen">
  .right{
    float:right;
  }
 #a{
   text-decoration: none;
 }
</style>
