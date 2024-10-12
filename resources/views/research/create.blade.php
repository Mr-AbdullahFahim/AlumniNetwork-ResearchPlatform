@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">Upload Research Article</h1>

    <form action="{{ route('research-article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" required></textarea>
        </div>

        <div>
            <label for="author">Author</label>
            <input type="text" name="author" required>
        </div>

        <div>
            <label for="file">Upload PDF</label>
            <input type="file" name="file" accept="application/pdf" required>
        </div>

        <button type="submit">Submit</button>
    </form>
@endsection
