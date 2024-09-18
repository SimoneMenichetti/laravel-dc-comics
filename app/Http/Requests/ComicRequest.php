<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:255',
            'thumb' => 'required|url',
            'price' => 'required|numeric',
            'series' => 'required|string|max:255',
            'sale_date' => 'required|date',
            'type' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è un campo obbligatorio',
            'title.min' => 'Il titolo deve avere min: 3 caratteri',
            'title,max' => 'Il titolo deve avere max: 255 caratteri',
            'description.required' => 'La descrizione è obbligatoria',
            'description.min' => 'La descrizione ha un min:3 caratteri',
            'description.max' => 'La descrizione ha un max:255 caratteri',
            'thumb.required' => "Il campo Url immagine è obbligatorio",
            'price.required' => "L'inserimento del prezzo è obbligatorio",
            'series.required' => 'La classe della serie è obbligatoria',
            'sale_date.required' => 'La data di uscita è obbligatoria',
            'type.required' => 'Il tipo di Comics è obbligatorio'
        ];
    }
}
