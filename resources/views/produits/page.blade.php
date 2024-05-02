<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Accueil</title>

    <!-- External CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Barre de navigation -->
    <nav class="navbar py-4 bg-white shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>


            <ul class="hidden md:flex space-x-4 items-center">
                <!-- Authentification -->
                @auth
                    <li><a href="{{ route('pharmacien.dashboard') }}"
                            class="text-gray-600 hover:text-gray-800">Dashboard</a></li>
                @endauth
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
            <ul class="absolute right-0 w-150 bg-white border border-gray-200 shadow-md rounded-lg mt-2 py-4 hidden mr-2"
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

    <!-- Barre de recherche -->
    <div class="container mx-auto p-5 flex items-center justify-center">
        <div class="search-bar mb-8 flex items-center">
            <!-- Input de recherche -->
            <input type="text" id="searchInput" placeholder="Rechercher un produit..."
                class="px-4 py-2 border border-gray-300 rounded-md w-full md:w-auto">
            <!-- Bouton de recherche -->
            <button onclick="searchProducts()"
                class="px-6 py-2 bg-blue-500 text-white rounded-md ml-2">Rechercher</button>
        </div>
    </div>

    <!-- Liste des produits -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 product-list flex-grow mb-16">
        @foreach ($produits as $produit)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <a href="#!" class="block">
                    <img class="w-full h-64 object-cover object-center"
                        src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}">
                </a>
                <div class="p-6">
                    <h5 class="text-lg font-semibold leading-tight mb-2">{{ $produit->nom }}</h5>
                    <p class="text-sm text-gray-600 mb-4">{{ $produit->description }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-900">${{ $produit->prix }}</span>
                        <!-- Bouton d'ajout au panier -->
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
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagination">
            {{ $produits->links() }}
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var searchText = $(this).val();
                $.ajax({
                    url: '{{ route('produits.search') }}',
                    type: 'GET',
                    data: {
                        query: searchText
                    },
                    success: function(response) {
                        var produits = response.produits;
                        var html = '';

                        if (produits.length === 0) {
                            html =
                                '<p class="text-center">Le produit recherché n\'existe pas.</p>';

                        } else {
                            produits.forEach(function(produit) {
                                html +=
                                    '<div class="bg-white rounded-lg shadow-md overflow-hidden">';
                                html += '<a href="#!" class="block">';
                                html +=
                                    '<img class="w-full h-64 object-cover object-center" src="{{ asset('storage/') }}/' +
                                    produit.photo + '" alt="' + produit.nom + '">';
                                html += '</a>';
                                html += '<div class="p-6">';
                                html +=
                                    '<h5 class="text-lg font-semibold leading-tight mb-2">' +
                                    produit.nom + '</h5>';
                                html += '<p class="text-sm text-gray-600 mb-4">' +
                                    produit.description + '</p>';
                                html +=
                                    '<div class="flex items-center justify-between">';
                                html +=
                                    '<span class="text-lg font-bold text-gray-900">$' +
                                    produit.prix + '</span>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                            });
                        }

                        $('.product-list').html(html);
                    }
                });
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
