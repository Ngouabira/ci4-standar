<?php

namespace App\Libraries;

class ConfirmMessage
{
    public function render(): string
    {
        return view('components/confirm_modal');
    }
}
