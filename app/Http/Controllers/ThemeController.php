<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    private const THEME_SESSION_KEY = 'theme';

    public function change_theme(string $theme): RedirectResponse
    {
        session()->put(self::THEME_SESSION_KEY, $theme);
        return redirect()->back();
    }
}
