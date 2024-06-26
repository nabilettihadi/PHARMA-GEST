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
        .chart-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .chart-container canvas {
            width: 100%;
        }

        @media (min-width: 768px) {
            .chart-container {
                flex-direction: row;
            }

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
                <li><a href="{{ route('administrateur.dashboard') }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>

                <li><a href="{{ route('pharmacien.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-user-md mr-2"></i>Gestion des Pharmaciens</a></li>

                <li><a href="{{ route('client.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-user-friends mr-2"></i>Gestion des Clients</a></li>
                <li><a href="{{ route('admin.contacts') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-envelope-open-text mr-2"></i>Contacts</a></li>

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
                <li><a href="{{ route('administrateur.dashboard') }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-tachometer-alt mr-2"></i>Tableau de bord</a></li>

                <li><a href="{{ route('pharmacien.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-user-md mr-2"></i>Gestion des pharmaciens</a></li>
                <li><a href="{{ route('client.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-user-friends mr-2"></i>Gestion des clients</a></li>
                <li><a href="{{ route('admin.contacts') }}" class="block py-2 px-4 text-sm hover:bg-gray-700"><i
                            class="fas fa-envelope-open-text mr-2"></i>Contacts</a></li>

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
<div class="container mx-auto px-4 py-4 ml-64">
    <h1 class="text-2xl font-semibold mb-4">Liste des pharmaciens</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($pharmaciens as $pharmacien)
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-lg font-semibold">{{ $pharmacien->name }}</h2>
            <p class="text-gray-600">{{ $pharmacien->email }}</p>
            
            <form action="{{ route('pharmaciens.destroy', $pharmacien->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                    Supprimer
                </button>
            </form>
        </div>
        @endforeach
    </div>
</div>


</body>

</html>