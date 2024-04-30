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

    public function statistiques()
    {
        return view('utilisateur.statistiques');
    }

    public function about(){

        return view('about');
    }

    public function rechercherCommandes(Request $request)
{
    $search = $request->input('search');

    // Recherche des commandes par produits
    $commandes = Commande::whereHas('produits', function ($query) use ($search) {
        $query->where('nom', 'like', "%{$search}%");
    })->get();

    // Rendre la vue des résultats de la recherche et la renvoyer sous forme de réponse JSON
    $view = view('utilisateur.mescommandes', compact('commandes'))->render();

    return response()->json(['html' => $view]);
}

}
