<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        // seulement les informations ajouter lors de la création + les timestapms.
        $reservation = Reservation::create([
            'heure_debut' => $request->heure_debut,
            'duree_estimee' => $request->duree_estimee,
            'user_id' => $request->user_id,
            'borne_id' => $request->borne_id
            ]);

        // Je dois d'abord vérifier que la borne n'est pas réserver durant cette periode.
        return response()->json([
            'message' => 'Réservation ajoutée avec succés.',
            'réservation' => $reservation
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $data[] = [];

        if($request->filled('heure_debut'))
            $data['heure_debut'] = $request->heure_debut;

        if($request->filled('duree_estimee'))
            $data['duree_estimee'] = $request->duree_estimee;

        if($request->filled('est_annulee'))
            $data['est_annulee'] = $request->est_annulee;

        if($data)
            $reservation->update($data);

        return response()->json([
            'message'=>"Réservation modifiée.",
            'réservation'=>$reservation,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
