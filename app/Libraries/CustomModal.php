<?php

namespace App\Libraries;

class CustomModal
{
    public function render(array $params): string
    {
        return view('Components/custom_modal', ['data' => $params]);
    }
}