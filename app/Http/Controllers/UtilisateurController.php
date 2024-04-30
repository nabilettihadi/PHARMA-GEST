<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    
    public function index()
{
    // Récupérer les commandes de l'utilisateur authentifié avec les produits associés
    $commandes = Commande::where('user_id', auth()->id())->with('produits')->get();
    // Passer les données à la vue
    return view('utilisateur.dashboard', compact('commandes'));
}
    

    public function mesCommandes()
    {
        $commandes = Commande::where('user_id', auth()->id())->get();
        return view('utilisateur.mescommandes', compact('commandes'));
    }

    public function about(){

        return view('about');
    }
}
