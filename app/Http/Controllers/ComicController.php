<?php

namespace App\Http\Controllers;
// importo il model

use App\Http\Requests\ComicRequest;
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

    // // Validazione dei dati,
    // $validatedData = $request->validate([
    //     'title' => 'required|string|max:255',
    //     'description' => 'required|string',
    //     'thumb' => 'required|url',
    //     'price' => 'required|numeric',
    //     'series' => 'required|string|max:255',
    //     'sale_date' => 'required|date',
    //     'type' => 'required|string|max:255',
    // ], [
    //     'title.required' => 'Il titolo è un campo obbligatorio',
    //     'title.min' => 'Il titolo deve avere minimo 3 caratteri',
    //     'title,max' => 'Il titolo deve avere massimo 50 caratteri',
    //     'description.required' => 'La descrizione è obbligatoria',
    //     'description.min' => 'La descrizione ha un minimo di 10 caratteri',
    //     'description.max' => 'La descrizione ha un massimo di 250 caratteri',
    //     'thumb.required' => "Il campo Url immagine è obbligatorio",
    //     'price.required' => "L'inserimento del prezzo è obbligatorio",
    //     'series.required' => 'La classe della serie è obbligatoria',
    //     'sale_date.required' => 'La data di uscita è obbligatoria',
    //     'type.required' => 'Il tipo di Comics è obbligatorio'
    // ]);

    public function store(ComicRequest $request)
    {
        // Ottieni i dati validati dalla ComicRequest
        $validatedData = $request->validated();
        // memorizza i dati inseriti nel form e l ultima sessione
        session()->put('last_comic_data', $validatedData);

        // Converti il prezzo da stringa a formato decimale
        $price = str_replace(',', '.', $validatedData['price']);

        // Generazione dello slug
        $slug = generateSlug($validatedData['title'], '-');


        // Aggiungi lo slug e il prezzo ai dati validati
        $validatedData['price'] = $price;
        $validatedData['slug'] = $slug;

        // Crea il record del fumetto nel database
        $comic = Comic::create($validatedData);

        // Reindirizza alla lista dei fumetti con un messaggio di successo
        return redirect()->route('comics.show', $comic->id)->with('success', 'Fumetto "' . $comic->title . '" creato con successo!');
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
    public function update(ComicRequest $request, string $id)
    {
        // Cerca il fumetto in base all'id
        $comic = Comic::find($id);

        // Se il fumetto non esiste, reindirizza alla lista dei fumetti
        if (!$comic) {
            return redirect()->route('comics.index')->with('error', 'Fumetto non trovato.');
        }

        // Ottieni i dati validati dalla ComicRequest
        $validatedData = $request->validated();

        // Converti il prezzo da stringa a formato decimale
        $price = str_replace(',', '.', $validatedData['price']);

        // Se il titolo è stato modificato, rigenera lo slug
        if ($validatedData['title'] !== $comic->title) {
            $slug = generateSlug($validatedData['title'], '-');

            // Aggiungi lo slug ai dati validati
            $validatedData['slug'] = $slug;
        }

        // Aggiungi il prezzo corretto ai dati validati
        $validatedData['price'] = $price;

        // Aggiorna il record del fumetto con i dati validati
        $comic->update($validatedData);

        // Redirect alla pagina dei fumetti con un messaggio di successo
        return redirect()->route('comics.index')->with('success', 'comic "'  . $comic->title .  '" aggiornato con successo.');
    }

    // Valida i dati in arrivo
    // $validatedData = $request->validate([
    //     'title' => 'required|string|max:255',
    //     'description' => 'required|string',
    //     'thumb' => 'required|url',
    //     'price' => 'required|numeric',
    //     'series' => 'required|string|max:255',
    //     'sale_date' => 'required|date',
    //     'type' => 'required|string|max:255',
    // ], [
    //     'title.required' => 'Il titolo è un campo obbligatorio',
    //     'title.min' => 'Il titolo deve avere minimo 3 caratteri',
    //     'title,max' => 'Il titolo deve avere massimo 50 caratteri',
    //     'description.required' => 'La descrizione è obbligatoria',
    //     'description.min' => 'La descrizione ha un minimo di 10 caratteri',
    //     'description.max' => 'La descrizione ha un massimo di 250 caratteri',
    //     'thumb.required' => "Il campo Url immagine è obbligatorio",
    //     'price.required' => "L'inserimento del prezzo è obbligatorio",
    //     'series.required' => 'La classe della serie è obbligatoria',
    //     'sale_date.required' => 'La data di uscita è obbligatoria',
    //     'type.required' => 'Il tipo di Comics è obbligatorio'
    // ]);



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comic = Comic::find($id);

        $comic->delete();
        // passo la variabile di sessione con with che passiamo alla pagina di reindirizzo
        return redirect()->route('comics.index')->with('deleted', 'Il Comic "'  .  $comic->title  .  '" è stato eliminato correttamente');
    }
}
