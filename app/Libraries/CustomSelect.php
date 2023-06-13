<?php

namespace App\Libraries;

class CustomSelect
{
    public function render(array $params): string
    {
        return view('components/custom_select', ['data' => $params]);
    }
}
