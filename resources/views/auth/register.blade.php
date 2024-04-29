<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
                <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
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
                        <li class="flex items-center justify-between mb-4 border-b pb-3">
                            <!-- Image de la commande -->
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $commande->produit->photo) }}"
                                    alt="{{ $commande->produit->nom }}" class="w-16 h-16 object-cover rounded-full mr-4">
                                <!-- Détails de la commande -->
                                <div>
                                    <p class="font-semibold">{{ $commande->produit->nom }}</p>
                                    <p class="text-sm text-gray-600">Quantité: {{ $commande->quantite }}</p>
                                </div>
                            </div>
                            <!-- Total et état de la commande -->
                            <div class="flex flex-col justify-between">
                                <div class="text-gray-600">
                                    <span>Total: ${{ $commande->total }}</span>
                                </div>
                                <div>
                                    <span class="text-green-600 font-semibold">État: {{ $commande->etat }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endauth
            </ul>
        </div>
    </nav>
    <div id="app" class="min-h-screen flex justify-center items-center bg-cover bg-center"
        style="background-image: url('https://source.unsplash.com/1600x900/?pharmacy')">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-8">
                    <h1 class="text-3xl font-bold text-blue-600 mb-4 text-center">Inscription</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-6">
                            <label for="role" class="block text-sm text-gray-600">Je suis :</label>
                            <div class="flex items-center mt-2">
                                <!-- Bouton radio pour Pharmacien -->
                                <input type="radio" id="role_pharmacien" name="role" value="pharmacien" required
                                    class="mr-2 focus:ring-blue-500 h-4 w-4 border border-gray-300 rounded-full checked:bg-blue-600 checked:border-transparent">
                                <label for="role_pharmacien" class="text-sm text-gray-800">Pharmacien</label>
                        
                                <!-- Bouton radio pour Utilisateur -->
                                <input type="radio" id="role_utilisateur" name="role" value="utilisateur" required
                                    class="ml-6 mr-2 focus:ring-blue-500 h-4 w-4 border border-gray-300 rounded-full checked:bg-blue-600 checked:border-transparent">
                                <label for="role_utilisateur" class="text-sm text-gray-800">Utilisateur</label>
                            </div>
                        </div>
                        
                        

                        <!-- Name Input -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm text-gray-600">Nom :</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                autofocus placeholder="Entrez votre nom"
                                class="input-field appearance-none border border-gray-300 rounded-md py-2 px-4 w-full focus:outline-none focus:border-blue-500">
                        </div>

                        <!-- Email Input -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm text-gray-600">Adresse Email :</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                placeholder="Entrez votre adresse email"
                                class="input-field appearance-none border border-gray-300 rounded-md py-2 px-4 w-full focus:outline-none focus:border-blue-500">
                        </div>

                        <!-- Password Input -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm text-gray-600">Mot de passe :</label>
                            <input id="password" type="password" name="password" required
                                placeholder="Entrez votre mot de passe"
                                class="input-field appearance-none border border-gray-300 rounded-md py-2 px-4 w-full focus:outline-none focus:border-blue-500">
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm text-gray-600">Confirmer le mot de
                                passe :</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                placeholder="Confirmez votre mot de passe"
                                class="input-field appearance-none border border-gray-300 rounded-md py-2 px-4 w-full focus:outline-none focus:border-blue-500">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn-primary w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition duration-300">S'inscrire</button>
                    </form>

                    <!-- Login Link -->
                    <div class="text-center mt-4">
                        <span class="text-sm text-gray-600">Vous avez déjà un compte ?</span>
                        <a href="{{ route('login') }}"
                            class="text-blue-600 hover:text-blue-800 ml-1">Connectez-vous</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
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
