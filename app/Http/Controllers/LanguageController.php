<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application language based on the provided language code.
     */
    public function switchLang($lang)
    {
        // Check if the provided language code exists in the configured languages.
        if (array_key_exists($lang, Config::get('languages'))) {
            // Set the application locale in the session to the selected language.
            Session::put('applocale', $lang);
        }

        return Redirect::back();
    }
}
