@extends('layout.app')

@section('title', 'Post')

@section('content')
    <div class="container">
        <div class="row ">
            @foreach ($posts as $post)
            <div class="col-4 my-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->diffForHumans() }}</h6>
                      <p class="card-text">{{ Str::limit($post->desc, 130, '...') }}</p>
                      <a href="{{ route('post.show', $post) }}" class="card-link">See detail</a>
                      <a href="{{ route('post.edit', $post) }}" class="btn btn-success">Edit</a>
                        <form action="{{ route('post.delete', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
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
