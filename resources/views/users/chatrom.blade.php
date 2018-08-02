@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header mb-3"><h2 class="text-info">Chat</h2></div>


          @foreach ($friends as $friend)
            @foreach ($users as $user)
              @if ($user->id  == $friend->friend_id)
                  <a href="/chat/{{$user->id}}" class='font-weight-bold ml-3'><img class="rounder" style="width:30px; border-radius: 50%" src="/storage/profile_photo/{{$user->profile_photo}}" alt="User Profile Photo">{{$user->name}}</a>
                <hr>
              @endif
            @endforeach
          @endforeach

    </div>
  </div>
@endsection
