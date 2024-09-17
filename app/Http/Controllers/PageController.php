<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comic;

class PageController extends Controller
{

    // stampare il totale dei prodotti del db comic
    public function  index()
    {

        $title = 'Benvenuti nella Crud DC COMICS';
        $num_prodotti = Comic::count();

        $last_comic = Comic::latest()->first();
        $title_last_comic = $last_comic->title;
        return view('home', compact('num_prodotti', 'title_last_comic', 'title'));
    }
}
