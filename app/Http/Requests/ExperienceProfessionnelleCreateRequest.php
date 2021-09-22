<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceProfessionnelleCreateRequest extends FormRequest
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
            'entreprise' => 'required|max:255',
            'poste' => 'required|max:255',
            'debut' => 'required|date',
            'fin' => 'required|date',
            'description' => 'required',
            'profil' => 'required|integer',
            'type_contrat' => 'required|integer'
        ];
    }
}
