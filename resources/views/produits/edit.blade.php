<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Produit</title>
    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Barre de navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>
            <ul class="flex space-x-4">
                <li><a href="/" class="text-gray-600 hover:text-gray-800">Accueil</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-800">À propos</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-8">Modifier le Produit</h1>
            <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="photo" class="block text-sm font-bold mb-2">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-input w-full">
                    @if($produit->photo_url)
                    <div class="mt-2">
                        <label class="block text-sm font-medium">Photo actuelle :</label>
                        <img src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}"
                            class="mt-2 h-20 object-cover rounded-lg shadow-md">
                    </div>
                    @else
                    <p>Aucune photo disponible.</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-bold mb-2">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-input w-full" value="{{ $produit->nom }}"
                        required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-bold mb-2">Description</label>
                    <textarea name="description" id="description" class="form-textarea w-full"
                        required>{{ $produit->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="prix" class="block text-sm font-bold mb-2">Prix</label>
                    <input type="number" name="prix" id="prix" class="form-input w-full"
                        value="{{ $produit->prix }}" required>
                </div>
                <div class="mb-4">
                    <label for="quantite" class="block text-sm font-bold mb-2">Quantité</label>
                    <input type="number" name="quantite" id="quantite" class="form-input w-full"
                        value="{{ $produit->quantite }}" required>
                </div>
                
                
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier</button>
            </form>
        </div>
    </main>

    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

</body>

</html>


