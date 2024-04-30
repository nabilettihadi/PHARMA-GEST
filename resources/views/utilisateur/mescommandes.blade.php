<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Mes commandes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        @media (min-width: 768px) {


            .burger-dropdown {
                display: none;
            }

            .sidebar {
                display: block !important;
            }
        }

        @media (max-width: 767px) {
            .burger-dropdown {
                display: none;
            }

            .sidebar {
                display: none;
            }

            .burger-dropdown.active {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Burger Menu -->
    <div class="burger-menu md:hidden fixed top-0 left-0 w-full z-50 bg-gray-800 text-white">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-200">Pharma<span
                    class="text-blue-500">Care</span></a>
            <button class="text-gray-200 focus:outline-none" id="burgerBtn">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        <!-- Dropdown pour le burger menu -->
        <div class="burger-dropdown bg-gray-800 text-white py-2 px-4">
            <ul class="space-y-2">
                <li><a href="{{ route('utilisateur.dashboard') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-tasks mr-2"></i>Mes commandes</a></li>

                <li><a href="statistiques" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-chart-line mr-2"></i>Statistiques</a></li>

                <li><a href="{{ route('logout') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a></li>
            </ul>
        </div>
    </div>

    <!-- Sidebar -->
    <aside
        class="sidebar bg-gray-800 text-white h-screen w-64 fixed top-0 left-0 flex flex-col justify-between hidden md:block">
        <div class="p-4 border-b border-gray-700">
            <a href="/" class="text-2xl font-semibold text-gray-200">Pharma<span
                    class="text-blue-500">Care</span></a>
            <div class="mt-4">
                <p class="text-sm text-gray-400">Connecté en tant que:</p>
                <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
            </div>
        </div>
        <nav class="flex-1 py-4">
            <ul class="space-y-2">
                <li><a href="{{ route('utilisateur.dashboard') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>
                <li><a href="{{ route('utilisateur.mescommandes') }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-tasks mr-2"></i>Mes
                        commandes</a></li>

                <li><a href="statistiques" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-chart-line mr-2"></i>Statistiques</a></li>

                <li><a href="{{ route('logout') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a></li>
            </ul>
        </nav>
        <footer class="p-4 border-t border-gray-700">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </footer>
    </aside>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerBtn = document.getElementById('burgerBtn');
            const sidebar = document.querySelector('.sidebar');
            const burgerDropdown = document.querySelector('.burger-dropdown');

            burgerBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                burgerDropdown.classList.toggle('active');
            });
        });
    </script>


    <!-- Barre de navigation -->
    <div class="container mx-auto px-4 py-4 md:flex md:justify-between md:items-center">

        <h3 class="text-xl font-semibold mb-2 md:mb-0 text-center">Vos commandes</h3>
        <!-- Recherche -->
        <div class="flex space-x-4 md:ml-auto items-center mt-4 md:mt-0">
            <input type="text" class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none"
                placeholder="Rechercher...">
            <button
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none flex items-center">
                <i class="fas fa-search mr-2"></i>Rechercher
            </button>
        </div>
    </div>



    <!-- Liste des commandes -->
    <ul>
        @foreach ($commandes as $commande)
            <li class="flex items-center justify-between mb-4 border-b pb-3">
                <!-- Image de la commande -->
                <div class="flex items-center">
                    <img src="{{ asset('storage/' . $commande->produit->photo) }}" alt="{{ $commande->produit->nom }}"
                        class="w-16 h-16 object-cover rounded-full mr-4">
                    <!-- Détails de la commande -->
                    <div>
                        <p class="font-semibold">{{ $commande->produit->nom }}</p>
                        <p class="text-sm text-gray-600">Quantité: {{ $commande->quantite }}</p>
                    </div>
                </div>
                <!-- Actions sur la commande -->
                <div class="flex items-center space-x-4">
                    <!-- Lien de modification -->
                    <a href="{{ route('commandes.edit', $commande->id) }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <!-- Lien de suppression -->
                    <a href="{{ route('commandes.destroy', $commande->id) }}" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>


</body>

</html>
