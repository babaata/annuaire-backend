<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\{Utilisateur, Profil, Langue};

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
        $id = $this->user()->id_utilisateur;

        return [
            'nom' => 'required|max:15',
            'prenom' => 'required|max:25',
            'langues' => 'required',
            'ville' => 'nullable|min:3',
            'pays' => 'nullable|integer',
            //'date_de_naissance' => 'nullable|date',
            'sexe' => ['required', Rule::in(['Homme', 'Femme'])],
            'telephone' => 'required|unique:utilisateur,telephone,'.$id.',id_utilisateur',
            //'email' => 'required|unique:utilisateur,email,'.$id.',id_utilisateur',
        ];
    }
}
