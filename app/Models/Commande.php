<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produit;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produits',
        'quantite',
        'total',
        'etat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produits');
    }
}
