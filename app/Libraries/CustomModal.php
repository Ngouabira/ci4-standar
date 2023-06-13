<?php

namespace App\Libraries;

class CustomModal
{
    public function render(array $params): string
    {
        return view('components/custom_modal', ['data' => $params]);
    }
}
