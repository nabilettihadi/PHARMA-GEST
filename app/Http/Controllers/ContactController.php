<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function storeContact(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|numeric',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);


        Contact::create($validatedData);


        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous contacterons bientôt.');
    }

    public function showContacts()
    {

        $contacts = Contact::all();


        return view('admin.contacts', compact('contacts'));
    }
}
