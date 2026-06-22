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

        try {
            Mail::to(env('MAIL_TO_ADDRESS', 'hello@odanysmedia.com'))
                ->send(new ContactMail($validated));
        } catch (\Exception $e) {
            report($e);
            return back()
                ->withInput()
                ->withErrors(['email' => 'There was a problem sending your message. Please try again or email hello@odanysmedia.com directly.']);
        }

        return back()->with('success', "Your message has been sent. I'll be in touch within 48 hours.");
    }
}
