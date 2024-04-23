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
                <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
                <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
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
            <a href="#services-medicaux"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-user-md text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Services Médicaux</h2>
                <p class="text-gray-600">Des professionnels de la santé pour vous conseiller et vous aider.</p>
            </a>
            <!-- Section Produits -->
            <a href="#produits" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-pills text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Produits de Qualité</h2>
                <p class="text-gray-600">Une large gamme de médicaments et produits pharmaceutiques.</p>
            </a>
            <!-- Section Conseils -->
            <a href="#conseils-sante" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-stethoscope text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Conseils Santé</h2>
                <p class="text-gray-600">Des informations et conseils pour une vie saine et équilibrée.</p>
            </a>
        </div>
    </main>


    <!-- Section Services Médicaux -->
    <div id="services-medicaux"
        class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
        <h2 class="text-xl font-semibold mb-4">Services Médicaux</h2>
        <p class="text-gray-600 mb-6">Nos professionnels de la santé sont là pour vous guider et vous aider dans vos
            besoins médicaux.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Nos Services</h3>
                <ul class="list-disc list-inside text-gray-600">
                    <li>Consultations médicales en ligne</li>
                    <li>Analyses de laboratoire à domicile</li>
                    <li>Conseils personnalisés sur les médicaments</li>
                    <li>Services de suivi et de réadaptation à distance</li>
                    <li>Guidance sur les traitements et les effets secondaires</li>
                    <li>Assistance médicale 24/7</li>
                </ul>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Notre Équipe</h3>
                <p class="text-gray-600">Notre équipe comprend des médecins, des pharmaciens, des spécialistes en santé
                    et des infirmiers, tous prêts à vous offrir un service de qualité.</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Pourquoi Nous Choisir ?</h3>
                <ul class="list-disc list-inside text-gray-600">
                    <li>Facilité d'accès à des soins médicaux de qualité</li>
                    <li>Conseils personnalisés selon vos besoins</li>
                    <li>Confidentialité et sécurité de vos informations</li>
                    <li>Plateforme conviviale et intuitive</li>
                    <li>Assistance disponible à tout moment</li>
                    <li>Livraison rapide et efficace de vos médicaments</li>
                </ul>
            </div>
        </div>
    </div>




    <!-- Contenu principal -->
    <main id="produits" class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($produits as $produit)
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    <img src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}"
                        class="w-full mb-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-2">{{ $produit->nom }}</h2>
                    <p class="text-gray-600">{{ $produit->description }}</p>
                    <p class="text-gray-600 mt-2">Prix : {{ number_format($produit->prix, 2, ',', ' ') }} €</p>
                    <a href="#"
                        class="block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg mt-4 text-center">Acheter</a>
                </div>
            @endforeach
        </div>
    </main>


    <!-- Section Conseils Santé -->
    <div id="conseils-sante"
        class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
        <h2 class="text-xl font-semibold mb-4">Conseils Santé</h2>
        <p class="text-gray-600 mb-6">Des informations et conseils pour une vie saine et équilibrée.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Nos Conseils</h3>
                <ul class="list-disc list-inside text-gray-600">
                    <li>Adoptez une alimentation équilibrée et variée</li>
                    <li>Faites de l'exercice régulièrement</li>
                    <li>Pratiquez la relaxation et la méditation</li>
                    <li>Évitez les habitudes nocives comme le tabagisme et l'excès d'alcool</li>
                    <li>Assurez-vous de bien dormir chaque nuit</li>
                    <li>Consultez régulièrement votre médecin pour des bilans de santé</li>
                </ul>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Nos Articles</h3>
                <p class="text-gray-600">Découvrez nos articles sur différents sujets de santé pour rester informé et
                    prendre soin de vous.</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Pourquoi Suivre nos Conseils ?</h3>
                <ul class="list-disc list-inside text-gray-600">
                    <li>Amélioration de votre bien-être général</li>
                    <li>Réduction des risques de maladies chroniques</li>
                    <li>Conseils adaptés à vos besoins spécifiques</li>
                    <li>Approche holistique de la santé</li>
                    <li>Accès à une source d'information fiable et vérifiée</li>
                    <li>Support pour un mode de vie sain et durable</li>
                </ul>
            </div>
        </div>
    </div>



    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

</body>

</html>
