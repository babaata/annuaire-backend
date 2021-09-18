<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificationUpdateRequest extends FormRequest
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
            'organisme_delivrance' => 'required|max:255',
            'level' => 'nullable|max:255',
            'date_certification' => 'nullable|date',
            'url' => 'nullable|url',
            'id_profil' => 'required|integer|max:11'
        ];
    }
}
