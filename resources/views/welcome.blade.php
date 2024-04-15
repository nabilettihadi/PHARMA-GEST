<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
            <ul class="flex space-x-4">
                <li><a href="#" class="text-gray-600 hover:text-gray-800">Accueil</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-800">À propos</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
            </ul>
        </div>
    </nav>

    <!-- En-tête avec image de fond et texte -->
    <header class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-32 px-8">
        <div class="container mx-auto">
            <h1 class="text-5xl font-bold mb-4">Votre santé, notre priorité</h1>
            <p class="text-lg mb-8">Trouvez les meilleurs produits pharmaceutiques et services médicaux.</p>
            <a href="#"
                class="bg-white text-blue-500 font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-blue-600 hover:text-white transition duration-300">Découvrir</a>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Section Services -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-user-md text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Services Médicaux</h2>
                <p class="text-gray-600">Des professionnels de la santé pour vous conseiller et vous aider.</p>
            </div>
            <!-- Section Produits -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-pills text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Produits de Qualité</h2>
                <p class="text-gray-600">Une large gamme de médicaments et produits pharmaceutiques.</p>
            </div>
            <!-- Section Conseils -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-stethoscope text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Conseils Santé</h2>
                <p class="text-gray-600">Des informations et conseils pour une vie saine et équilibrée.</p>
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
