<?php

namespace App\Libraries;

class CustomModal3
{
    public function render(array $params): string
    {
        return view('Components/custom_modal3', ['data' => $params]);
    }
}
