@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p>

                    <p>Check out your <a href="{{ route('post') }}">Post</a>.</p>
                    <p>You can
                        @if (!Auth::user()->isAdmin())
                            not
                        @endif
                        see <a href="{{ route('posts') }}">Posts</a> of all users.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
