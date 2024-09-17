{{-- questa view estende il file main.blade.php che è dentro la cartella view/layouts --}}
@extends('layouts.main')

@section('hero')
    <div>HERO HOME</div>
@endsection

@section('content')
    <div class="container my-5 bg-dark">
        <h1>{{ $title }}</h1>
        <p class="text-white">Il totale dei prodotti DC COMICS e {{ $num_prodotti }}</p>
        <p>L'ultimo elemento DC COMIC è {{ $title_last_comic }}</p>

    </div>
@endsection


@section('titlePage')
    home
@endsection
