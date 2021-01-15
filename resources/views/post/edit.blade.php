@extends('layout.app')

@section('title', 'Edit Post')

@section('content')
<div class="container">
    <form action="{{ route('post.update', $post) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title" value="{{ $post->title }}">
          @error('title')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="desc">Desc</label>
          <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" rows="3">
            {{ $post->desc }}
        </textarea>
          @error('desc')
            <div id="validationServer03Feedback" class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
</div>
@endsection