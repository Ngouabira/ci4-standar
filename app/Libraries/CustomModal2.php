<?php

namespace App\Libraries;

class CustomModal2
{
    public function render(array $params): string
    {
        return view('Components/custom_modal2', ['data' => $params]);
    }
}