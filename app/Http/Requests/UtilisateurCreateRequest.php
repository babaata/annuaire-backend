<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UtilisateurCreateRequest extends FormRequest
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
            'nom' => 'required|string|max:100|min:3',
            'prenom' => 'required|string|max:100|min:3',
            'telephone' => 'required',
            'email' => 'required|email|unique:utilisateur',
            'username' => 'required|max:100',
            //'username' => ['required', 'string', 'max:100', 'unique:utilisateur', 'regex:/^\S*$/u'],
            'password' => 'required|min:6',
        ];
    }
}
