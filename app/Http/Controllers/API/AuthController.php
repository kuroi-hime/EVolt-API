<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * 
     */ 
    public function login(LoginRequest $request){
        // Sécurité : récupérer que l'email et le mot de passe du formulaire de connexion
        $attributs = $request->only('email', 'password');

        // Connecter l'utilisateur avec les attributs récupérés
        if(!Auth::attempt($attributs)){
            return response()->json([
                'error'=> 'Identifiant ou mot de passe incorrect.',
            ]);
        }

        $user = Auth::user();
        // Supprimer les tokens non utilisés.
        $user->tokens()->delete();
        $abilities = $user->role->id == 1 ? ['*']:['user:read'];
        $token = $user->createToken('evolt_token', $abilities)->plainTextToken;

        return response()->json([
            'message'=>"Bienvenue, $user->name",
            'user'=>$user,
            'token'=>$token,
            'token_type'=>'Bearer',
        ]);
    }

    /**
     * 
     */
    public function logout(LogoutRequest $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message'=>'à bientôt.',
        ]);
    }
}
