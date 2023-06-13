<?php

namespace App\Libraries;

class CustomModal
{
    public function render(array $params): string
    {
        return view('components/select_modal', ['data' => $params]);
    }
}
