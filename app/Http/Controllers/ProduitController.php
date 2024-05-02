<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $produits = Produit::where('user_id', $user->id)->get();

        return view('produits.index', compact('produits'));
    }

    public function welcome()
    {
        $produits = Produit::all();
        return view('welcome', compact('produits'));
    }

    public function Page()
    {
        $produits = Produit::paginate(10);

        return view('produits.page', compact('produits'));
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


        $user = Auth::user();

        $produit = new Produit($request->all());
        $produit->user_id = $user->id;
        $produit->save();


        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('produits', 'public');
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
            $photoPath = $request->file('photo')->store('produits', 'public');
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

    // public function statistiques()
    // {

    //     $statistiquesQuantite = Produit::select('nom', DB::raw('SUM(quantite) as quantite_totale'))
    //         ->groupBy('nom')
    //         ->get();

    //     $statistiquesMontant = Produit::select('nom', DB::raw('SUM(prix * quantite) as montant_total'))
    //         ->groupBy('nom')
    //         ->get();


    //     return view('statistiques.index', compact('statistiquesQuantite', 'statistiquesMontant'));
    // }

public function statistiques()
{
    $statistiquesQuantite = Produit::join('commandes', 'produits.id', '=', 'commandes.produit_id')
        ->select('produits.nom', DB::raw('SUM(commandes.quantite) as quantite_totale'))
        ->groupBy('produits.nom')
        ->get();

    $statistiquesMontant = Produit::join('commandes', 'produits.id', '=', 'commandes.produit_id')
        ->select('produits.nom', DB::raw('SUM(produits.prix * commandes.quantite) as montant_total'))
        ->groupBy('produits.nom')
        ->get();

    return view('statistiques.index', compact('statistiquesQuantite', 'statistiquesMontant'));
}

    public function search(Request $request)
    {
        $query = $request->input('query');

        $produits = Produit::where('nom', 'like', '%' . $query . '%')->get();

        return response()->json([
            'produits' => $produits,
        ]);
    }
}
