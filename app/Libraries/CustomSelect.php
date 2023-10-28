<?php

namespace App\Libraries;

class CustomSelect
{
    /**
     * @param array $params
     * @return string
     */
    public function render(array $params): string
    {
        return view('Components/custom_select', ['data' => $params]);
    }

}