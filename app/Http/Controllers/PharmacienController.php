<?php

namespace App\Http\Controllers;

use App\Models\Pharmacien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // For validation

class PharmacienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmaciens = Pharmacien::all(); // Fetch all pharmacists

        return view('pharmaciens.index', compact('pharmaciens')); // Pass pharmacists to the index view
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Optionally, fetch any additional data needed for the create form (e.g., users for a dropdown)
        return view('pharmaciens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'utilisateur_id' => 'required|integer', // Adjust validation rules as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pharmacien = Pharmacien::create($request->all());

        return redirect()->route('pharmaciens.index')->with('success', 'Pharmacien créé avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pharmacien = Pharmacien::find($id);

        if (!$pharmacien) {
            return abort(404); // Handle non-existent pharmacist
        }

        return view('pharmaciens.show', compact('pharmacien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pharmacien = Pharmacien::find($id);

        if (!$pharmacien) {
            return abort(404); // Handle non-existent pharmacist
        }

        // Optionally, fetch any additional data needed for the edit form (e.g., users for a dropdown)
        return view('pharmaciens.edit', compact('pharmacien'));
    }

    // ... (Add methods for update and destroy if needed)
}
