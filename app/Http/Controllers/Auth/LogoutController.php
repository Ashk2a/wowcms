<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;

class LogoutController
{
    public function __invoke(): RedirectResponse
    {
        auth()->logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home');
    }
}
