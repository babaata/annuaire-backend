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
            //
            'entreprise' => 'required|max:255',
            'intitule_poste' => 'required|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'description' => 'required',
            'id_profil' => 'required|integer',
            'id_type_contrat' => 'required|integer'
        ];
    }
}
