<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-blue-400 to-white min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-8">Détails du Produit</h1>
        <p><strong>Nom:</strong> {{ $produit->nom }}</p>
        <p><strong>Description:</strong> {{ $produit->description }}</p>
        <p><strong>Prix:</strong> {{ $produit->prix }}</p>
        <p><strong>Quantité:</strong> {{ $produit->quantite }}</p>
        <p><strong>Photo:</strong></p>
        @if ($produit->photo)
        <img src="{{ asset('storage/app/produits/' . $produit->photo) }}" alt="{{ $produit->nom }}" width="300">
        @else
        Pas de photo disponible
        @endif
    </div>
</body>

</html>
