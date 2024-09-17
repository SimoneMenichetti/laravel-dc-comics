@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Comic: {{ $comic->title }}</h1>

        <form action="{{ route('comics.update', $comic->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $comic->title }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $comic->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="thumb">Thumbnail URL</label>
                <input type="text" name="thumb" id="thumb" value="{{ $comic->thumb }}" class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" value="{{ $comic->price }}" class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label for="series">Series</label>
                <input type="text" name="series" id="series" value="{{ $comic->series }}" class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label for="sale_date">Sale Date</label>
                <input type="date" name="sale_date" id="sale_date" value="{{ $comic->sale_date }}" class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" value="{{ $comic->type }}" class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Save Comic</button>
        </form>
    </div>
@endsection
