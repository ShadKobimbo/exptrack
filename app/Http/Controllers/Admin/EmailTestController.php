<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class EmailTestController extends Controller
{
    public function index()
    {
        return view('emails.email_test');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string|max:500',
        ]);

        try {
            Mail::to($request->email)->send(new TestEmail($request->message));
            return back()->with('success', '✅ Test email sent successfully to ' . $request->email);
        } catch (\Exception $e) {
            return back()->with('error', '❌ Failed to send email: ' . $e->getMessage());
        }
    }
}
