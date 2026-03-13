<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchBorneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_borne' => 'sometimes|string|nullable',
            'type_connecteur' => 'sometimes|string|nullable',
            'puissance_min' => 'sometimes|integer|nullable',
            'latitude' => 'sometimes|numeric|between:-90,90|nullable',
            'longitude' => 'sometimes|numeric|between:-180,180|nullable',
            'rayon' => 'sometimes|integer|between:5,100|nullable',
        ];
    }

    /**
     * 
     */
    public function messages()
    {
        return [
            'nom_borne.min' => 'min:1',
            'type_connecteur.min' => 'min:1',
            'puissance_min.min' => 'min:1',
            'latitude.between' => 'between:-90,90',
            'longitude.between' => 'between:-180,180',
            'rayon.between' => 'between:5,100',
        ];
    }
}
