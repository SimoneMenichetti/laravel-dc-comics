@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Made New Comic</h1>

        <form action="{{ route('comics.store') }}"method="POST">
            {{-- @csrf token di controllo --}}
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="thumb">Thumbnail URL</label>
                <input type="text" name="thumb" id="thumb" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="series">Series</label>
                <input type="text" name="series" id="series" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="sale_date">Sale Date</label>
                <input type="date" name="sale_date" id="sale_date" value="{{ old('sale_date') }}" class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Comic</button>
        </form>
    </div>
@endsection
