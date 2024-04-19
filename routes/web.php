<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\PharmacienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route pour afficher le formulaire d'inscription
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route pour traiter l'inscription
Route::post('/register', [RegisterController::class, 'register']);

// Route pour afficher le formulaire de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route pour traiter la connexion
Route::post('/login', [LoginController::class, 'login']);


Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ProduitController;

Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');
Route::get('/statistiques', [ProduitController::class, 'statistiques'])->name('statistiques.index');

use App\Http\Controllers\CommandeController;

// Routes pour les commandes
Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
Route::get('/commandes/{commande}/edit', [CommandeController::class, 'edit'])->name('commandes.edit');
Route::put('/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');
Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');


// Route pour le tableau de bord de l'utilisateur
Route::get('/utilisateur/dashboard', [UtilisateurController::class, 'index'])->name('utilisateur.dashboard')->middleware(['auth', 'role:utilisateur']);

// Route pour le tableau de bord du pharmacien
Route::get('/pharmacien/dashboard', [PharmacienController::class, 'index'])->name('pharmacien.dashboard')->middleware(['auth', 'role:pharmacien']);

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         $role = Auth::user()->role;
//         switch ($role) {
//             case 'pharmacien':
//                 return redirect()->route('pharmacien.dashboard');
//                 break;
//             case 'utilisateur':
//                 return redirect()->route('utilisateur.dashboard');
//                 break;
//             default:
//                 return redirect()->route('dashboard');
//                 break;
//         }
//     })->name('dashboard.redirect');

//     // Routes pour les fonctionnalités spécifiques au pharmacien
//     Route::middleware(['role:pharmacien'])->group(function () {
//         Route::get('/pharmacien/dashboard', 'PharmacienDashboardController@index')->name('pharmacien.dashboard');
//         Route::get('/pharmacien/medicaments', 'PharmacienDashboardController@medicaments')->name('pharmacien.medicaments');
//     });

//     // Routes pour les fonctionnalités spécifiques à l'utilisateur
//     Route::middleware(['role:utilisateur'])->group(function () {
//         Route::get('/utilisateur/dashboard', 'UtilisateurDashboardController@index')->name('utilisateur.dashboard');
//         Route::get('/utilisateur/commandes', 'UtilisateurDashboardController@commandes')->name('utilisateur.commandes');
//     });
// });
