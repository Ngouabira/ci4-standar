<?php

namespace App\Libraries;

class Message
{
    public function render(): string
    {
        return view('components/message');
    }
}
