<?php

namespace App\Controllers;

class LanguageController extends BaseController
{
    public function index()
    {
        $lang = $this->request->getPost('lang') ?? 'en';
        session()->set('lang', $lang);
        session()->set('country', $this->getCountry($lang));

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
