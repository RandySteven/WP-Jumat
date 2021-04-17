@extends('layout.app')

@section('title', 'Post')

@section('content')
    <div class="container">
        @guest
        {{-- Sisi dari user belum login --}}
            <a href="{{ route('login') }}" class="btn btn-success">Login if you want to create post</a>
        @else
            {{-- Sisi user yang sudah login --}}
            <a href="{{ route('post.create') }}" class="btn btn-success">Create</a>
        @endguest
        @foreach ($categories as $category)
            <div class="row">
                <div class="col">
                    <a href="{{ route('category', $category) }}">{{ $category->category }}</a>
                </div>
            </div>
        @endforeach

        @auth
            @if (Auth::user()->hasRole('admin'))
                <div class="alert alert-success">Welcome admin</div>
            @else
                <div class="alert alert-success">Welcome user</div>
            @endif
        @endauth

        <div class="row ">
            @foreach ($posts as $post)
            <div class="col-4 my-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        @isset($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" width="150" alt="{{ $post->image }}">
                        @endisset
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <p>{{ $post->user->name }}</p>
                      <a href="{{ route('category', $post->category) }}">{{ $post->category->category }}</a>
                      <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->diffForHumans() }}</h6>
                      <p class="card-text">{{ Str::limit($post->desc, 130, '...') }}</p>
                      <a href="{{ route('post.show', $post) }}" class="card-link">See detail</a> <br>
                      @auth
                          <!-- if auth == true -->
                          @if (Auth::user()->id == $post->user_id || Auth::user()->hasRole('admin'))
                          <a href="{{ route('post.edit', $post) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('post.delete', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                          @endif
                      @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="container">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
