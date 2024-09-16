<?php

namespace App\Http\Controllers;
// importo il model

use App\Models\Comic;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comics = Comic::orderBy('created_at', 'desc')->get();
        return view('comics.index', compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comics.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    //  PER SALVARE IL NUOVO FUMETTO DAL FORM
    public function store(Request $request)
    {
        // Converto il prezzo da stringa a formato decimale
        $price = str_replace(',', '.', $request->input('price'));

        // Validazione dei dati
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumb' => 'required|url',
            'price' => 'required|numeric', // Verifica che il prezzo sia numerico
            'series' => 'required|string|max:255',
            'sale_date' => 'required|date',
            'type' => 'required|string|max:255',
        ]);

        // Genero lo slug
        $slug = Str::slug($validatedData['title'], '-');
        // Verifico se lo slug è unico
        while (Comic::where('slug', $slug)->exists()) {
            $slug = Str::slug($validatedData['title'] . '-' . Str::random(5), '-');
        }

        // Aggiungo lo slug ai dati validati
        $validatedData['price'] = $price;
        $validatedData['slug'] = $slug;

        // Creo un nuovo fumetto con i dati validati
        Comic::create($validatedData);

        // Redirect alla lista dei fumetti
        return redirect()->route('comics.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comic $comic)
    {
        return view('comics.show', compact('comic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
