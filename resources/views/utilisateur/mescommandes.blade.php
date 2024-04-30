<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Tableau de bord</title>
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

    <body class="bg-gray-100">


        <div class="flex items-center justify-center mt-4 space-x-4">
            <input type="text" class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none" placeholder="Rechercher...">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none flex items-center">
                <i class="fas fa-search mr-2"></i>Rechercher
            </button>
        </div>

        <main class="ml-0 md:ml-64 transition-all duration-300 ease-in-out">

            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse ($commandes as $commande)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="bg-blue-100 px-4 py-2">
                                <div class="flex justify-between items-center">
                                    <div class="text-lg font-semibold">Commande {{ $commande->id }}</div>
                                    <div class="text-sm text-gray-600"> {{ $commande->created_at->format('d/m/Y') }}</div>
                                </div>
                                <div class="text-sm text-gray-600">Montant: {{ $commande->total }}</div>
                                <div class="mt-2">
                                    <span class="text-sm font-semibold">État:</span>
                                    <span class=" text-black py-1 px-2 rounded-full">{{ $commande->etat }}</span>
                                </div>
                            </div>
                            <div class="px-4 py-2">
                                <h4 class="text-lg font-semibold mb-2">Produits:</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                        <div class="bg-gray-100 shadow-md rounded-lg p-4">
                                            <a href="#!" class="block">
                                                <img class="w-full h-48 object-cover object-center" src="{{ asset('storage/' . $commande->produits->photo) }}" alt="{{ $commande->produits->nom }}">
                                            </a>
                                            <div class="p-6">
                                                <h5 class="text-lg font-semibold leading-tight mb-2">{{ $commande->produits->nom }}</h5>
                                                <p class="text-sm text-gray-600 mb-4">{{ $commande->produits->description }}</p>

                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-lg text-center">Vous n'avez aucune commande.</div>
                    @endforelse
                </div>
            </div>
        </main>
        

    </body>

</html>
