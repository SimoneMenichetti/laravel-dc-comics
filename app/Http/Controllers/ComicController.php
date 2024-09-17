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
        // Converti il prezzo da stringa a formato decimale
        $price = str_replace(',', '.', $request->input('price'));

        // Validazione dei dati, inclusa 'sale_date'
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumb' => 'required|url',
            'price' => 'required|numeric',
            'series' => 'required|string|max:255',
            'sale_date' => 'required|date', // Assicurati che 'sale_date' sia richiesto
            'type' => 'required|string|max:255',
        ]);

        // Generazione dello slug
        $slug = Str::slug($validatedData['title'], '-');
        while (Comic::where('slug', $slug)->exists()) {
            $slug = Str::slug($validatedData['title'] . '-' . Str::random(5), '-');
        }

        // Aggiungi lo slug e il prezzo ai dati validati
        $validatedData['price'] = $price;
        $validatedData['slug'] = $slug;

        // Crea il record del fumetto
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
        $comic = Comic::Find($id);
        // dump($comic);
        return view('comics.edit', compact('comic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valida i dati in arrivo
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumb' => 'required|url',
            'price' => 'required|numeric',
            'series' => 'required|string|max:255',
            'sale_date' => 'required|date',
            'type' => 'required|string|max:255',
        ]);

        // Cerca il fumetto in base all'id
        $comic = Comic::find($id);

        // Se non esiste, ritorna un errore
        if (!$comic) {
            return redirect()->route('comics.index');
        }

        // Aggiorna i dati del fumetto
        $comic->update($validatedData);

        // Redirect alla pagina dei fumetti con un messaggio di successo
        return redirect()->route('comics.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comic = Comic::find($id);

        $comic->delete();
        // passo la variabile di sessione con with che passiamo alla pagina di reindirizzo
        return redirect()->route('comics.index')->with('deleted', 'Il Comic' . $comic->title . 'è stato eliminato correttamente');
    }
}
