<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractorStoreRequest extends FormRequest
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
            'digits' => "To pole musi mieć dokładnie :digits znaków!",
            'email' => "Proszę wpisać poprawny adres email",
            'unique' => "Zarejestrowaliśmy już ten NIP w bazie."
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
            "departament.name" => ["required"],
            "departament.city" => ["required"],
            "departament.street" => ["required"],
            "departament.postal_code" => ["required"],
            "departament.country" => ["required"],
            "contractor.name" => ["required"],
            "contractor.nip" => ["required", "digits:10", "unique:contractors,nip"],
            "contact.name" => ["required"],
            "contact.last_name" => ["required"],
            "contact.email" => ["required", "email"],
            "contact.phone" => ["required", "digits:10"],
        ];
    }
}
