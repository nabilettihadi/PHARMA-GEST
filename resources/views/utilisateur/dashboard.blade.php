<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord pharmacien</title>
    <!-- Lien vers Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Lien vers Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Barre de navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span class="text-blue-500">Care</span></a>
            <ul class="flex space-x-4">
                <li><a href="#" class="text-gray-600 hover:text-gray-800">Accueil</a></li>

                <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-800">À propos</a></li>

                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-600 hover:text-gray-800">Déconnexion</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                {{-- <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li> --}}
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="text-xl font-semibold mb-4">Tableau de bord du client</div>

            <div class="mb-4">
                <p class="text-lg">Bienvenue sur votre tableau de bord, {{ Auth::user()->name }}!</p>
            </div>

            @if ($commandes->isNotEmpty())
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Vos commandes</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">ID Commande</th>
                                    <th class="border border-gray-300 px-4 py-2">Date de commande</th>
                                    <th class="border border-gray-300 px-4 py-2">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commandes as $commande)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $commande->id }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $commande->created_at }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $commande->montant }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="mb-8">
                    <p class="text-lg">Vous n'avez aucune commande.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

</body>

</html>


