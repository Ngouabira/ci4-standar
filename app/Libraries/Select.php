<?php

namespace App\Libraries;

class Select
{
    public function render(array $params): string
    {
        return view('components/select', ['data' => $params]);
    }
}
