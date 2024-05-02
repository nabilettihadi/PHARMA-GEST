<?php

namespace App\Http\Controllers;

use App\Models\Pharmacien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacienController extends Controller
{
    public function index()
    {
        return view('pharmacien.dashboard');
    }


    public function AllPharmaciens()
    {
        $pharmaciens = User::where('role', 'pharmacien')->get();
        return view('pharmacien.index', compact('pharmaciens'));
    }

    public function destroy($id)
{
    $pharmacien = User::findOrFail($id);

    // Supprimer d'abord les enregistrements liés dans les autres tables, par exemple dans la table pharmacien
    $pharmacien->pharmacien()->delete();

    // Ensuite, supprimer l'utilisateur même s'il existe des enregistrements liés
    $pharmacien->forceDelete();

    return redirect()->route('pharmacien.index')->with('success', 'Pharmacien supprimé avec succès');
}




    public function completerProfil(Request $request)
    {
        $request->validate([
            'nom_pharmacie' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        $user = Auth::user();

        // Mettre à jour les informations de base de l'utilisateur
        $user->adresse = $request->adresse;
        $user->telephone = $request->telephone;

        // Vérifier si le pharmacien a déjà un profil enregistré
        if (!$user->pharmacien) {
            $pharmacien = new Pharmacien([
                'user_id' => $user->id,
                'nom_pharmacie' => $request->nom_pharmacie,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
            ]);
            $pharmacien->save();
        }

        return redirect()->back()->with('success', 'Profil complété avec succès.');
    }


}
