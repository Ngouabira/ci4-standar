<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class LanguageController extends BaseController
{

    public function index($lang): RedirectResponse
    {
        session()->set('lang', $lang);
        session()->set('country', $this->getCountry($lang));
        return redirect()
            ->back();
    }

    private function getCountry(string $code): string
    {
        return match ($code) {
            'fr' => "french",
            'it' => "italian",
            'id' => "indian",
            'es' => "spanish",
            default => "english"
        };
    }

    public function saveSession(){
        session()->set($_POST);
    }
}
