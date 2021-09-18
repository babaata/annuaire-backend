<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UtilisateurUpdateRequest extends FormRequest
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
            'nom_utilisateur' => 'required|max:15',
            'nom' => 'required|max:15',
            'prenom' => 'required|max:25',
            'date_de_naissance' => 'nullable|date',
            'sexe' => 'required|max:20',
            'email' => 'required|email',
            'telephone' => 'nullable',
            'statut' => 'nullable|boolean',
            'url_photo' => 'nullable|max:255',
            'password' => 'required|min:6|max:255'
        ];
    }
}
