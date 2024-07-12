<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function switch(string $locale)
    {
        $supportedLocales = ['en', 'ru'];

        if (in_array($locale, $supportedLocales)) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
