<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        return view('produits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produit = Produit::create($request->all());

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('produits');
            $produit->photo = $photoPath;
            $produit->save();
        }

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès!');
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.show', compact('produit'));
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.edit', compact('produit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->update($request->all());

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('produits');
            $produit->photo = $photoPath;
            $produit->save();
        }

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès!');
    }
}

