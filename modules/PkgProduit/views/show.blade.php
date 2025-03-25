{{-- resources/views/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    <p>{{ $article->content }}</p>

    <a href="{{ route('blog.edit', $article->id) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('blog.destroy', $article->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <a href="{{ route('blog.index') }}" class="btn btn-secondary">Back to Articles</a>
</div>
@endsection
