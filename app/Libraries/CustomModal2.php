<?php

namespace App\Libraries;

class CustomModal2
{
    public function render(array $params): string
    {
        return view('components/custom_modal', ['data' => $params]);
    }
}
