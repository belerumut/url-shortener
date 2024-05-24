<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $originalUrl = $request->input('url');

        $existingUrl = Url::where('original_url', $originalUrl)->first();
        if ($existingUrl) {
            return redirect('/')->with('shortened_url', $existingUrl->short_code);
        }

        $shortCode = $this->generateShortCode();
        Url::create([
            'original_url' => $originalUrl,
            'short_code' => $shortCode
        ]);

        return redirect('/')->with('shortened_url', $shortCode);
    }

    private function generateShortCode()
    {
        do {
            $shortCode = Str::random(12);
        } while (Url::where('short_code', $shortCode)->exists());

        return $shortCode;
    }

    public function show($shortCode)
    {
        $url = Url::where('short_code', $shortCode)->firstOrFail();

        return redirect($url->original_url);
    }
}
