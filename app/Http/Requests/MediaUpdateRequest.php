<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaUpdateRequest extends FormRequest
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
            'description' => 'required',
            'url' => 'required|url',
            'id_experience_professionnelle' => 'nullable|integer|max:11',
            'id_certification' => 'nullable|integer|max:11',
            'id_education' => 'nullable|integer|max:11'
        ];
    }
}
