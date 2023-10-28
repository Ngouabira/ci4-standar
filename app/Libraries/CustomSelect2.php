<?php

namespace App\Libraries;

class CustomSelect2
{
    /**
     * @param array $params
     * @return string
     */
    public function render(array $params): string
    {
        return view('Components/custom_select2', ['data' => $params]);
    }

}