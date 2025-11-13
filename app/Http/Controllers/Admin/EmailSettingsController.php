<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmailSettingsController extends Controller
{
    public function index()
    {
        // Load current email config from .env
        $settings = [
            'MAIL_MAILER' => env('MAIL_MAILER', 'smtp'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        ];

        return view('emails.email_settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'MAIL_MAILER' => 'required|string',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|numeric',
            'MAIL_USERNAME' => 'nullable|string',
            'MAIL_PASSWORD' => 'nullable|string',
            'MAIL_ENCRYPTION' => 'nullable|string',
            'MAIL_FROM_ADDRESS' => 'required|email',
            'MAIL_FROM_NAME' => 'required|string',
        ]);

        $path = base_path('.env');

        // Update or add email-related keys in .env
        foreach ($request->only(array_keys($request->all())) as $key => $value) {
            self::setEnvValue($key, $value, $path);
        }

        return back()->with('success', '✅ Email settings updated successfully!');
    }

    // Helper to update or insert key=value in .env file
    private static function setEnvValue($key, $value, $path)
    {
        $content = File::get($path);
        $pattern = "/^{$key}=.*/m";

        $line = $key . '=' . (str_contains($value, ' ') ? "\"$value\"" : $value);

        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, $line, $content);
        } else {
            $content .= "\n{$line}";
        }

        File::put($path, $content);
    }
}
