<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('pages.contact');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to('avora.fun.eg@gmail.com')->send(new ContactMail($validated));

        return redirect()->back()->with('status', 'تم إرسال رسالتكِ بنجاح! سنتواصل معكِ قريباً.');
    }
}

