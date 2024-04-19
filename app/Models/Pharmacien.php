<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Optional: Include soft deletes

class Pharmacien extends Model
{
    use HasFactory;

    // Optional: Enable soft deletes if needed
    use SoftDeletes;

    protected $fillable = [
        'utilisateur_id',
    ];

    public function utilisateur()  
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}
