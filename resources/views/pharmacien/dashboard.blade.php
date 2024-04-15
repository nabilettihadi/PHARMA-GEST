<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord pharmacien</title>
    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-blue-400 to-white min-h-screen">
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-blue-900">Bienvenue sur votre Tableau de bord, Pharmacien!</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4 text-blue-900">Gérer les Produits</h2>
                <p class="text-gray-700">Accédez à la liste des produits de votre pharmacie et gérez-les facilement.</p>
                <a href="{{ route('produits.index') }}" class="mt-4 block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md text-center">Voir les Produits</a>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4 text-blue-900">Statistiques</h2>
                <p class="text-gray-700">Consultez les statistiques de vente, les stocks, etc.</p>
                <a href="#" class="mt-4 block bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md text-center">Voir les Statistiques</a>
            </div>
        </div>
    </div>
</body>

</html>


