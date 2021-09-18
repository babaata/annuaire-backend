<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LangueUpdateRequest extends FormRequest
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
            'niveau' => 'nullable|max:255',
            'slug' => 'nullable|max:255',
            'id_profil' => 'required|integer'
        ];
    }
}
