<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\PharmacienController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ContactController;

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



Route::post('/ajouter-au-panier/{produitId}', [CommandeController::class, 'ajouterAuPanier'])->name('ajouter-au-panier');

// Route pour afficher le formulaire d'inscription
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route pour traiter l'inscription
Route::post('/register', [RegisterController::class, 'register']);

// Route pour afficher le formulaire de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route pour traiter la connexion
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/utilisateur/about', function () {
    return view('about');
})->name('about');


Route::group(['middleware' => 'pharmacien'], function () {
    Route::get('/produits/page', [ProduitController::class, 'Page'])->name('produits.page');
    Route::get('/pharmacien/dashboard', [PharmacienController::class, 'index'])->name('pharmacien.dashboard');
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
    Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');
    Route::get('/statistiques', [ProduitController::class, 'statistiques'])->name('statistiques.index');
    Route::post('/pharmacien/completer-profil', [PharmacienController::class, 'completerProfil'])->name('pharmacien.completerProfil');



});








Route::group(['middleware' => 'utilisateur'], function () {
    // Routes accessibles aux utilisateurs
    Route::get('/produits/page', [ProduitController::class, 'Page'])->name('produits.page');
    Route::get('/utilisateur/dashboard', [UtilisateurController::class, 'index'])->name('utilisateur.dashboard');
    Route::get('/rechercher-commandes', [UtilisateurController::class, 'rechercherCommandes'])->name('rechercher.commandes');
    Route::post('/utilisateur/completer-profil', [UtilisateurController::class, 'completerProfil'])->name('utilisateur.completerprofil');
    Route::post('/commandes/{id}/increment', [CommandeController::class, 'increment'])->name('commandes.increment');
    Route::post('/commandes/{id}/decrement', [CommandeController::class, 'decrement'])->name('commandes.decrement');
    Route::post('/commandes/{id}/confirm', [CommandeController::class, 'confirm'])->name('commandes.confirm');
    Route::post('/commandes/{id}/cancel', [CommandeController::class, 'cancel'])->name('commandes.cancel');
    Route::get('/filtrer/commandes', [CommandeController::class, 'filtrerCommandes'])->name('filtrer.commandes');
    Route::get('/utilisateur/statistiques', [UtilisateurController::class, 'statistiques'])->name('utilisateur.statistiques');

    Route::get('/utilisateur/mescommandes', [UtilisateurController::class, 'mesCommandes'])->name('utilisateur.mescommandes');
    Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
    Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
});

Route::get('/produits/page', [ProduitController::class, 'Page'])->name('produits.page');

Route::get('/', [ProduitController::class, 'welcome'])->name('welcome');

// Route pour afficher le formulaire de contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

// Route pour traiter le formulaire de contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/search', [ProduitController::class, 'search'])->name('produits.search');
Route::post('/contact', [ContactController::class, 'storeContact'])->name('contact.store');
Route::post('/contact', [ContactController::class, 'storeContact'])->name('contact.store');


Route::group(['middleware' => 'administrateur'], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('administrateur.dashboard');
    Route::get('/pharmacien/index', [pharmacienController::class, 'AllPharmaciens'])->name('pharmacien.index');
    Route::delete('/pharmaciens/{id}', [PharmacienController::class, 'destroy'])->name('pharmaciens.destroy');
    Route::get('utilisateur/index', [UtilisateurController::class, 'Allclients'])->name('client.index');
    Route::delete('/users/{id}', [UtilisateurController::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/contacts', [ContactController::class, 'showContacts'])->name('admin.contacts');
});
