<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    /**
     * Affiche le formulaire de contact.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Traite le formulaire de contact et envoie l'email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        try {
            // Envoyer l'email en utilisant le Mailable ContactMail
            Mail::to('nettihadi@email.com')->send(new ContactMail($validatedData['name'], $validatedData['email'], $validatedData['message']));

            // Redirection avec message de succès
            return redirect()->back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous contacterons bientôt.');
        } catch (\Exception $e) {
            // Gestion de l'erreur
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer plus tard.');
        }
    }
}
