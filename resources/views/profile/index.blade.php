@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="list-group-item">
        <div class="row">
            <div class="col-md-4 col-sd-4 ">
              <img class="rounder" style="width:100%" src="/storage/profile_photo/{{$user->profile_photo}}" alt="User Profile Photo">
            </div>

            <div class="col-md-1 col-sd-1"></div>

            <div class="col-md-7 col-sd-7">
              <hr>
              <h2 class='font-weight-bold'>User Name : <span class='text-primary font-weight-normal'>{{$user->name}}</span></h2>
              <h2 class='font-weight-bold'>User Email : <span class='text-primary font-weight-normal'>{{$user->email}}</span></h2>
              <hr>

              <a href="/profile/edit/{{$user->id}}" class='btn btn-info'>Edit Profile</a>
            </div>

          </div>  <!--row -->
        </div>  <!--list-group-item -->
    </div> <!--container -->
@endsection





<style>
  .rounder{
    height: 275px;
    width: 275px;
    background-color: #bbb;
    border-radius: 50%;
    border: #bbb 2px solid;
  }
</style>
