<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
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
                <li><a href="#" class="text-gray-600 hover:text-gray-800">Accueil</a></li>
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
            <h1 class="text-3xl font-bold text-center mb-8">Détails du Produit</h1>
            <div class="flex justify-center mb-6">
                @if ($produit->photo)
                <img src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}"
                    class="border border-gray-300 shadow-lg rounded-lg" style="max-width: 300px; max-height: 300px;">
                @else
                <p class="text-center">Pas de photo disponible</p>
                @endif
            </div>
            <div class="grid grid-cols-2 gap-4">
                <p class="font-semibold">Nom:</p>
                <p>{{ $produit->nom }}</p>
                <p class="font-semibold">Description:</p>
                <p>{{ $produit->description }}</p>
                <p class="font-semibold">Prix:</p>
                <p>{{ $produit->prix }}</p>
                <p class="font-semibold">Quantité:</p>
                <p>{{ $produit->quantite }}</p>
            </div>
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


