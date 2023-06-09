<?php

namespace App\Cells;

class SelectModal
{
    public function render(array $params): string
    {
        return view('components/select_modal', ['data' => $params]);
    }
}
