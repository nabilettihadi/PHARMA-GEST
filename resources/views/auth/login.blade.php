<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
            @endguest
            <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
            <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
            <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
        </ul>

        <!-- Dropdown des commandes -->
        <div class="relative">
            <ul class="absolute right-0 w-80 bg-white border border-gray-200 shadow-md rounded-lg mt-2 py-4 hidden"
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

    <!-- Formulaire de connexion -->
    <div class="min-h-screen flex justify-center items-center bg-cover bg-center"
        style="background-image: url('https://source.unsplash.com/1600x900/?pharmacy')">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 py-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">Connexion</h1>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Adresse Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus placeholder="Adresse Email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
                        <input id="password" type="password" name="password" required placeholder="Mot de passe"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">Se
                        connecter</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

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
