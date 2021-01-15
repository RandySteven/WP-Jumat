@extends('layout.app')

@section('title', 'Show')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    Dibuat pada<p class="text text-secondary">{{ $post->created_at->format('d M, Y') }}</p>
    {{-- !! panggil tag untuk html --}}
    <p>{!! nl2br($post->desc) !!}</p>

</div>
@endsection
