@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="list-group-item">
        {!! Form::open(['action' => ['PostsController@update',$post->id] , 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}
          <div class='form-group'>
            <h4>{{Form::label('title','Title')}}</h4>
            {{Form::text('title', $post->title ,['class'=>'form-control','placeholder'=>'Post Title'])}}
          </div>
          <div class='form-group'>
            <h4>{{Form::label('body','Body')}}</h4>
            {{Form::textarea('body', $post->body ,['class'=>'form-control','placeholder'=>'Post Body'])}}
          </div>
          <div class='form-group'>
            {{Form::file('post_photo')}}
          </div>
          <br>
          <div class='form-group'>
            <a href="/posts" class='btn btn-default border border-secondary'>Cancel</a>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit',['class'=>"btn btn-primary"])}}
          </div>
        {!! Form::close() !!}
      </div>  <!--list-group-item -->
    </div> <!--container -->
@endsection
