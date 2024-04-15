<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-blue-400 to-white min-h-screen flex items-center justify-center">
    <div class="max-w-4xl w-full bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-8">Liste des Produits</h1>
        <a href="{{ route('produits.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg mb-4 inline-block">Ajouter un Produit</a>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Prix</th>
                    <th class="px-4 py-2">Quantité</th>
                    <th class="px-4 py-2">Photo</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produits as $produit)
                <tr>
                    <td class="border px-4 py-2">{{ $produit->id }}</td>
                    <td class="border px-4 py-2">{{ $produit->nom }}</td>
                    <td class="border px-4 py-2">{{ $produit->description }}</td>
                    <td class="border px-4 py-2">{{ $produit->prix }}</td>
                    <td class="border px-4 py-2">{{ $produit->quantite }}</td>
                    <td class="border px-4 py-2">
                        @if ($produit->photo)
                        <img src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}" class="h-10">
                        @else
                        Pas de photo
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('produits.show', $produit->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-lg mr-2">Voir</a>
                        <a href="{{ route('produits.edit', $produit->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-lg mr-2">Modifier</a>
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-lg" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
