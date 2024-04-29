<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Mes commandes</title>
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
                <p class="text-lg font-semibold">{{ Auth::user()->name }}</p> <!-- Nom de l'utilisateur -->
            </div>
        </div>
        <!-- Liens du sidebar -->
        <nav class="flex-1 py-4">
            <ul class="space-y-2">
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700 bg-gray-700"><i class="fas fa-tasks mr-2"></i>Mes commandes</a></li> <!-- Lien actif pour la page des commandes -->
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-chart-line mr-2"></i>Statistiques</a></li>
                <li><a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700"><i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a></li>
            </ul>
        </nav>
        <!-- Pied de page du sidebar -->
        <footer class="p-4 border-t border-gray-700">
            <p class="text-sm text-gray-400">&copy; 2024 PharmaCare. Tous droits réservés.</p>
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
                <input type="text" class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none"
                    placeholder="Rechercher...">
                <button
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none flex items-center">
                    <i class="fas fa-search mr-2"></i>Rechercher
                </button>
            </div>
        </div>

        <!-- Contenu des commandes avec pagination -->
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white shadow-md rounded-lg p-8">

                <!-- Liste des commandes -->
<ul>
    @foreach($commandes as $commande)
    <li class="flex items-center justify-between mb-4 border-b pb-3">
        <!-- Image de la commande -->
        <div class="flex items-center">
            <img src="{{ asset('storage/' . $commande->produit->photo) }}"
                alt="{{ $commande->produit->nom }}"
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
