<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: #333;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #1a202c;
        }

        .cart-icon {
            color: #333;
            transition: color 0.3s ease;
        }

        .cart-icon:hover {
            color: #1a202c;
        }

        .cart-items {
            background-color: #fff;
            border: 2px solid #333;
            color: #333;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .cart-items:hover {
            background-color: #1a202c;
            border-color: #1a202c;
            color: #fff;
        }

        .product-card {
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-description {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 8px;
            border-radius: 4px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .product-card:hover .product-description {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-100">

<!-- Barre de navigation -->
<nav class="navbar py-4">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span class="text-blue-500">Care</span></a>
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
            <!-- Connexion avec icône -->
            <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800"><i class="fas fa-sign-in-alt mr-1"></i>Connexion</a></li>
            <!-- Inscription avec icône -->
            <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800"><i class="fas fa-user-plus mr-1"></i>Inscription</a></li>
            <!-- Panier -->
            <li>
                <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-4 py-2 text-white font-semibold hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    <span class="cart-items">3</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Menu burger (version mobile) -->
    <ul class="md:hidden bg-white absolute top-0 left-0 right-0 mt-16 rounded-lg shadow-md py-4 px-6 space-y-4 text-center" style="display: none;" id="burgerMenu">
        <li><a href="{{ route('produits.index') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
        <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
        <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
    </ul>
</nav>

<!-- Scripts pour gérer le menu burger -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const burgerBtn = document.getElementById('burgerBtn');
        const burgerMenu = document.getElementById('burgerMenu');

        burgerBtn.addEventListener('click', () => {
            burgerMenu.style.display = burgerMenu.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-8">Ajouter un Produit</h1>
            <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required></textarea>
                </div>
                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                    <input type="number" name="prix" id="prix"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité</label>
                    <input type="number" name="quantite" id="quantite"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" id="photo"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
            </form>
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


