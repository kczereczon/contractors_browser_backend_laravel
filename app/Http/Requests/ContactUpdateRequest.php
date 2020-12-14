<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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

    public function messages()
    {
        return [
            'required' => 'To pole jest wymagane!',
            'string' => 'To pole musi być łańcuchem znaków.',
            'digits' => "To pole musi mieć dokładnie :digits cyfr!",
            'email' => "Proszę wpisać poprawny adres email"
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["string"],
            "last_name" => ["string"],
            "email" => ["email"],
            "phone" => ["string","digits:9"]

        ];
    }
}
