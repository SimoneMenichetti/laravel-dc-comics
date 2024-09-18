@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Comic: {{ $comic->title }}</h1>

        {{-- Mostra gli errori  --}}
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('comics.update', $comic->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Campo titolo --}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $comic->title) }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Campo descrizione --}}
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    rows="4" value="{{ old('description', $comic->description) }}"></textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Campo thumbnail URL --}}
            <div class="form-group">
                <label for="thumb">Thumbnail URL</label>
                <input type="text" name="thumb" id="thumb"
                    class="form-control @error('thumb') is-invalid @enderror" value="{{ old('thumb', $comic->thumb) }}">
                @error('thumb')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Campo prezzo --}}
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $comic->price) }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Campo serie --}}
            <div class="form-group">
                <label for="series">Series</label>
                <input type="text" name="series" id="series"
                    class="form-control @error('series') is-invalid @enderror" value="{{ old('series', $comic->series) }}">
                @error('series')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Campo data di vendita --}}
            <div class="form-group">
                <label for="sale_date">Sale Date</label>
                <input type="date" name="sale_date" id="sale_date"
                    class="form-control @error('sale_date') is-invalid @enderror"
                    value="{{ old('sale_date', $comic->sale_date) }}">
                @error('sale_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Campo tipo --}}
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror"
                    value="{{ old('type', $comic->type) }}">
                @error('type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Comic</button>
        </form>
    </div>
@endsection
