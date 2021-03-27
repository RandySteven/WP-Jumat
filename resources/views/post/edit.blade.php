@extends('layout.app')

@section('title', 'Edit Post')

@section('content')
<div class="container">
    <form action="{{ route('post.update', $post) }}" method="POST" enctype="multipart/form-data">
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
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control ">
          </div>
        <div class="form-group">
            <label for="title">Category</label>
            <select name="category_id" id="" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }} >{{ $category->category }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="title">Tag</label>
            <select name="tags[]" id="" class="form-control" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                @endforeach
            </select>
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
