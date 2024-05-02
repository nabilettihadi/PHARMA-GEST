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
                <li><a href="{{ route('utilisateur.mescommandes') }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-tasks mr-2"></i>Mes
                        commandes</a></li>

                <li><a href="{{ route('utilisateur.statistiques') }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-700"><i
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

                <li><a href="{{ route('utilisateur.statistiques') }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-700"><i
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


    <main class="ml-0 md:ml-64 transition-all duration-300 ease-in-out pt-24 md:pt-0">
        <div class="container mx-auto px-4 py-4">
            <h1 class="text-3xl font-semibold mb-4 text-center">Statistiques des commandes</h1>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <i class="fas fa-check-circle text-green-500 text-4xl mb-4"></i>
                    <h2 class="text-xl font-semibold mb-2">Nombre de commandes confirmées</h2>
                    <p class="text-lg">{{ $nombreCommandesConfirmees }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <i class="fas fa-clock text-yellow-500 text-4xl mb-4"></i>
                    <h2 class="text-xl font-semibold mb-2">Nombre de commandes en attente</h2>
                    <p class="text-lg">{{ $nombreCommandesEnAttente }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <i class="fas fa-dollar-sign text-blue-500 text-4xl mb-4"></i>
                    <h2 class="text-xl font-semibold mb-2">Commande la plus chère</h2>
                    <p class="text-lg">{{ $commandePlusChere ? $commandePlusChere->total : 'N/A' }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <i class="fas fa-coins text-purple-500 text-4xl mb-4"></i>
                    <h2 class="text-xl font-semibold mb-2">Commande la moins chère</h2>
                    <p class="text-lg">{{ $commandeMoinsChere ? $commandeMoinsChere->total : 'N/A' }}</p>
                </div>
            </div>
        </div>
    </main>



</body>

</html>
