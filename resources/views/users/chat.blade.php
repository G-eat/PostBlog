@extends('layouts.app')

@section('content')
  <meta name="friendId" content="{{ $friend->name }}">
  <meta name="userId" content="{{ $you }}">
<div class="container">
    <div id="app">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card card-default">
            <div class="card-header"><h2 class="text-info">{{ $friend->name}}</h2></div>
                <chat></chat>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
