<?php

namespace App\Http\Controllers;

use App\Models\Pharmacien;
use App\Models\User;
use Illuminate\Http\Request;


class PharmacienController extends Controller
{
    public function index()
    {
        return view('pharmacien.dashboard');
    }


    public function AllPharmaciens()
    {
        $pharmaciens = User::where('role', 'pharmacien')->get();
        return view('pharmacien.index', compact('pharmaciens'));
    }

    public function destroy($id)
    {
        $pharmacien = User::findOrFail($id);

        $pharmacien->delete();

        return redirect()->route('pharmacien.index')->with('success', 'Pharmacien supprimé avec succès');
    }
}
