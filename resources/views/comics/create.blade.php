@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Made New Comic</h1>

        {{-- condizione per stampare gli errori del create del form --}}
        {{-- @if ($errors->any())
            @dump($errors->all())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                </ul>
        @endforeach
    </div>
    @endif --}}


        <form action="{{ route('comics.store') }}"method="POST">
            {{-- @csrf token di controllo --}}
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    rows="4" value="{{ old('description') }}"></textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="thumb">Thumbnail URL</label>
                <input type="text" name="thumb" id="thumb"
                    class="form-control @error('thumb') is-invalid @enderror" value="{{ old('thumb') }}">
                @error('thumb')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="series">Series</label>
                <input type="text" name="series" id="series"
                    class="form-control @error('series') is-invalid @enderror" value="{{ old('series') }}">
                @error('series')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="sale_date">Sale Date</label>
                <input type="date" name="sale_date" id="sale_date"
                    class="form-control @error('sale_date') is-invalid @enderror" value="{{ old('sale_date') }}">
                @error('sale_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror"
                    value="{{ old('type') }}">
                @error('type')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Comic</button>
        </form>
    </div>
@endsection
