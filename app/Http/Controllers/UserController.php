<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        //Authentification sans passer par login
        // Sécurité : récupérer que l'email et le mot de passe du formulaire de connexion
        $attributs = $request->only('email', 'password');

        // Connecter l'utilisateur avec les attributs récupérés
        Auth::attempt($attributs);

        $user = Auth::user();
        // Supprimer les tokens non utilisés.
        $user->tokens()->delete();
        $abilities = $user->role->id == 2 ? ['users:read']:['*'];
        $token = $user->createToken('evolt_token', $abilities)->plainTextToken;

        return response()->json([
            'message' => 'Utilisateur créé avec succés.',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'can'=>$abilities,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['user' => User::findOr($id, function(){
            return null;
        })]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        if($request->password)
            $data['password'] = Hash::make($request->password);
        $user->update($data);
        return response()->json([
            'message'=>"Mise à jour d'utilisateur avec succès.",
            'user'=>$user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message'=>"Suppression d'utilisateur et de ses réservations avec succès.",
        ]);
    }
}
