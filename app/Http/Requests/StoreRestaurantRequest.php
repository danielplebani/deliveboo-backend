<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:50',
            'address' => 'required',
            'description' => 'nullable',
            'image' => 'required|image',
            'types' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il titolo è obbligatorio!',
            'name.min' => 'Il titolo deve avere almeno 2 caratteri!',
            'name.max' => 'Il titolo può avere massimo 50 caratteri!',
            'address.required' => "L'indirizzo del ristorante è obbligatorio!",
            'image.required' => "L'immagine del ristorante è obbligatoria!",
            'image.image' => "L'immagine deve essere un file di tipo PNG,SVG,JPG,JPEG",
            'types.required' => 'La tipologia di cucina è obbligatoria!',
        ];
    }
}
