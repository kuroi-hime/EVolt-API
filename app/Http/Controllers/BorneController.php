<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchBorneRequest;
use App\Http\Requests\StoreBorneRequest;
use App\Http\Requests\UpdateBorneRequest;
use App\Models\Borne;

class BorneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchBorneRequest $request)
    {
        // les latitudes et longitudes en radian.(on a degré)
        $query = Borne::select('*');

        if($request->filled('nom_borne'))
            $query = $query->where('nom_borne', 'ilike', '%'.$request->nom_borne.'%');

        if($request->filled('type_connecteur')) // ça marche pas
            $query = $query->where('type_connecteur', 'ilike', '%'.$request->type_connecteur.'%');

        if($request->filled('puissance_min'))
            $query = $query->where('puissance_borne', '>=', $request->puissance_min);

        if($request->filled(['latitude', 'longitude']))
            $query = $query->selectRaw("6371*acos(cos(radians(latitude_borne))*cos(radians(?))*cos(radians(?)-radians(longitude_borne))+sin(radians(latitude_borne))*sin(radians(?))) as distance", [$request->latitude, $request->longitude, $request->latitude]);
    
        $data = $query->get();
        if($request->filled('rayon'))
            $data = $data->reject(fn($d) => $d->distance > $request->rayon);

        return response()->json([
            'count' => count($data),
            'bornes' => $data,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorneRequest $request)
    {
        $borne = Borne::create([
                'nom_borne' => $request->nom_borne,
                'type_connecteur' => $request->type_connecteur,
                'puissance_borne' => $request->puissance_borne,
                'latitude_borne' => $request->latitude_borne,
                'longitude_borne' => $request->longitude_borne,
            ]);

        return response()->json([
            'message' => 'Borne ajoutée avec succés.',
            'borne' => $borne,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Borne $borne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorneRequest $request, Borne $borne)
    {
        $data[] = [];
        if($request->filled('nom_borne'))
            $data['nom_borne'] = $request->nom_borne;

        if($request->filled('type_connecteur'))
            $data['type_connecteur'] = $request->type_connecteur;

        if($request->filled('puissance_borne'))
            $data['puissance_borne'] = $request->puissance_borne;

        if($request->filled('latitude_borne'))
            $data['latitude_borne'] = $request->latitude_borne;

        if($request->filled('longitude_borne'))
            $data['longitude_borne'] = $request->longitude_borne;

        if($data)
            $borne->update($data);

        return response()->json([
            'message' => 'Borne mise à jour.',
            'borne' => $borne
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borne $borne)
    {
        $borne->delete();

        return response()->json([
            'message' => 'Borne supprimée avec succés.'
        ]);
    }
}
