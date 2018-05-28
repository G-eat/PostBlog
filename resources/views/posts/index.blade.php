@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="list-group-item">
          @if (count($posts) > 0)
            @foreach ($posts as $post)
              <div class="list-group-item">
              <div class="row">
                  <div class="col-md-4 col-sd-4 ">
                    <img style="width:100%" src="/storage/post_photo/{{$post->post_photo}}" alt="Post Photo">
                  </div>

                  <div class="col-md-8 col-sd-8">
                    <hr>
                    <h2><a href='/posts/{{$post->id}}'><span class='text-primary font-weight-normal'>{{$post->title}}</a></h2>
                    <p>{{$post->body}}</p>
                    <hr>

                    <h2>User id :{{$post->user_id}}</h2>
                  </div>

                </div>  <!--row --><br>
              </div>
              <br>
            @endforeach
            {{$posts->links()}}
            @else
              <h3>No posts yet .</h3>
          @endif
      </div>  <!--list-group-item -->
    </div> <!--container -->
@endsection
