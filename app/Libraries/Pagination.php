<?php

namespace App\Cells;

class Pagination
{
    public function render(array $params): string
    {
        return view('components/pagination', ['data' => $params]);
    }
}
