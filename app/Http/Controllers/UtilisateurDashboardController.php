<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilisateurDashboardController extends Controller
{
    public function index()
    {
        return view('utilisateur.dashboard');
    }
}
