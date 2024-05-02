<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\User;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller
{

    public function index()
    {

        $commandes = Commande::where('user_id', auth()->id())->with('produits')->get();

        return view('utilisateur.dashboard', compact('commandes'));
    }


    public function completerProfil(Request $request)
    {
        $request->validate([
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        $user = Auth::user();


        $user->adresse = $request->adresse;
        $user->telephone = $request->telephone;


        if (!$user->client) {
            $client = new Client([
                'user_id' => $user->id,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
            ]);
            $client->save();
        }

        return redirect()->back()->with('success', 'Profil complété avec succès.');
    }


    public function mesCommandes()
    {
        $commandes = Commande::where('user_id', auth()->id())->get();
        return view('utilisateur.mescommandes', compact('commandes'));
    }

    public function statistiques()
    {
        
        $user = Auth::user();
    
        // Nombre de commandes confirmées
        $nombreCommandesConfirmees = Commande::where('user_id', $user->id)
            ->where('etat', 'Confirmée')
            ->count();
    
        // Nombre de commandes en attente
        $nombreCommandesEnAttente = Commande::where('user_id', $user->id)
            ->where('etat', 'En attente')
            ->count();
    
        // Commande la plus chère
        $commandePlusChere = Commande::where('user_id', $user->id)
            ->orderByDesc('total')
            ->first();
    
        // Commande la moins chère
        $commandeMoinsChere = Commande::where('user_id', $user->id)
            ->orderBy('total')
            ->first();
    
        return view('utilisateur.statistiques', compact('nombreCommandesConfirmees', 'nombreCommandesEnAttente', 'commandePlusChere', 'commandeMoinsChere'));

    }

    public function about()
    {

        return view('about');
    }

    public function rechercherCommandes(Request $request)
    {
        $search = $request->input('search');


        $commandes = Commande::whereHas('produits', function ($query) use ($search) {
            $query->where('nom', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->with('produits')
            ->get();

        return response()->json(['commandes' => $commandes]);
    }

    public function Allclients()
    {

        $users = User::where('role', 'utilisateur')->get();
        return view('utilisateur.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);


        if ($user->client()->exists()) {

            $user->client()->delete();
        }


        $user->delete();

        return redirect()->route('client.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
