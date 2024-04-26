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
    <nav class="navbar py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>
            <!-- Burger Menu et Panier (version mobile) -->
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none mr-4" id="burgerBtn">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <a href="#" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </a>
            </div>
            <!-- Menu centré (version desktop) -->
            <ul class="hidden md:flex space-x-4 items-center flex-grow justify-center">
                <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
            </ul>
            <!-- Liens à droite (version desktop) -->
            <ul class="hidden md:flex space-x-4 items-center">
                <!-- Inscription avec icône -->
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800"><i
                            class="fas fa-user-plus mr-1"></i>Inscription</a></li>
                <!-- Panier -->
                <li>
                    <a href="#"
                        class="flex items-center justify-center rounded-md bg-blue-500 px-4 py-2 text-white font-semibold hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        <span class="cart-items">3</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Menu burger (version mobile) -->
        <ul class="md:hidden bg-white absolute top-0 left-0 right-0 mt-16 rounded-lg shadow-md py-4 px-6 space-y-4 text-center"
            style="display: none;" id="burgerMenu">
            <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
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
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="Adresse Email"
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
        <div class="text-center mt-4">
            <a href="#" class="text-gray-600 hover:text-blue-600">Mot de passe oublié ?</a>
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

</body>

</html>



