<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationCreateRequest extends FormRequest
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
            'ecole' => 'required|max:255',
            'diplome' => 'required|max:255',
            'debut' => 'required|date',
            'fin' => 'required|date',
            'description' => 'required',
            'profil' => 'required|integer'
        ];
    }
}
