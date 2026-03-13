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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borne $borne)
    {
        //
    }
}
