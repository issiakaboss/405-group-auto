<?php

namespace App\Http\Controllers;

use App\Mail\ContactAutoReplyMail;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // 1. Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'required|string',
        ]);

        // 2. Send the email
        Mail::to('info@405autogroup.com')
            ->send(new ContactMessageMail($validated));

        Mail::to($validated['email'])
            ->send(new ContactAutoReplyMail($validated));

        return redirect()->back()->with('success', 'Your message has been sent successfully! We will get back to you shortly.');
    }
}
