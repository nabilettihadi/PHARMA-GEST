<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pharmacien;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;

class AdminController extends Controller
{
    public function index()
{
    // Nombre total de pharmaciens
    $nombrePharmaciens = User::where('role', 'pharmacien')->count();

    // Nombre total de clients
    $nombreClients = User::where('role', 'utilisateur')->count();

    // Récupérer tous les utilisateurs avec leurs produits créés (role = pharmacien)
    $utilisateursAvecProduits = User::where('role', 'pharmacien')->with('produits')->get();

    // Récupérer toutes les commandes des utilisateurs ayant le rôle d'utilisateur
    $commandesParClient = User::where('role', 'utilisateur')->with('commandes')->get();

    return view('admin.dashboard', compact('nombrePharmaciens', 'nombreClients', 'utilisateursAvecProduits', 'commandesParClient'));
}

}
