<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <div class="chart-container">
                <div id="quantiteVendueContainer">
                    <h2 class="text-xl font-semibold mb-4">Statistiques par quantité vendue</h2>
                    <canvas id="quantiteVendueChart" width="400" height="200"></canvas>
                    <p class="text-center text-sm mt-2">Quantité vendue par produit</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <div class="chart-container">
                <div id="montantVentesContainer">
                    <h2 class="text-xl font-semibold mb-4">Statistiques par montant total des ventes</h2>
                    <canvas id="montantVentesChart" width="400" height="200"></canvas>
                    <p class="text-center text-sm mt-2">Montant total des ventes par produit</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Données pour le graphique par quantité vendue
        const labelsQuantite = [
            @foreach ($statistiquesQuantite as $statistique)
                '{{ $statistique->nom }}',
            @endforeach
        ];
        const dataQuantite = [
            @foreach ($statistiquesQuantite as $statistique)
                {{ $statistique->quantite_totale }},
            @endforeach
        ];

        // Données pour le graphique par montant total des ventes
        const labelsMontant = [
            @foreach ($statistiquesMontant as $statistique)
                '{{ $statistique->nom }}',
            @endforeach
        ];
        const dataMontant = [
            @foreach ($statistiquesMontant as $statistique)
                {{ $statistique->montant_total }},
            @endforeach
        ];

        // Création des graphiques
        const ctxQuantite = document.getElementById('quantiteVendueChart').getContext('2d');
        const ctxMontant = document.getElementById('montantVentesChart').getContext('2d');

        const quantiteVendueChart = new Chart(ctxQuantite, {
            type: 'bar',
            data: {
                labels: labelsQuantite,
                datasets: [{
                    label: 'Quantité Vendue',
                    data: dataQuantite,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const montantVentesChart = new Chart(ctxMontant, {
            type: 'bar',
            data: {
                labels: labelsMontant,
                datasets: [{
                    label: 'Montant Total des Ventes',
                    data: dataMontant,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
