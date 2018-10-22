@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1 class='text-primary'>All Users</h1></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($users) < 1)
                      <p>Don't have any user yet.</p>
                    @endif

                    @foreach ($users as $user)
                      <div class="list-group-item">
                        <div class="row">
                            <div class="col-md-2 col-sd-2 ">
                              <img style="width:100%" src="/storage/profile_photo/{{$user->profile_photo}}" alt="Profile Photo">
                            </div>

                            <div class="col-md-10 col-sd-01">
                              <h1><a style='color:black' href="/users/{{$user->id}}">{{$user->name}}</a></h1>
                            </div>

                          </div>  <!--row --><br>
                      </div>
                    @endforeach
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
