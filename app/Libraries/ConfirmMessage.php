<?php

namespace App\Cells;

class ConfirmMessage
{
    public function render(array $params): string
    {
        return view('components/confirm_message', ['data' => $params]);
    }
}
