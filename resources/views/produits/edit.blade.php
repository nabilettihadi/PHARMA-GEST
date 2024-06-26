<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de Produit</title>
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
    <!-- Contenu principal -->
    <main class="container mx-auto pt-24 md:pt-0 px-4 py-12">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-8">Modifier le Produit</h1>
            <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="photo" class="block text-sm font-bold mb-2">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-input w-full">
                    @if ($produit->photo_url)
                        <div class="mt-2">
                            <label class="block text-sm font-medium">Photo actuelle :</label>
                            <img src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}"
                                class="mt-2 h-20 object-cover rounded-lg shadow-md">
                        </div>
                    @else
                        <p>Aucune photo disponible.</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-bold mb-2">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-input w-full"
                        value="{{ $produit->nom }}" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-bold mb-2">Description</label>
                    <textarea name="description" id="description" class="form-textarea w-full" required>{{ $produit->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="prix" class="block text-sm font-bold mb-2">Prix</label>
                    <input type="number" name="prix" id="prix" class="form-input w-full"
                        value="{{ $produit->prix }}" required>
                </div>
                <div class="mb-4">
                    <label for="quantite" class="block text-sm font-bold mb-2">Quantité</label>
                    <input type="number" name="quantite" id="quantite" class="form-input w-full"
                        value="{{ $produit->quantite }}" required>
                </div>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Modifier</button>
            </form>
        </div>
    </main>

</body>

</html>
