<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // Save intended url
        session(['url.intended' => $request->fullUrl()]);

        $loaUrl = env('LOA_URL', 'http://localhost:8000');
        $callbackUrl = route('sso.callback');

        return $loaUrl . '/sso/login?redirect=' . urlencode($callbackUrl);
    }
}
