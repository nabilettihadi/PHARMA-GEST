<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Produits</title>
    <!-- Lien vers Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Barre de navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-center mb-8">Statistiques des Produits</h1>

            <!-- Statistiques par quantité vendue -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Statistiques par quantité vendue</h2>
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Nom du Produit</th>
                            <th class="px-4 py-2">Quantité Totale Vendue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statistiquesQuantite as $statistique)
                        <tr>
                            <td class="border px-4 py-2">{{ $statistique->nom }}</td>
                            <td class="border px-4 py-2">{{ $statistique->quantite_totale }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Statistiques par montant total des ventes -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Statistiques par montant total des ventes</h2>
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Nom du Produit</th>
                            <th class="px-4 py-2">Montant Total des Ventes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statistiquesMontant as $statistique)
                        <tr>
                            <td class="border px-4 py-2">{{ $statistique->nom }}</td>
                            <td class="border px-4 py-2">{{ $statistique->montant_total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

</body>

</html>
