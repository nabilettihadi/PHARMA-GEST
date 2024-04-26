<?php

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

// Route pour afficher le formulaire d'inscription
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route pour traiter l'inscription
Route::post('/register', [RegisterController::class, 'register']);

// Route pour afficher le formulaire de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route pour traiter la connexion
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout',[LoginController::class, 'logout'])->name('logout');


Route::get('/utilisateur/about',function()
{
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


});





Route::group(['middleware' => 'utilisateur'], function () {
    // Routes accessibles aux utilisateurs
    Route::get('/produits/page', [ProduitController::class, 'Page'])->name('produits.page');
    Route::get('/utilisateur/dashboard', [UtilisateurController::class, 'index'])->name('utilisateur.dashboard');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
    Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
    Route::get('/commandes/{commande}/edit', [CommandeController::class, 'edit'])->name('commandes.edit');
    Route::put('/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');
    Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');
});

Route::get('/produits/page', [ProduitController::class, 'Page'])->name('produits.page');

Route::get('/', [ProduitController::class, 'welcome'])->name('welcome');

// Route pour afficher le formulaire de contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

// Route pour traiter le formulaire de contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

