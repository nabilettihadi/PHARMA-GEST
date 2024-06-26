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
                <li><a href="{{ route('pharmacien.dashboard') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>

                <li><a href="{{ route('produits.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-cube mr-2"></i>Gestion des produits</a></li>
                <li><a href="{{ route('statistiques.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-chart-line mr-2"></i>Statistiques</a></li>

                <li><a href="{{ route('logout') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a></li>
            </ul>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar bg-gray-800 text-white h-screen w-64 fixed top-0 left-0 flex flex-col justify-between hidden md:block">
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
                <li><a href="{{ route('pharmacien.dashboard') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>
                            
                <li><a href="{{ route('produits.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-cube mr-2"></i>Gestion des produits</a></li>
                <li><a href="{{ route('statistiques.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-chart-line mr-2"></i>Statistiques</a></li>

                <li><a href="{{ route('logout') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a></li>
            </ul>
        </nav>
        <footer class="p-4 border-t border-gray-700">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </footer>
    </aside>


   <!-- Contenu principal -->
   <main class="container mx-auto pt-24 md:pt-6 px-4 py-12 pl-0 md:pl-72">
    <div class="w-full bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-8">Liste des Produits</h1>
        <a href="{{ route('produits.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg mb-4 inline-block">Ajouter un
            Produit</a>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <!-- Table headers -->
                <thead>
                    <!-- Table row -->
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Prix</th>
                        <th class="px-4 py-2">Quantité</th>
                        <th class="px-4 py-2">Photo</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through your products -->
                    @foreach ($produits as $produit)
                    <!-- Table row for each product -->
                    <tr>
                        <td class="border px-4 py-2">{{ $produit->id }}</td>
                        <td class="border px-4 py-2">{{ $produit->nom }}</td>
                        <td class="border px-4 py-2">{{ $produit->description }}</td>
                        <td class="border px-4 py-2">{{ $produit->prix }}</td>
                        <td class="border px-4 py-2">{{ $produit->quantite }}</td>
                        <td class="border px-4 py-2">
                            <!-- Display product photo or placeholder -->
                            @if ($produit->photo)
                            <img src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}"
                                class="h-10">
                            @else
                            Pas de photo
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <!-- Product actions -->
                            <a href="{{ route('produits.show', $produit->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-lg mr-2">Voir</a>
                            <a href="{{ route('produits.edit', $produit->id) }}"
                                class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-lg mr-2">Modifier</a>
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-lg"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Script for burger menu functionality -->
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

</body>

</html>
</body>

</html>
