<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBorneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role->nom_role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_borne' => 'sometimes|string|min:1',
            'type_connecteur' => 'sometimes|string|min:1',
            'puissance_borne' => 'sometimes|integer|min:1',
            'latitude_borne' => 'sometimes|numeric|between:-90,90',
            'longitude_borne' => 'sometimes|numeric|between:-180,180',
        ];
    }

    /**
     * 
     */
    public function messages()
    {
        return [
            'nom_borne.required' => 'required',
            'nom_borne.min' => 'min:1',
            'type_connecteur.required' => 'required',
            'puissance_borne.required' => 'required',
            'puissance_borne.min' => 'min:1',
            'latitude_borne.required' => 'required',
            'latitude_borne.between' => 'between:-90,90',
            'longitude_borne.required' => 'required',
            'longitude_borne.between' => 'between:-180,180',
        ];
    }
}
