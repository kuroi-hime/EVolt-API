<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use APP\Models\Borne;
use APP\Models\User;

class Reservation extends Model
{
    protected $fillable = [
        'heure_debut',
        'duree_estimee',
        'est_annulee',
        'user_id',
        'borne_id',
    ];

    public function borne()
    {
        return $this->belongsTo(Borne::class);
    }

    public function reservateur()
    {
        return $this->belongsTo(User::class);
    }
}
