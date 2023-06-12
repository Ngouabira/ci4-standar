<?php

namespace App\Controllers;

use CodeIgniter\Language\Language;
use Config\App;

class LanguageController extends BaseController
{
    public function index()
    {
        $lang = $this->request->getPost('lang') ?? 'en';
        $appConfig = new App();
        session()->set('lang', $lang);
        session()->set('country', $this->getCountry($lang));
        $language = new Language($lang);
        $language->setLocale($lang);
        $this->request->setLocale($lang);
        return redirect()
            ->back();
    }

    private function getCountry(string $code): string
    {
        return match ($code) {
            'fr' => "French",
            'it' => "Italian",
            default => "English"
        };
    }
}
