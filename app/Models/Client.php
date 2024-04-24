<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Optional: Include soft deletes

class Client extends Model
{
    use HasFactory;

    // Optional: Enable soft deletes if needed
    use SoftDeletes;

    protected $fillable = [
        'utilisateur_id',
        'adresse',
        'telephone',
    ];

    public function utilisateur()  
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}