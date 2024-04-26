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
    <aside class="bg-gray-800 text-white h-screen w-64 fixed top-0 left-0 flex flex-col justify-between">
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
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-tasks mr-2"></i>Gestion des commandes</a></li>
                <li><a href="{{ route('produits.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-cube mr-2"></i>Gestion des produits</a></li>
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-chart-line mr-2"></i>Statistiques</a></li>
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-cogs mr-2"></i>Paramètres</a></li>
                <li><a href="/logout" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a></li>
            </ul>
        </nav>
        <!-- Pied de page du sidebar -->
        <footer class="p-4 border-t border-gray-700">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </footer>
    </aside>

    <!-- Contenu principal -->
    <main class="ml-64 p-8">
        <!-- Barre de navigation -->

        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Burger Menu -->
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none mr-4" id="burgerBtn">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

        </div>


        <!-- Scripts pour gérer le menu burger -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const burgerBtn = document.getElementById('burgerBtn');

                burgerBtn.addEventListener('click', () => {
                    const sidebar = document.querySelector('aside');
                    sidebar.classList.toggle('hidden');
                });
            });
        </script>

    </main>

</body>

</html>

