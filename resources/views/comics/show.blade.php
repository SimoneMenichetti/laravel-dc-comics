@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $comic->thumb }}" class="img-fluid" alt="{$comic->title}">

            </div>
            <div class="col-md-8">
                <h1>{{ $comic->title }}</h1>
                <p>Series:{{ $comic->series }}</p>
                <p>Type:{{ $comic->type }}</p>
                <p>Price:{{ $comic->price }}$</p>
                <p>Sale Date:{{ $comic->sale_date }}</p>
                <p>{{ $comic->description }}</p>
                {{-- ritorno index lista comic --}}
                <a href="{{ route('comics.index') }}" class="btn btn-primary">go comic List</a>
            </div>
        </div>
    </div>
@endsection
