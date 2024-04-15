<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // For validation

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all(); // Fetch all clients

        return view('clients.index', compact('clients')); // Pass clients to the index view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Optionally, fetch any additional data needed for the create form (e.g., users for a dropdown)
        return view('clients.create');
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
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return abort(404); // Handle non-existent client
        }

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return abort(404); // Handle non-existent client
        }

        // Optionally, fetch any additional data needed for the edit form (e.g., users for a dropdown)
        return view('clients.edit', compact('client'));
    }
}