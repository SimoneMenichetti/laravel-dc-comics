@extends('layouts.main')

<h1 class="text-primary">Comics</h1>


@section('content')
    <div class="container my-5">
        <div class="row">

        </div>
    </div>

    <div class="row">
        @foreach ($comics as $comic)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $comic->thumb }}"class="card-img-top" alt="{{ $comic->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $comic->title }}</h5>
                        <p class="card-text text-muted">{{ $comic->price }}$</p>
                        <a href="{{ route('comics.show', $comic->id) }}" class="btn btn-primary mt-auto">Go to Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
