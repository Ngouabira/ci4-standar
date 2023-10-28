<?php

namespace App\Libraries;

class FormModal
{
    public function render(array $params): string
    {
        return view('Components/form_modal', ['data' => $params]);
    }
}
