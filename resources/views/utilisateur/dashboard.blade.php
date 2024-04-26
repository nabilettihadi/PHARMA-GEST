<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white h-screen w-64 fixed top-0 left-0 flex flex-col justify-between transition-all duration-300">
        <!-- Logo et nom de l'utilisateur -->
        <div class="p-4 border-b border-gray-700">
            <a href="/" class="text-2xl font-semibold text-gray-200">Pharma<span
                    class="text-blue-500">Care</span></a>
            <div class="mt-4">
                <p class="text-sm text-gray-400">Connecté en tant que:</p>
                <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
            </div>
        </div>
        <!-- Liens du sidebar -->
        <nav class="flex-1 py-4">
            <ul class="space-y-2">
                <li><a href="{{ route('utilisateur.dashboard') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-tasks mr-2"></i>Mes commandes</a></li>
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-chart-line mr-2"></i>Statistiques</a></li>
                <li><a href="{{ route('logout') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a></li>
            </ul>
        </nav>
        <!-- Pied de page du sidebar -->
        <footer class="p-4 border-t border-gray-700">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </footer>
    </aside>

    <!-- Contenu principal -->
    <main class="ml-0 md:ml-64 transition-all duration-300 ease-in-out">
        <!-- Barre de navigation -->
        <div class="container mx-auto px-4 py-4 md:flex md:justify-between md:items-center">
            <!-- Burger Menu -->
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none mr-4" id="burgerBtn">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            <h3 class="text-xl font-semibold mb-2 md:mb-0 text-center">Vos commandes</h3>
            <!-- Recherche -->
            <div class="flex space-x-4 md:ml-auto items-center mt-4 md:mt-0">
                <input type="text" class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none" placeholder="Rechercher...">
                <!-- Tri par colonnes -->
                <select class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none">
                    <option value="date">Date de commande</option>
                    <option value="montant">Montant</option>
                    <option value="statut">Statut</option>
                </select>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none flex items-center">
                    <i class="fas fa-search mr-2"></i>Rechercher
                </button>
            </div>
        </div>

        <!-- Contenu des commandes avec pagination -->
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white shadow-md rounded-lg p-8">

                <!-- Grid Layout pour les commandes -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Cartes de commande -->
                    @foreach($commandes as $commande)
                    <div class="bg-gray-100 shadow-md rounded-lg p-4">
                        <div class="text-lg font-semibold mb-2">Commande #{{ $commande->id }}</div>
                        <div class="text-sm text-gray-600 mb-2">Date de commande: {{ $commande->created_at->format('d/m/Y') }}</div>
                        <div class="text-sm text-gray-600 mb-2">Montant: {{ $commande->montant }}</div>
                        <div>
                            @if ($commande->statut == 'en_attente')
                            <span class="bg-yellow-200 text-yellow-800 py-1 px-2 rounded-full">En attente</span>
                            @elseif ($commande->statut == 'en_cours')
                            <span class="bg-blue-200 text-blue-800 py-1 px-2 rounded-full">En cours</span>
                            @elseif ($commande->statut == 'livree')
                            <span class="bg-green-200 text-green-800 py-1 px-2 rounded-full">Livré</span>
                            @else
                            <span class="bg-gray-200 text-gray-800 py-1 px-2 rounded-full">Indéfini</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center items-center mt-4 space-x-4">
                    <button class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 focus:outline-none">Précédent</button>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">1</button>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">2</button>
                    <button class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 focus:outline-none">Suivant</button>
                </div>

                @if ($commandes->isEmpty())
                <div class="mt-8">
                    <p class="text-lg text-center">Vous n'avez aucune commande.</p>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Scripts pour gérer le menu burger -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const burgerBtn = document.getElementById('burgerBtn');

            burgerBtn.addEventListener('click', () => {
                const sidebar = document.querySelector('aside');
                sidebar.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>


