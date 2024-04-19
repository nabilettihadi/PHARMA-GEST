<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord pharmacien</title>
    <!-- Lien vers Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Lien vers Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Barre de navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>
            {{-- <ul class="flex space-x-4">
                <li><a href="#" class="text-gray-600 hover:text-gray-800">Accueil</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-800">À propos</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
            </ul> --}}
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Section Gérer les Produits -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-8 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <h2 class="text-2xl font-semibold mb-4">Gérer les Produits</h2>
                <p class="text-lg mb-4">Accédez à la liste des produits de votre pharmacie et gérez-les facilement.</p>
                <a href="{{ route('produits.index') }}"
                    class="bg-white text-blue-500 font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-blue-600 hover:text-white transition duration-300 inline-block">Voir
                    les Produits</a>
            </div>
            <!-- Section Statistiques -->
            <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white p-8 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <h2 class="text-2xl font-semibold mb-4">Statistiques</h2>
                <p class="text-lg mb-4">Consultez les statistiques de vente, les stocks, etc.</p>
                <a href="{{ route('statistiques.index') }}" class="bg-white text-purple-500 font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-purple-600 hover:text-white transition duration-300 inline-block">Voir
                    les Statistiques</a>
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



