<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Barre de navigation -->
    <nav class="navbar py-4 bg-white shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-semibold text-gray-800">Pharma<span
                    class="text-blue-500">Care</span></a>


            <ul class="hidden md:flex space-x-4 items-center">
                <!-- Authentification -->
                @auth
                    @if (auth()->user()->role === 'utilisateur')
                        <li><a href="{{ route('utilisateur.dashboard') }}"
                                class="text-gray-600 hover:text-gray-800">Dashboard</a></li>
                    @elseif(auth()->user()->role === 'pharmacien')
                        <li><a href="{{ route('pharmacien.dashboard') }}"
                                class="text-gray-600 hover:text-gray-800">Dashboard</a></li>
                    @endif
                @endAuth
                <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
                <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
                <!-- Authentification pour le panier -->
                @guest
                    <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800"><i
                                class="fas fa-user-plus mr-1"></i>Inscription</a></li>
                    <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800"><i
                                class="fas fa-user-plus mr-1"></i>Connexion</a></li>
                @endguest
            </ul>
            <!-- Menu de navigation -->
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none mr-4" id="burgerBtn">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            <!-- Panier -->
            <ul class="md:flex space-x-4 items-center">
                <li>
                    <a href="#" id="cartNavbarBtn"
                        class="flex items-center justify-center rounded-md bg-blue-500 px-4 py-2 text-white font-semibold hover:bg-blue-600 transition duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        @auth
                            <span
                                class="cart-items">{{ auth()->user()->commandes()->where('etat', 'En attente')->count() }}</span>
                        @endauth
                    </a>
                </li>

            </ul>
        </div>

        <!-- Menu burger pour les écrans mobiles -->
        <ul class="md:hidden bg-white absolute top-0 left-0 right-0 mt-16 rounded-lg shadow-md py-4 px-6 space-y-4 text-center z-50"
            style="display: none;" id="burgerMenu">
            @guest
                <!-- Authentification pour mobile -->
                <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800">Inscription</a></li>
                <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a></li>
            @endguest
            <li><a href="{{ route('produits.page') }}" class="text-gray-600 hover:text-gray-800">Produits</a></li>
            <li><a href="{{ route('contact.show') }}" class="text-gray-600 hover:text-gray-800">Contact</a></li>
            <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800">À propos</a></li>
        </ul>

        <!-- Dropdown des commandes -->
        <div class="relative">
            <ul class="absolute right-0 w-70 bg-white border border-gray-200 shadow-md rounded-lg mt-2 py-4 hidden mr-2 z-50"
                id="cartDropdown">
                <!-- Liste des commandes de l'utilisateur -->
                @auth
                    @foreach (auth()->user()->commandes()->where('etat', 'En attente')->get() as $commande)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                            <!-- Contenu de la carte -->
                            <div class="px-4 py-2">
                                <div class="flex items-center space-x-4">
                                    <!-- Image et détails de la commande -->
                                    <img src="{{ asset('storage/' . $commande->produits->photo) }}"
                                        alt="{{ $commande->produits->nom }}"
                                        class="w-16 h-16 object-cover rounded-lg shadow-lg">
                                    <div>
                                        <p class="font-semibold text-xl">{{ $commande->produits->nom }}</p>
                                        <p class="text-sm text-gray-600">Quantité: {{ $commande->quantite }}</p>
                                    </div>
                                </div>
                                <!-- Actions -->
                                <div class="flex items-center space-x-4 mt-4">
                                    <!-- Décrémenter la quantité -->
                                    <form action="{{ route('commandes.decrement', ['id' => $commande->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-danger btn-sm bg-red-500 hover:bg-red-600 rounded-full px-3 py-1">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </form>
                                    <p id="quantite-{{ $commande->id }}" class="text-lg font-semibold">
                                        {{ $commande->quantite }}</p>
                                    <form action="{{ route('commandes.increment', ['id' => $commande->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-primary btn-sm bg-blue-500 hover:bg-blue-600 rounded-full px-3 py-1">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                    <!-- Annuler la commande -->
                                    <form action="{{ route('commandes.cancel', ['id' => $commande->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-danger btn-sm bg-red-500 hover:bg-red-600 rounded-full px-3 py-1">
                                            <i class="fas fa-times"></i>Annuler
                                        </button>
                                    </form>
                                    <!-- Confirmer la commande -->
                                    <form action="{{ route('commandes.confirm', ['id' => $commande->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-success btn-sm bg-green-500 hover:bg-green-600 rounded-full px-3 py-1">
                                            <i class="fas fa-check"></i>Confirmer
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Pied de la carte -->
                            <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                                <div>
                                    <span class="text-gray-600 block">Total:</span>
                                    <span class="font-semibold">${{ $commande->total }}</span>
                                </div>
                                <div>
                                    <span class="text-green-600 font-semibold">État:
                                        @if ($commande->etat == 'En attente')
                                            <span class="text-red-600">{{ $commande->etat }}</span>
                                        @else
                                            <span class="text-green-600">{{ $commande->etat }}</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endauth
            </ul>
        </div>
    </nav>


    <!-- Contenu principal -->
    <div
        class="grid md:grid-cols-2 items-center overflow-hidden shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-3xl max-w-6xl mx-auto bg-white my-6 font-[sans-serif] relative z-10">
        <div class="sm:p-10 max-sm:px-4 max-sm:py-8">
            <h2 class="text-3xl font-extrabold text-gray-800">Get In <span class="text-blue-500">Touch</span></h2>
            <p class="text-sm text-gray-400 mt-3">Have a specific inquiry or looking to explore new opportunities? Our
                experienced team is ready to engage with you.</p>
            <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="space-y-4 mt-8">
                    <input type="text" id="name" name="name" placeholder="Full Name"
                        class="px-2 py-3 bg-transparent text-gray-800 w-full text-sm border-b border-gray-400 focus:border-blue-500 outline-none" />
                    <input type="text" id="street" name="street" placeholder="Street"
                        class="px-2 py-3 bg-transparent text-gray-800 w-full text-sm border-b border-gray-400 focus:border-blue-500 outline-none" />
                    <div class="grid grid-cols-2 gap-6">
                        <input type="text" id="city" name="city" placeholder="City"
                            class="px-2 py-3 bg-transparent text-gray-800 w-full text-sm border-b border-gray-400 focus:border-blue-500 outline-none" />

                        <input type="text" id="postcode" name="postcode" placeholder="Postcode"
                            class="px-2 py-3 bg-transparent text-gray-800 w-full text-sm border-b border-gray-400 focus:border-blue-500 outline-none" />
                    </div>
                    <input type="number" id="phone" name="phone" placeholder="Phone No."
                        class="px-2 py-3 bg-transparent text-gray-800 w-full text-sm border-b border-gray-400 focus:border-blue-500 outline-none" />

                    <input type="email" id="email" name="email" placeholder="Email"
                        class="px-2 py-3 bg-transparent text-gray-800 w-full text-sm border-b border-gray-400 focus:border-blue-500 outline-none" />

                    <textarea id="message" name="message" placeholder="Write Message"
                        class="px-2 pt-3 bg-transparent text-gray-800 w-full text-sm border-b border-gray-400 focus:border-blue-500 outline-none"></textarea>
                </div>
                <button type="submit"
                    class="mt-8 flex items-center justify-center text-sm w-full rounded px-4 py-2.5 font-semibold bg-blue-500 text-white hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill='#fff'
                        class="mr-2" viewBox="0 0 548.244 548.244">
                        <path fill-rule="evenodd"
                            d="M392.19 156.054 211.268 281.667 22.032 218.58C8.823 214.168-.076 201.775 0 187.852c.077-13.923 9.078-26.24 22.338-30.498L506.15 1.549c11.5-3.697 24.123-.663 32.666 7.88 8.542 8.543 11.577 21.165 7.879 32.666L390.89 525.906c-4.258 13.26-16.575 22.261-30.498 22.338-13.923.076-26.316-8.823-30.728-22.032l-63.393-190.153z"
                            clip-rule="evenodd" data-original="#000000" />
                    </svg>
                    Send Message
                </button>
                <p id="nameError" class="text-red-500 text-sm mt-2"></p>
                <p id="emailError" class="text-red-500 text-sm mt-2"></p>
                <p id="messageError" class="text-red-500 text-sm mt-2"></p>
            </form>
            <ul class="mt-4 flex justify-center lg:space-x-6 max-lg:flex-col max-lg:items-center max-lg:space-y-2 ">
                <li class="flex items-center text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill='currentColor'
                        viewBox="0 0 479.058 479.058">
                        <path
                            d="M434.146 59.882H44.912C20.146 59.882 0 80.028 0 104.794v269.47c0 24.766 20.146 44.912 44.912 44.912h389.234c24.766 0 44.912-20.146 44.912-44.912v-269.47c0-24.766-20.146-44.912-44.912-44.912zm0 29.941c2.034 0 3.969.422 5.738 1.159L239.529 264.631 39.173 90.982a14.902 14.902 0 0 1 5.738-1.159zm0 299.411H44.912c-8.26 0-14.971-6.71-14.971-14.971V122.615l199.778 173.141c2.822 2.441 6.316 3.655 9.81 3.655s6.988-1.213 9.81-3.655l199.778-173.141v251.649c-.001 8.26-6.711 14.97-14.971 14.97z"
                            data-original="#000000" />
                    </svg>
                    <a href="javascript:void(0)" class="text-current text-sm ml-3">
                        <strong>info@pharmacare.com</strong>
                    </a>
                </li>
                <li class="flex items-center text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill='currentColor'
                        viewBox="0 0 482.6 482.6">
                        <path
                            d="M98.339 320.8c47.6 56.9 104.9 101.7 170.3 133.4 24.9 11.8 58.2 25.8 95.3 28.2 2.3.1 4.5.2 6.8.2 24.9 0 44.9-8.6 61.2-26.3.1-.1.3-.3.4-.5 5.8-7 12.4-13.3 19.3-20 4.7-4.5 9.5-9.2 14.1-14 21.3-22.2 21.3-50.4-.2-71.9l-60.1-60.1c-10.2-10.6-22.4-16.2-35.2-16.2-12.8 0-25.1 5.6-35.6 16.1l-35.8 35.8c-3.3-1.9-6.7-3.6-9.9-5.2-4-2-7.7-3.9-11-6-32.6-20.7-62.2-47.7-90.5-82.4-14.3-18.1-23.9-33.3-30.6-48.8 9.4-8.5 18.2-17.4 26.7-26.1 3-3.1 6.1-6.2 9.2-9.3 10.8-10.8 16.6-23.3 16.6-36s-5.7-25.2-16.6-36l-29.8-29.8c-3.5-3.5-6.8-6.9-10.2-10.4-6.6-6.8-13.5-13.8-20.3-20.1-10.3-10.1-22.4-15.4-35.2-15.4-12.7 0-24.9 5.3-35.6 15.5l-37.4 37.4c-13.6 13.6-21.3 30.1-22.9 49.2-1.9 23.9 2.5 49.3 13.9 80 17.5 47.5 43.9 91.6 83.1 138.7zm-72.6-216.6c1.2-13.3 6.3-24.4 15.9-34l37.2-37.2c5.8-5.6 12.2-8.5 18.4-8.5 6.1 0 12.3 2.9 18 8.7 6.7 6.2 13 12.7 19.8 19.6 3.4 3.5 6.9 7 10.4 10.6l29.8 29.8c6.2 6.2 9.4 12.5 9.4 18.7s-3.2 12.5-9.4 18.7c-3.1 3.1-6.2 6.3-9.3 9.4-9.3 9.4-18 18.3-27.6 26.8l-.5.5c-8.3 8.3-7 16.2-5 22.2.1.3.2.5.3.8 7.7 18.5 18.4 36.1 35.1 57.1 30 37 61.6 65.7 96.4 87.8 4.3 2.8 8.9 5 13.2 7.2 4 2 7.7 3.9 11 6 .4.2.7.4 1.1.6 3.3 1.7 6.5 2.5 9.7 2.5 8 0 13.2-5.1 14.9-6.8l37.4-37.4c5.8-5.8 12.1-8.9 18.3-8.9 7.6 0 13.8 4.7 17.7 8.9l60.3 60.2c12 12 11.9 25-.3 37.7-4.2 4.5-8.6 8.8-13.3 13.3-7 6.8-14.3 13.8-20.9 21.7-11.5 12.4-25.2 18.2-42.9 18.2-1.7 0-3.5-.1-5.2-.2-32.8-2.1-63.3-14.9-86.2-25.8-62.2-30.1-116.8-72.8-162.1-127-37.3-44.9-62.4-86.7-79-131.5-10.3-27.5-14.2-49.6-12.6-69.7z"
                            data-original="#000000"></path>
                    </svg>
                    <a href="javascript:void(0)" class="text-current text-sm ml-3">
                        <strong>+212 612 345 678</strong>
                    </a>
                </li>
            </ul>
        </div>
        <div class="relative h-full max-md:min-h-[350px]">
            <iframe src="https://maps.google.com/maps?q=manhattan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                class="left-0 top-0 h-full w-full rounded-t-lg lg:rounded-tr-none lg:rounded-bl-lg absolute z-0"
                frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} PharmaCare. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Validation du formulaire côté client -->



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartNavbarBtn = document.getElementById('cartNavbarBtn');
            const cartDropdown = document.getElementById('cartDropdown');
            const cartDropdownMobile = document.getElementById('cartDropdownMobile');
            const burgerBtn = document.getElementById('burgerBtn');
            const burgerMenu = document.getElementById('burgerMenu');

            cartNavbarBtn.addEventListener('click', () => {
                cartDropdown.classList.toggle('hidden');
                cartDropdownMobile.classList.add('hidden');
            });

            burgerBtn.addEventListener('click', () => {
                burgerMenu.style.display = burgerMenu.style.display === 'none' ? 'block' : 'none';
                cartDropdownMobile.classList.add('hidden');
            });
        });
    </script>
</body>

</html>
