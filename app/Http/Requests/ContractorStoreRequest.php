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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "departament.name" => "required",
            "departament.city" => "required",
            "departament.street" => "required",
            "departament.postal_code" => "required",
            "departament.country" => "required",
            "contractor.name" => "required",
            "contractor.nip" => "required|string|size:10",
            "contact.name" => "required",
            "contact.last_name" => "required",
            "contact.email" => "required",
            "contact.phone" => "required|string|size:9",
        ];
    }
}
