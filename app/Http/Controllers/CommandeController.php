<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::all();
        return view('commandes.index', compact('commandes'));
    }
    public function mesCommandes()
    {
        $commandes = Commande::where('user_id', auth()->id())->get();
        return view('utilisateur.mescommandes', compact('commandes'));
    }

    public function ajouterAuPanier($produitId)
    {
        // Vérifier si l'utilisateur est connecté
        if (Auth::check()) {
            // Récupérer l'utilisateur authentifié
            $user = Auth::user();
    
            // Récupérer le produit du panier de l'utilisateur s'il existe
            $commandeExistante = Commande::where('user_id', $user->id)
                ->where('produits', $produitId)
                ->where('etat', 'En attente')
                ->first();
    
            if ($commandeExistante) {
                // Le produit existe déjà dans le panier, mettez à jour la quantité et le total
                $commandeExistante->quantite += 1; // Augmentez la quantité
                $commandeExistante->total = $commandeExistante->quantite * $commandeExistante->produit->prix; // Recalculez le total
    
                // Vérifiez si le produit existe avant d'accéder à sa propriété "produit"
                if ($commandeExistante->produit) {
                    $commandeExistante->save();
                    return redirect()->back()->with('success', 'Quantité du produit mise à jour dans le panier avec succès!');
                } else {
                    return redirect()->back()->with('error', 'Le produit associé à la commande n\'existe pas.');
                }
            } else {
                // Le produit n'est pas encore dans le panier, créez une nouvelle commande
                $produit = Produit::findOrFail($produitId);
                $prixProduit = $produit->prix;
    
                // Calculer le total en multipliant la quantité par le prix du produit
                $quantite = 1; // Vous pouvez récupérer la quantité à partir de l'interface utilisateur
                $total = $quantite * $prixProduit;
    
                // Créer une nouvelle commande avec le statut "En attente"
                $commande = new Commande();
                $commande->user_id = $user->id;
                $commande->produits = $produitId;
                $commande->quantite = $quantite; // Enregistrer la quantité
                $commande->total = $total; // Enregistrer le total calculé
                $commande->etat = 'En attente';
                $commande->save();
    
                return redirect()->back()->with('success', 'Produit ajouté au panier avec succès!');
            }
        } else {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour ajouter des produits au panier.');
        }
    }
    

    public function create()
    {
        $clients = Client::all();
        return view('commandes.create', compact('clients'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'produits' => 'required|string',
            'total' => 'required|numeric',
            'etat' => 'required|string',
        ]);

        // Création de la commande
        Commande::create($request->all());

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès!');
    }

    public function show($id)
    {
        $commande = Commande::find($id);
        return view('commandes.show', compact('commande'));
    }

    public function edit($id)
    {
        $commande = Commande::find($id);
        $clients = Client::all();
        return view('commandes.edit', compact('commande', 'clients'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'produits' => 'required|string',
            'total' => 'required|numeric',
            'etat' => 'required|string',
        ]);

        // Mise à jour de la commande
        $commande = Commande::find($id);
        $commande->update($request->all());

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès!');
    }

    public function destroy($id)
    {
        // Suppression de la commande
        Commande::destroy($id);
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès!');
    }
}
