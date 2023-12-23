<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
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
            'price' => 'required|min:0.10|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable',
            'image' => 'required|image',
            'available' => 'required',
            'course' => 'required',
            'ingredients' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il titolo è obbligatorio!',
            'name.min' => 'Il titolo deve avere almeno 2 caratteri!',
            'name.max' => 'Il titolo può avere massimo 50 caratteri!',
            'ingredients.required' => "Gli ingredienti del piatto sono obbligatori!",
            'image.required' => "L'immagine del piatto è obbligatoria!",
            'image.image' => "L'immagine deve essere un file di tipo PNG,SVG,JPG,JPEG",
            'course.required' => 'La portata è obbligatoria!',
            'avialable.required' => 'La disponibilità è obbligatoria!',
            'price.required' => 'Il prezzo è obbligatorio!',
            'price.min' => 'Il prezzo deve essere minimo 0,10€',
            'price.regex' => 'Il prezzo deve essere un numero intero o con il . separatore',
        ];
    }
}
