<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class Contactcontroller extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submitForm(Request $request)
    {
        $request ->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',

        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,

        ];

        Mail::send('email.contact',$details, function ($message) use ($details){
            $message->to('admin@teachers-app.com')
            ->subject('New Contact Form Submission');
        });
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
