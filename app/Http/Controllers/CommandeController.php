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

    public function ajouterAuPanier($produitId)
    {

        if (Auth::check()) {

            $user = Auth::user();


            $commandeExistante = Commande::where('user_id', $user->id)
                ->where('produit_id', $produitId)
                ->where('etat', 'En attente')
                ->first();

            if ($commandeExistante) {
                $commandeExistante->quantite += 1;
                $commandeExistante->total = $commandeExistante->quantite * $commandeExistante->produits->prix;


                if ($commandeExistante->produits) {
                    $commandeExistante->save();
                    return redirect()->back()->with('success', 'Quantité du produit mise à jour dans le panier avec succès!');
                } else {
                    return redirect()->back()->with('error', 'Le produit associé à la commande n\'existe pas.');
                }
            } else {

                $produit = Produit::findOrFail($produitId);
                $prixProduit = $produit->prix;


                $quantite = 1;
                $total = $quantite * $prixProduit;


                $commande = new Commande();
                $commande->user_id = $user->id;
                $commande->produit_id = $produitId;
                $commande->quantite = $quantite;
                $commande->total = $total;
                $commande->etat = 'En attente';
                $commande->save();

                return redirect()->back()->with('success', 'Produit ajouté au panier avec succès!');
            }
        } else {

            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour ajouter des produits au panier.');
        }
    }

    public function increment($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->quantite++;
        $commande->total = $commande->quantite * $commande->produits->prix;
        $commande->save();

        return redirect()->back();
    }

    public function decrement($id)
    {
        $commande = Commande::findOrFail($id);
        if ($commande->quantite > 0) {
            $commande->quantite--;
            $commande->total = $commande->quantite * $commande->produits->prix;
            $commande->save();
        }


        if ($commande->quantite === 0) {
            $commande->delete();
        }

        return redirect()->back();
    }

    public function confirm($id)
    {
        $commande = Commande::findOrFail($id);

        $produit = $commande->produits;

        if (!$produit) {
            return redirect()->back()->with('error', 'La commande ne contient pas de produit associé.');
        }


        if ($commande->quantite > $produit->quantite) {
            return redirect()->back()->with('error', 'La quantité commandée est supérieure à la quantité disponible.');
        }

        $produit->quantite -= $commande->quantite;


        $produit->save();


        $commande->etat = 'Confirmée';
        $commande->save();


        if ($produit->quantite < 0) {
            $produit->delete();
        }

        return redirect()->back()->with('success', 'Commande confirmée avec succès.');
    }




    public function cancel($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();

        return redirect()->back();
    }

    public function filtrerCommandes(Request $request)
    {
        $etat = $request->input('etat');

        if ($etat === 'Tous') {
            $commandes = Commande::all();
        } elseif ($etat === 'En attente' || $etat === 'Confirmée') {
            $commandes = Commande::where('etat', $etat)->get();
        } else {
            $commandes = Commande::all();
        }

        return view('utilisateur.mescommandes', ['commandes' => $commandes]);
    }
}
