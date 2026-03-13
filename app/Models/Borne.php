<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borne extends Model
{
    protected $fillable = [
        'nom_borne',
        'type_connecteur',
        'puissance_borne',
        'latitude_borne',
        'longitude_borne',
        'distance'
    ];

    protected $hidden = [
        'latitude_borne',
        'longitude_borne',
    ];

    protected $casts = [
        'distance' => 'float', // caster en float
    ];
}
