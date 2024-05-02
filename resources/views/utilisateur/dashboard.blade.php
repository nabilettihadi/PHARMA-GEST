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
                <li><a href="{{ route('utilisateur.mescommandes') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-tasks mr-2"></i>Mes commandes</a></li>

                <li><a href="{{ route('utilisateur.statistiques') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
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

                <li><a href="{{ route('utilisateur.statistiques') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
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
    @if(Auth::user()->client)
    <!-- Profile de l'utilisateur -->
    <section class="bg-white p-6 mt-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-center">Votre Profil</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="card border-gray-200 rounded-lg p-4">
                <p class="text-lg font-semibold text-indigo-600">Nom:</p>
                <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
            </div>
            <div class="card border-gray-200 rounded-lg p-4">
                <p class="text-lg font-semibold text-indigo-600">Email:</p>
                <p class="text-lg font-semibold">{{ Auth::user()->email }}</p>
            </div>
            <div class="card border-gray-200 rounded-lg p-4">
                <p class="text-lg font-semibold text-indigo-600">Adresse:</p>
                <p class="text-lg font-semibold">{{ Auth::user()->client->adresse }}</p>
            </div>
            <div class="card border-gray-200 rounded-lg p-4">
                <p class="text-lg font-semibold text-indigo-600">Téléphone:</p>
                <p class="text-lg font-semibold">{{ Auth::user()->client->telephone }}</p>
            </div>
        </div>
    </section>
    @else
    <!-- Formulaire pour compléter le profil -->
    <section class="bg-white p-6 mt-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-center">Compléter votre profil</h2>
        <form action="{{ route('utilisateur.completerprofil') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="adresse" class="block text-lg font-medium text-gray-700 mb-2">Adresse</label>
                <input type="text" id="adresse" name="adresse" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-lg" required>
            </div>
            <div class="mb-6">
                <label for="telephone" class="block text-lg font-medium text-gray-700 mb-2">Téléphone</label>
                <input type="text" id="telephone" name="telephone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-lg" required>
            </div>
            <button type="submit" class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-lg text-white font-semibold rounded-md shadow-md">Enregistrer</button>
        </form>
    </section>
    @endif
</main>

</body>

</html>
