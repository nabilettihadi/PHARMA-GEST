<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::all();
        return view('commandes.index', compact('commandes'));
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
