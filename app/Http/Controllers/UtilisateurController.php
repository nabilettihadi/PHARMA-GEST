<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        // Récupérer les commandes de l'utilisateur authentifié
        $commandes = Commande::where('client_id', auth()->id())->get();

        // Récupérer la liste des produits
        $produits = Produit::all();

        // Passer les données à la vue
        return view('utilisateur.dashboard', compact('commandes', 'produits'));
    }

    public function about(){

        return view('about');
    }
}
