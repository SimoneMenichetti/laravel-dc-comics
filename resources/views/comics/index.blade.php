@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Comics List</h1>

        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                {{ session('deleted') }}
            </div>
        @endif

        <a href="{{ route('comics.create') }}" class="btn btn-primary mb-3">Add New Comic</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comics as $comic)
                    <tr>
                        <td>
                            <img src="{{ $comic->thumb }}" class="img-fluid" alt="{{ $comic->title }}"
                                style="max-width: 150px;">
                        </td>
                        <td>{{ $comic->title }}</td>
                        <td>
                            <a href="{{ route('comics.show', $comic->id) }}" class="btn btn-primary btn-sm">View Details</a>
                            <a href="{{ route('comics.edit', $comic->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('comics.destroy', $comic) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit" title="Delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
