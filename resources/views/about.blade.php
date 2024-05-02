<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos</title>
    <!-- Lien vers Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">

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

        <!-- Dropdown des commandes -->
        <div class="relative">
            <ul class="absolute right-0 w-70 bg-white border border-gray-200 shadow-md rounded-lg mt-2 py-4 hidden "
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
    <header class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-24 px-8">
        <div class="container mx-auto flex flex-col items-center justify-center h-full">
            <h1 class="text-5xl font-bold mb-4 text-center">À propos de PharmaCare</h1>
            <p class="text-lg mb-8 max-w-3xl text-center">Découvrez qui nous sommes et ce que nous faisons pour
                améliorer votre santé.</p>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Section Services -->
            <div id="equipe"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex flex-col items-center cursor-pointer">
                <i class="fas fa-user-md text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2 text-center">Notre Équipe</h2>
                <p class="text-gray-600 text-center">Rencontrez nos professionnels dévoués qui travaillent pour votre
                    bien-être.</p>
            </div>
            <div id="equipe-info"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex flex-col items-center hidden">
                <h3 class="text-xl font-semibold mb-2 text-center">Nos Experts</h3>
                <img src="{{ asset('storage/photos/equipe.jpeg') }}" alt="Équipe PharmaCare"
                    class="mb-4 rounded-lg shadow-md">
                <p class="text-gray-600 text-center">Notre équipe est composée de professionnels expérimentés dans le
                    domaine de la santé.</p>
            </div>

            <!-- Section Produits -->
            <div id="mission"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex flex-col items-center cursor-pointer">
                <i class="fas fa-pills text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2 text-center">Notre Mission</h2>
                <p class="text-gray-600 text-center">Nous nous engageons à fournir des produits de qualité pour votre
                    santé et votre bien-être.</p>
            </div>
            <div id="mission-info"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex flex-col items-center hidden">
                <h3 class="text-xl font-semibold mb-2 text-center">Nos Produits</h3>
                <img src="{{ asset('storage/photos/produits.jpg') }}" alt="Produits PharmaCare"
                    class="mb-4 rounded-lg shadow-md">
                <p class="text-gray-600 text-center">Nos produits sont conçus pour répondre aux besoins de nos clients
                    en matière de santé.</p>
            </div>

            <!-- Section Conseils -->
            <div id="valeurs"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex flex-col items-center cursor-pointer">
                <i class="fas fa-stethoscope text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2 text-center">Nos Valeurs</h2>
                <p class="text-gray-600 text-center">Nos valeurs fondamentales sont l'engagement envers nos clients, la
                    qualité de nos produits et l'innovation continue.</p>
            </div>
            <div id="valeurs-info"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex flex-col items-center hidden">
                <h3 class="text-xl font-semibold mb-2 text-center">Nos Engagements</h3>
                <img src="{{ asset('storage/photos/engagement.jpg') }}" alt="Engagement PharmaCare"
                    class="mb-4 rounded-lg shadow-md">
                <p class="text-gray-600 text-center">Nous nous engageons à offrir des solutions novatrices pour la
                    santé et le bien-être de nos clients.</p>
            </div>
        </div>
    </main>

    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const equipe = document.getElementById('equipe');
            const equipeInfo = document.getElementById('equipe-info');
            equipe.addEventListener('click', () => {
                equipeInfo.classList.toggle('hidden');
            });

            const mission = document.getElementById('mission');
            const missionInfo = document.getElementById('mission-info');
            mission.addEventListener('click', () => {
                missionInfo.classList.toggle('hidden');
            });

            const valeurs = document.getElementById('valeurs');
            const valeursInfo = document.getElementById('valeurs-info');
            valeurs.addEventListener('click', () => {
                valeursInfo.classList.toggle('hidden');
            });

        });
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
