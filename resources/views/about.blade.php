@extends('layout.app')

@section('title', 'About')

@section('content')
    <h1>About</h1>
    <a href="{{ route('create.about') }}">Edit About</a>
@endsection
