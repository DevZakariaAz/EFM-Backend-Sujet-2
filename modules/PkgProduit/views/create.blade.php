{{-- resources/views/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Article</h1>
<form action="{{ route('articles.store')  }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
    </div>

    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>

    <button type="submit" class="btn btn-primary">Create Article</button>
</form>

</div>
@endsection
