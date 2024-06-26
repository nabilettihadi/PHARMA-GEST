<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Barre de navigation -->
    <nav class="navbar py-4 bg-white shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>


            <ul class="hidden md:flex space-x-4 items-center">
                <!-- Authentification -->
                @auth
                    @if (auth()->user()->role === 'utilisateur')
                        <li><a href="{{ route('utilisateur.dashboard') }}"
                                class="text-gray-600 hover:text-gray-800">Dashboard</a></li>
                    @elseif(auth()->user()->role === 'pharmacien')
                        <li><a href="{{ route('pharmacien.dashboard') }}"
                                class="text-gray-600 hover:text-gray-800">Dashboard</a></li>
                    @endif
                @endAuth
                <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
                <!-- Authentification pour le panier -->
                @guest
                    <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800"><i
                                class="fas fa-user-plus mr-1"></i>Inscription</a></li>
                    <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800"><i
                                class="fas fa-user-plus mr-1"></i>Connexion</a></li>
                @endguest
            </ul>
            <!-- Menu de navigation -->
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none mr-4" id="burgerBtn">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            <!-- Panier -->
            <ul class="md:flex space-x-4 items-center">
                <li>
                    <a href="#" id="cartNavbarBtn"
                        class="flex items-center justify-center rounded-md bg-blue-500 px-4 py-2 text-white font-semibold hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        @auth
                            <span
                                class="cart-items">{{ auth()->user()->commandes()->where('etat', 'En attente')->count() }}</span>
                        @endauth
                    </a>
                </li>

            </ul>
        </div>

        <!-- Menu burger pour les écrans mobiles -->
        <ul class="md:hidden bg-white absolute top-0 left-0 right-0 mt-16 rounded-lg shadow-md py-4 px-6 space-y-4 text-center"
            style="display: none;" id="burgerMenu">
            @guest
                <!-- Authentification pour mobile -->
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
                <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
            @endguest
            <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
            <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
            <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
        </ul>

        <div class="relative">
            <ul class="absolute right-0 w-70 bg-white border border-gray-200 shadow-md rounded-lg mt-2 py-4 hidden mr-2 z-50"
                id="cartDropdown">
                <!-- Liste des commandes de l'utilisateur -->
                @auth
                    @foreach (auth()->user()->commandes()->where('etat', 'En attente')->get() as $commande)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                            <!-- Contenu de la carte -->
                            <div class="px-4 py-2">
                                <div class="flex items-center space-x-4">
                                    <!-- Image et détails de la commande -->
                                    <img src="{{ asset('storage/' . $commande->produits->photo) }}"
                                        alt="{{ $commande->produits->nom }}"
                                        class="w-16 h-16 object-cover rounded-lg shadow-lg">
                                    <div>
                                        <p class="font-semibold text-xl">{{ $commande->produits->nom }}</p>
                                        <p class="text-sm text-gray-600">Quantité: {{ $commande->quantite }}</p>
                                    </div>
                                </div>
                                <!-- Actions -->
                                <div class="flex items-center space-x-4 mt-4">
                                    <!-- Décrémenter la quantité -->
                                    <form action="{{ route('commandes.decrement', ['id' => $commande->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-danger btn-sm bg-red-500 hover:bg-red-600 rounded-full px-3 py-1">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </form>
                                    <p id="quantite-{{ $commande->id }}" class="text-lg font-semibold">
                                        {{ $commande->quantite }}</p>
                                    <form action="{{ route('commandes.increment', ['id' => $commande->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-primary btn-sm bg-blue-500 hover:bg-blue-600 rounded-full px-3 py-1">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                    <!-- Annuler la commande -->
                                    <form action="{{ route('commandes.cancel', ['id' => $commande->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-danger btn-sm bg-red-500 hover:bg-red-600 rounded-full px-3 py-1">
                                            <i class="fas fa-times"></i>Annuler
                                        </button>
                                    </form>
                                    <!-- Confirmer la commande -->
                                    <form action="{{ route('commandes.confirm', ['id' => $commande->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-success btn-sm bg-green-500 hover:bg-green-600 rounded-full px-3 py-1">
                                            <i class="fas fa-check"></i>Confirmer
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Pied de la carte -->
                            <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                                <div>
                                    <span class="text-gray-600 block">Total:</span>
                                    <span class="font-semibold">${{ $commande->total }}</span>
                                </div>
                                <div>
                                    <span class="text-green-600 font-semibold">État:
                                        @if ($commande->etat == 'En attente')
                                            <span class="text-red-600">{{ $commande->etat }}</span>
                                        @else
                                            <span class="text-green-600">{{ $commande->etat }}</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endauth
            </ul>
        </div>
    </nav>



    <!-- En-tête avec image de fond et texte -->
    <header class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-8 px-8 md:py-16 flex items-center">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row items-center">

                <div class="md:w-1/2 md:mr-8 mb-2 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">Votre santé, notre priorité</h1>
                    <p class="text-base md:text-lg mb-4">Trouvez les meilleurs produits pharmaceutiques et services
                        médicaux.</p>
                    <a href="#"
                        class="bg-white text-blue-500 font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-blue-600 hover:text-white transition duration-300">Découvrir</a>
                </div>

                <div class="md:w-1/2">
                    <img src="{{ asset('storage/photos/portrait.png') }}" alt="Votre image"
                        class="w-full rounded-lg">
                </div>

            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">

        <!-- Section Services -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Section Services Médicaux -->
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
            <a href="#conseils-sante"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-stethoscope text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Conseils Santé</h2>
                <p class="text-gray-600">Des informations et conseils pour une vie saine et équilibrée.</p>
            </a>
        </div>

        <!-- Section Services Médicaux -->
        <div id="services-medicaux"
            class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 mt-8">
            <h2 class="text-xl font-semibold mb-4 text-center">Services Médicaux</h2>
            <p class="text-gray-600 mb-6 text-center">Nos professionnels de la santé sont là pour vous guider et vous
                aider dans vos
                besoins médicaux.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <div class="bg-gray-100  p-4 rounded-lg shadow-md question" onclick="toggleAnswer('services')">
                        <h3 class="text-lg font-semibold mb-2 text-center">Nos Services</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <ul class="list-disc list-inside text-gray-600 answer" id="services" style="display: none;">
                            <li>Consultations médicales en ligne</li>
                            <li>Analyses de laboratoire à domicile</li>
                            <li>Conseils personnalisés sur les médicaments</li>
                            <li>Services de suivi et de réadaptation à distance</li>
                            <li>Guidance sur les traitements et les effets secondaires</li>
                            <li>Assistance médicale 24/7</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question " onclick="toggleAnswer('equipe')">
                        <h3 class="text-lg font-semibold mb-2 text-center">Notre Équipe</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <p class="text-gray-600 answer" id="equipe" style="display: none;">Notre équipe comprend
                            des
                            médecins, des pharmaciens, des spécialistes en santé et des infirmiers, tous prêts à vous
                            offrir un service de qualité.</p>
                    </div>
                </div>
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question" onclick="toggleAnswer('choisir')">
                        <h3 class="text-lg font-semibold mb-2 text-center">Pourquoi Nous Choisir ?</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <ul class="list-disc list-inside text-gray-600 answer" id="choisir" style="display: none;">
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
        </div>
        <!-- Section Produits -->
        <div id="produits" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-8">
            <!-- Product Cards -->
            @foreach ($produits as $produit)
                <div
                    class="group my-10 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md product-card">
                    <a class="relative mx-3 mt-3 flex h-80 overflow-hidden rounded-xl shadow-md transition duration-300 transform hover:scale-105"
                        href="#">
                        <img class="peer absolute top-0 right-0 h-full w-full object-cover"
                            src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}" />
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white p-4">
                            <p class="text-sm">{{ $produit->description }}</p>
                        </div>
                    </a>
                    <div class="mt-4 px-5 pb-5">
                        <a href="#">
                            <h5 class="text-lg font-bold tracking-tight text-gray-900">{{ $produit->nom }}</h5>
                        </a>
                        <div class="mt-2 mb-5 flex items-center justify-between">
                            <p>
                                <span
                                    class="text-2xl font-bold text-gray-900">{{ number_format($produit->prix, 2, ',', ' ') }}
                                    €</span>
                            </p>


                            @auth
                                @if (auth()->user()->role === 'utilisateur')
                                    <form action="{{ route('ajouter-au-panier', $produit->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-gradient-to-r from-blue-500 to-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white rounded-md hover:from-blue-700 hover:to-blue-900 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Ajouter au panier
                                        </button>
                                    </form>
                                @endif
                            @endauth

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Section Conseils Santé -->
        <div id="conseils-sante"
            class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 mt-8">
            <h2 class="text-xl font-semibold text-white mb-4 text-center">Conseils Santé</h2>
            <p class="text-gray-600 mb-6 text-center">Des informations et des conseils pour une vie saine et
                équilibrée.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question cursor-pointer"
                        onclick="toggleAnswer('conseils')">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Nos Conseils</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <ul class="list-disc list-inside text-gray-600 answer" id="conseils" style="display: none;">
                            <li>Adoptez une alimentation équilibrée et variée</li>
                            <li>Faites de l'exercice régulièrement</li>
                            <li>Pratiquez la relaxation et la méditation</li>
                            <li>Évitez les habitudes nocives comme le tabagisme et l'excès d'alcool</li>
                            <li>Assurez-vous de bien dormir chaque nuit</li>
                            <li>Consultez régulièrement votre médecin pour des bilans de santé</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question cursor-pointer"
                        onclick="toggleAnswer('articles')">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Nos Articles</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <p class="text-gray-600 answer" id="articles" style="display: none;">Découvrez nos articles
                            sur
                            différents sujets de santé pour rester informé et prendre soin de vous.</p>

                    </div>
                </div>
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question cursor-pointer"
                        onclick="toggleAnswer('pourquoi')">

                        <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Pourquoi Suivre nos Conseils ?
                        </h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <ul class="list-disc list-inside text-gray-600 answer" id="pourquoi" style="display: none;">
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
        </div>
        </div>
    </main>
    <!-- Newsletter Section -->


    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
        });

        const button = document.querySelector('button');
        const menu = document.querySelector('.md\\:hidden ul');

        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        const addToCartButtons = document.querySelectorAll('.grid #produits button');
        const cartItems = document.querySelector('.cart-items');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', () => {
                cartItems.textContent = parseInt(cartItems.textContent) + 1;
            });
        });
    </script>
    <script>
        function toggleAnswer(id) {
            const answer = document.getElementById(id);
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartNavbarBtn = document.getElementById('cartNavbarBtn');
            const cartDropdown = document.getElementById('cartDropdown');
            const cartDropdownMobile = document.getElementById('cartDropdownMobile');
            const burgerBtn = document.getElementById('burgerBtn');
            const burgerMenu = document.getElementById('burgerMenu');

            cartNavbarBtn.addEventListener('click', () => {
                cartDropdown.classList.toggle('hidden');
                cartDropdownMobile.classList.add('hidden');
            });

            burgerBtn.addEventListener('click', () => {
                burgerMenu.style.display = burgerMenu.style.display === 'none' ? 'block' : 'none';
                cartDropdownMobile.classList.add('hidden');
            });
        });
    </script>

</body>

</html>
