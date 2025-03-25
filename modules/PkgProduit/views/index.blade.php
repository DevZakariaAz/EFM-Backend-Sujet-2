<!-- Blog/Resources/views/index.blade.php -->
@extends('Blog::layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Articles</h1>
    <a href="{{ route('articles.create')  }}">Create New Article</a>
    <ul>
        @foreach($articles as $article)
            <li>
                <strong>{{ $article->title }}</strong><br>
                {{ $article->content }}<br>
                <a href="{{ route('articles.edit', $article->id) }}">Edit</a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
