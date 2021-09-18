<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferentCreateRequest extends FormRequest
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
            //
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'poste' => 'required|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|max:255',
            'id_experience_professionnelle' => 'required|integer|max:11'
        ];
    }
}
