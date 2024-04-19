<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .form-container {
            background: linear-gradient(to right, #4c80f1, #4268d4);
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container input {
            border-radius: 8px;
        }

        .form-container button {
            transition: all 0.3s ease;
        }

        .form-container button:hover {
            transform: translateY(-2px);
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Barre de navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>
            <ul class="flex space-x-4">
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
            </ul>
        </div>
    </nav>

    <div id="app" class="min-h-screen flex justify-center items-center bg-cover bg-center"
        style="background-image: url('https://source.unsplash.com/1600x900/?pharmacy')">
        <div class="w-full max-w-md">
            <div class="form-container p-8">
                <h1 class="text-2xl font-bold text-white mb-4">Connexion</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus placeholder="Adresse Email"
                            class="bg-gray-100 w-full py-2 px-4 rounded-md outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <input id="password" type="password" name="password" required placeholder="Mot de passe"
                            class="bg-gray-100 w-full py-2 px-4 rounded-md outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md w-full">Se
                        connecter</button>
                </form>
                <div class="text-center mt-4">
                    <a href="#" class="text-gray-200 hover:text-white">Mot de passe oublié ?</a>
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
