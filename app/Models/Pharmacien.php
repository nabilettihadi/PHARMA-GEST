<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pharmacien extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom_pharmacie',
        'adresse',
        'telephone',
    ];

    public function utilisateur()  
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}

