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

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Barre de navigation -->
    <nav class="navbar py-4 bg-white shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none mr-4" id="burgerBtn">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <a href="#" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </a>
            </div>
            <ul class="hidden md:flex space-x-4 items-center">
                @Auth
                <li><a href="{{ route('pharmacien.dashboard') }}" class="text-gray-600 hover:text-gray-800">Dashboard</a></li>
                @endAuth
                <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
            </ul>
            <ul class="hidden md:flex space-x-4 items-center">
                @guest
                    <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800"><i
                                class="fas fa-user-plus mr-1"></i>Inscription</a></li>
                    <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800"><i
                                class="fas fa-user-plus mr-1"></i>Connexion</a></li>
                @endguest
                <li>
                    <a href="#" id="cart-dropdown-btn"
                        class="flex items-center justify-center rounded-md bg-blue-500 px-4 py-2 text-white font-semibold hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        @auth
                        <span class="cart-items">{{ auth()->user()->commandes()->where('etat', 'En attente')->count() }}</span>
                        @endauth
                    </a>
                </li>
            </ul>
        </div>

        
        <ul class="md:hidden bg-white absolute top-0 left-0 right-0 mt-16 rounded-lg shadow-md py-4 px-6 space-y-4 text-center"
            style="display: none;" id="burgerMenu">
            @guest
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
                <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
            @endguest
            <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
            <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
            <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
        </ul>
    </nav>

    <!-- Scripts pour gérer le menu burger -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerBtn = document.getElementById('burgerBtn');
            const burgerMenu = document.getElementById('burgerMenu');

            burgerBtn.addEventListener('click', () => {
                burgerMenu.style.display = burgerMenu.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>
    <!-- Barre de recherche -->
    <div class="container mx-auto p-5 flex items-center justify-center">
        <div class="search-bar mb-8 flex items-center">
            <input type="text" id="searchInput" placeholder="Rechercher un produit..."
                class="px-4 py-2 border border-gray-300 rounded-md w-full md:w-auto">
            <button onclick="searchProducts()"
                class="px-6 py-2 bg-blue-500 text-white rounded-md ml-2">Rechercher</button>
        </div>
    </div>


    <!-- Liste des produits -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 product-list flex-grow mb-16">
    @foreach ($produits as $produit)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <a href="#!" class="block">
            <img class="w-full h-64 object-cover object-center" src="{{ asset('storage/' . $produit->photo) }}"
                alt="{{ $produit->nom }}">
        </a>
        <div class="p-6">
            <h5 class="text-lg font-semibold leading-tight mb-2">{{ $produit->nom }}</h5>
            <p class="text-sm text-gray-600 mb-4">{{ $produit->description }}</p>
            <div class="flex items-center justify-between">
                <span class="text-lg font-bold text-gray-900">${{ $produit->prix }}</span>
                @auth
                @if(auth()->user()->role === 'utilisateur')
                    <form action="{{ route('ajouter-au-panier', $produit->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white rounded-md hover:from-blue-700 hover:to-blue-900 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </button>
                    </form>
                @endif
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>


</div>


    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function searchProducts() {
            var input, filter, cards, cardContainer, title, i;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            cardContainer = document.querySelector(".product-list");
            cards = cardContainer.getElementsByClassName("bg-white");
            for (i = 0; i < cards.length; i++) {
                title = cards[i].querySelector("h5");
                if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                    cards[i].style.display = "block";
                } else {
                    cards[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>


