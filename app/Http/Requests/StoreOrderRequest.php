<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'username' => ['required', 'min:3', 'max:50'],
            'user_mail' => ['required', 'email'],
            'address' => ['required'],
            'phone' => ['required'],
            'notes' => ['nullable', 'max:500'],
            'cart' => ['required', 'array'],
            'total' => ['required'],
            'restaurant_id' => ['required'],
            'payment_status' => ['nullable']
        ];
    }
}
