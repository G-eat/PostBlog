@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="list-group-item">
          {!! Form::open(['action' => ['ProfilePic@update',$user->id ], 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}
            <div class='form-group'>
              <h4>{{Form::label('name','Name')}}</h4>
              {{Form::text('name', $user->name ,['class'=>'form-control','placeholder'=>'Name'])}}
            </div>
            <div class='form-group'>
              <h4>{{Form::label('email','Email')}}</h4>
              {{Form::text('email', $user->email ,['class'=>'form-control','placeholder'=>'Email'])}}
            </div>
            <div class='form-group'>
              {{Form::file('profile_photo')}}
            </div>
            <br>
            <div class='form-group'>
              <a href="/profile" class='btn btn-default border border-secondary'>Cancel</a>
              {{Form::submit('Submit',['class'=>"btn btn-primary"])}}
            </div>
          {!! Form::close() !!}
      </div>  <!--list-group-item -->
    </div> <!--container -->
@endsection
