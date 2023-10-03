<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'ingredients_description' => 'required|max:65000',
            'price' => 'required|decimal:2|between:0.00,99.99',
            'visibility' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nome piatto richiesto',
            'name.max' => 'Lunghezza massima del nome del piatto di 50 caratteri',

            'ingredients_description.required' => 'Inserisci gli ingredienti',
            'ingredients_description.max' => 'Lunghezza massima della descrizione di 65000 caratteri',

            'price.required' => 'Il prezzo del piatto deve essere inserito',
            'price.decimal' => 'Il valore da te inserito deve avere 2 numeri decimali(separati dal . )',
            'price.between' => 'Il prezzo da te inserito va oltre i 99.99 euro! Noi siamo al discout non da Cracco',

            'visibility.required' => 'Visibilità richiesta',
        ];
    }
}
