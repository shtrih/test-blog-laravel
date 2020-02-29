@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($posts as $post)
                <div class="card">
                    <div class="card-header">#{{$post->id}} {{$post->user->name}} | {{$post->updated_at}}</div>
                    <div class="card-body">
                        <p class="card-text">{{$post->content}}</p>
                    </div>
                </div>
            @endforeach

            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection
