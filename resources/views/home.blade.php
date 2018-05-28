@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1 class='text-primary'>You'r Posts</h1></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($posts) <= 0)
                      <p>You don't have any post yet.</p>
                    @endif

                    @foreach ($posts as $post)
                      <table class='table table-striped'>
                      <tr>
                        <td style="width:80%"><a class='text-danger h2' href='/posts/{{$post->id}}'>{{$post->title}}</a></td>
                        <td style="width:10%"></td>
                        <td style="width:5%"><a href='/posts/{{$post->id}}/edit' class='btn btn-info'>Edit</a></td>
                        <td style="width:5%">
                          {!!Form::open(["action"=>['PostsController@destroy',$post->id], "method"=>'POST' , 'class'=>'right'])!!}
                          {{Form::hidden('_method','DELETE')}}
                          {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                          {!!Form::close()!!}
                        </td>
                      </tr>
                    </table>


                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
