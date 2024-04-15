<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'produits',
        'total',
        'etat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
