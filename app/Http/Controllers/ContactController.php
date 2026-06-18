<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        // Honeypot — bots fill this field, humans never see it
        if ($request->filled('website')) {
            return back(); // silent fail, no error shown to bot
        }

        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:100'],
            'email'        => ['required', 'email', 'max:150'],
            'project_type' => ['required', 'in:Music Video,Brand Film,Social Media Content,Commercial,Creative Direction,Other'],
            'message'      => ['required', 'string', 'min:20', 'max:2000'],
        ]);

        Mail::to('odanysloco@gmail.com')->send(new ContactMail($validated));

        return back()->with('success', "Your message has been sent. I'll be in touch within 48 hours.");
    }
}
