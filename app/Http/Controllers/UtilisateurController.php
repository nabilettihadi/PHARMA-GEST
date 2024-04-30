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

        // Recherche les commandes par nom ou description des produits associés
        $commandes = Commande::whereHas('produits', function ($query) use ($search) {
            $query->where('nom', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })
        ->where('user_id', auth()->id()) // Ajoutez cette condition pour filtrer par l'utilisateur authentifié
        ->orderBy('created_at', 'desc')
        ->with('produits') // Chargez les produits associés aux commandes
        ->get();

        return response()->json(['commandes' => $commandes]);
    }

}
