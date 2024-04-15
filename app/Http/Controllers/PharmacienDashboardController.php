<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacienDashboardController extends Controller
{
    public function index()
    {
        return view('pharmacien.dashboard');
    }
}
