@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tableau de bord du client</div>

                    <div class="card-body">
                        <p>Bienvenue sur votre tableau de bord, {{ Auth::user()->name }}!</p>
                        <h3>Vos commandes</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Commande</th>
                                    <th>Date de commande</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commandes as $commande)
                                    <tr>
                                        <td>{{ $commande->id }}</td>
                                        <td>{{ $commande->created_at }}</td>
                                        <td>{{ $commande->montant }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h3>Liste des produits</h3>
                        <ul>
                            @foreach($produits as $produit)
                                <li>{{ $produit->nom }} - Prix : {{ $produit->prix }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

