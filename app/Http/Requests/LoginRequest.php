<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'=>'required|email|exists:users,email',
            'password'=>'required|string|min:6',
        ];
    }

    /**
     * 
     */
    public function messages()
    {
        return [
            'email.required'=>"Vous devez entrer un mail.",
            'email.exists'=>"Vous n'êtes pas inscrit.",
            'password.required'=>"Le mot de passe est obligatoire.",
            'password.min'=>"Mot de passe court(min :6 caractères).",
        ];
    }
}
