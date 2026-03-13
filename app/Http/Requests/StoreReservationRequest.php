<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'heure_debut' => 'nullable|date|after:now',
            'duree_estimee' => 'required|integer|min:1',
            'user_id' => 'required|integer|exists:users,id',
            'borne_id' => 'required|integer|exists:bornes,id',
        ];
    }

    /**
     * 
     */
    public function messages()
    {
        return [
            'duree_estimee.required' => 'Entrez la durée estimée.',
            'duree_estimee.min' => 'La durée doit être > 1min',
            'user_id.required' => "Entrez l'identifiant de réservateur.",
            'user_id.exists' => 'Réservateur inexistant.',
            'borne_id.required' => "Entrez l'identifiant de la borne.",
            'borne_id.exists' => 'Borne inexistante.',
        ];
    }
}
