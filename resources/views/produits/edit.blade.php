<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Produit</title>
    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-blue-400 to-white min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-8">Modifier le Produit</h1>
        <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nom" class="block text-sm font-bold mb-2">Nom</label>
                <input type="text" name="nom" id="nom" class="form-input w-full" value="{{ $produit->nom }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" class="form-textarea w-full" required>{{ $produit->description }}</textarea>
            </div>
            <div class="mb-4">
                <label for="prix" class="block text-sm font-bold mb-2">Prix</label>
                <input type="number" name="prix" id="prix" class="form-input w-full" value="{{ $produit->prix }}" required>
            </div>
            <div class="mb-4">
                <label for="quantite" class="block text-sm font-bold mb-2">Quantité</label>
                <input type="number" name="quantite" id="quantite" class="form-input w-full" value="{{ $produit->quantite }}" required>
            </div>
            <div class="mb-4">
                <label for="photo" class="block text-sm font-bold mb-2">Photo</label>
                <input type="file" name="photo" id="photo" class="form-input w-full">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier</button>
        </form>
    </div>
</body>

</html>

