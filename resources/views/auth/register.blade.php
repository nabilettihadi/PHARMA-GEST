<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>
            <ul class="flex space-x-4">
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
            </ul>
        </div>
    </nav>

    <div id="app" class="min-h-screen flex justify-center items-center bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?pharmacy')">
        <div class="w-full max-w-sm">
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-lg p-8">
                <h1 class="text-2xl font-bold text-white mb-4">Inscription</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="role" class="text-white">Je suis :</label><br>
                        <input type="radio" id="role_pharmacien" name="role" value="pharmacien" required>
                        <label for="role_pharmacien" class="text-white">Pharmacien</label><br>
                        <input type="radio" id="role_utilisateur" name="role" value="utilisateur" required>
                        <label for="role_utilisateur" class="text-white">Utilisateur</label><br>
                    </div>
                    
                    <div class="mb-4">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Nom" class="bg-gray-100 w-full py-2 px-4 rounded-md outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Adresse Email" class="bg-gray-100 w-full py-2 px-4 rounded-md outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <input id="password" type="password" name="password" required placeholder="Mot de passe" class="bg-gray-100 w-full py-2 px-4 rounded-md outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirmer le mot de passe" class="bg-gray-100 w-full py-2 px-4 rounded-md outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md w-full">S'inscrire</button>
                </form>
                <div class="text-center mt-4">
                    <span class="text-gray-200">Vous avez déjà un compte ?</span>
                    <a href="{{ route('login') }}" class="text-gray-200 hover:text-white ml-1">Connectez-vous</a>
                </div>
            </div>
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

