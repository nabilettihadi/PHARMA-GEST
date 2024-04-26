<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Barre de navigation -->
    <nav class="navbar py-4 bg-white shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none mr-4" id="burgerBtn">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <a href="#" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </a>
            </div>
            <ul class="hidden md:flex space-x-4 items-center">
                <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
            </ul>
            <ul class="hidden md:flex space-x-4 items-center">
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800"><i
                            class="fas fa-user-plus mr-1"></i>Inscription</a></li>
                <li>
                    <a href="#"
                        class="flex items-center justify-center rounded-md bg-blue-500 px-4 py-2 text-white font-semibold hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        <span class="cart-items">3</span>
                    </a>
                </li>
            </ul>
        </div>
        <ul class="md:hidden bg-white absolute top-0 left-0 right-0 mt-16 rounded-lg shadow-md py-4 px-6 space-y-4 text-center"
            style="display: none;" id="burgerMenu">
            <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
            <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
            <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
            <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
        </ul>
    </nav>

    <!-- Scripts pour gérer le menu burger -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerBtn = document.getElementById('burgerBtn');
            const burgerMenu = document.getElementById('burgerMenu');

            burgerBtn.addEventListener('click', () => {
                burgerMenu.style.display = burgerMenu.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>


    <!-- En-tête avec image de fond et texte -->
    <header class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-8 px-8 md:py-16 flex items-center">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row items-center">

                <div class="md:w-1/2 md:mr-8 mb-2 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">Votre santé, notre priorité</h1>
                    <p class="text-base md:text-lg mb-4">Trouvez les meilleurs produits pharmaceutiques et services
                        médicaux.</p>
                    <a href="#"
                        class="bg-white text-blue-500 font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-blue-600 hover:text-white transition duration-300">Découvrir</a>
                </div>

                <div class="md:w-1/2">
                    <img src="{{ asset('storage/photos/portrait.png') }}" alt="Votre image" class="w-full rounded-lg">
                </div>

            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">

        <!-- Section Services -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Section Services Médicaux -->
            <a href="#services-medicaux"
                class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-user-md text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Services Médicaux</h2>
                <p class="text-gray-600">Des professionnels de la santé pour vous conseiller et vous aider.</p>
            </a>
            <!-- Section Produits -->
            <a href="#produits" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-pills text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Produits de Qualité</h2>
                <p class="text-gray-600">Une large gamme de médicaments et produits pharmaceutiques.</p>
            </a>
            <!-- Section Conseils -->
            <a href="#conseils-sante" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <i class="fas fa-stethoscope text-4xl text-blue-500 mb-4"></i>
                <h2 class="text-xl font-semibold mb-2">Conseils Santé</h2>
                <p class="text-gray-600">Des informations et conseils pour une vie saine et équilibrée.</p>
            </a>
        </div>

        <!-- Section Services Médicaux -->
        <div id="services-medicaux"
            class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 mt-8">
            <h2 class="text-xl font-semibold mb-4 text-center">Services Médicaux</h2>
            <p class="text-gray-600 mb-6 text-center">Nos professionnels de la santé sont là pour vous guider et vous
                aider dans vos
                besoins médicaux.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <div class="bg-gray-100  p-4 rounded-lg shadow-md question" onclick="toggleAnswer('services')">
                        <h3 class="text-lg font-semibold mb-2 text-center">Nos Services</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <ul class="list-disc list-inside text-gray-600 answer" id="services" style="display: none;">
                            <li>Consultations médicales en ligne</li>
                            <li>Analyses de laboratoire à domicile</li>
                            <li>Conseils personnalisés sur les médicaments</li>
                            <li>Services de suivi et de réadaptation à distance</li>
                            <li>Guidance sur les traitements et les effets secondaires</li>
                            <li>Assistance médicale 24/7</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question " onclick="toggleAnswer('equipe')">
                        <h3 class="text-lg font-semibold mb-2 text-center">Notre Équipe</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <p class="text-gray-600 answer" id="equipe" style="display: none;">Notre équipe comprend des
                            médecins, des pharmaciens, des spécialistes en santé et des infirmiers, tous prêts à vous
                            offrir un service de qualité.</p>
                    </div>
                </div>
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question" onclick="toggleAnswer('choisir')">
                        <h3 class="text-lg font-semibold mb-2 text-center">Pourquoi Nous Choisir ?</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <ul class="list-disc list-inside text-gray-600 answer" id="choisir" style="display: none;">
                            <li>Facilité d'accès à des soins médicaux de qualité</li>
                            <li>Conseils personnalisés selon vos besoins</li>
                            <li>Confidentialité et sécurité de vos informations</li>
                            <li>Plateforme conviviale et intuitive</li>
                            <li>Assistance disponible à tout moment</li>
                            <li>Livraison rapide et efficace de vos médicaments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<!-- Section Produits -->
<div id="produits" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
    <!-- Product Cards -->
    @foreach ($produits as $produit)
        <div class="group my-10 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md product-card">
            <a class="relative mx-3 mt-3 flex h-80 overflow-hidden rounded-xl shadow-md transition duration-300 transform hover:scale-105"
                href="#">
                <img class="peer absolute top-0 right-0 h-full w-full object-cover"
                    src="{{ asset('storage/' . $produit->photo) }}" alt="{{ $produit->nom }}" />
                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white p-4">
                    <p class="text-sm">{{ $produit->description }}</p>
                </div>
            </a>
            <div class="mt-4 px-5 pb-5">
                <a href="#">
                    <h5 class="text-lg font-bold tracking-tight text-gray-900">{{ $produit->nom }}</h5>
                </a>
                <div class="mt-2 mb-5 flex items-center justify-between">
                    <p>
                        <span class="text-2xl font-bold text-gray-900">{{ number_format($produit->prix, 2, ',', ' ') }} €</span>
                    </p>
                    <button type="button"
                        class="flex items-center justify-center rounded-md bg-gradient-to-r from-blue-500 to-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-900 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>




        <!-- Section Conseils Santé -->
        <div id="conseils-sante"
            class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 mt-8">
            <h2 class="text-xl font-semibold text-white mb-4 text-center">Conseils Santé</h2>
            <p class="text-gray-600 mb-6 text-center">Des informations et des conseils pour une vie saine et
                équilibrée.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question cursor-pointer"
                        onclick="toggleAnswer('conseils')">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Nos Conseils</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <ul class="list-disc list-inside text-gray-600 answer" id="conseils" style="display: none;">
                            <li>Adoptez une alimentation équilibrée et variée</li>
                            <li>Faites de l'exercice régulièrement</li>
                            <li>Pratiquez la relaxation et la méditation</li>
                            <li>Évitez les habitudes nocives comme le tabagisme et l'excès d'alcool</li>
                            <li>Assurez-vous de bien dormir chaque nuit</li>
                            <li>Consultez régulièrement votre médecin pour des bilans de santé</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question cursor-pointer"
                        onclick="toggleAnswer('articles')">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Nos Articles</h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <p class="text-gray-600 answer" id="articles" style="display: none;">Découvrez nos articles
                            sur
                            différents sujets de santé pour rester informé et prendre soin de vous.</p>

                    </div>
                </div>
                <div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md question cursor-pointer"
                        onclick="toggleAnswer('pourquoi')">

                        <h3 class="text-lg font-semibold text-gray-800 mb-2 text-center">Pourquoi Suivre nos Conseils ?
                        </h3>
                    </div>
                    <div class="bg-gray-100 px-2 relative bottom-2 rounded-b-lg">
                        <ul class="list-disc list-inside text-gray-600 answer" id="pourquoi" style="display: none;">
                            <li>Amélioration de votre bien-être général</li>
                            <li>Réduction des risques de maladies chroniques</li>
                            <li>Conseils adaptés à vos besoins spécifiques</li>
                            <li>Approche holistique de la santé</li>
                            <li>Accès à une source d'information fiable et vérifiée</li>
                            <li>Support pour un mode de vie sain et durable</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
        <!-- Newsletter Section -->
    <section class="bg-gradient-to-r from-blue-500 to-purple-600 py-16 px-8 md:px-16">
        <div class="container mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-white text-center mb-8">Inscrivez-vous à notre Newsletter</h2>
            <form action="#" method="POST" class="flex justify-center items-center space-x-4">
                <input type="email" name="email" id="email" placeholder="Entrez votre adresse e-mail" class="bg-white border-2 border-blue-500 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-600 w-64 md:w-96">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">S'inscrire</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    $(document).ready(function() {
        AOS.init();
    });

    const button = document.querySelector('button');
    const menu = document.querySelector('.md\\:hidden ul');

    button.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    const addToCartButtons = document.querySelectorAll('.grid #produits button');
    const cartItems = document.querySelector('.cart-items');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            cartItems.textContent = parseInt(cartItems.textContent) + 1;
        });
    });
</script>
<script>
    function toggleAnswer(id) {
        const answer = document.getElementById(id);
        answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
    }
</script>

</body>

</html>