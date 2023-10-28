<?php

namespace App\Libraries;

class CustomSelect3
{
    /**
     * @param array $params
     * @return string
     */
    public function render(array $params): string
    {
        return view('Components/custom_select3', ['data' => $params]);
    }

}
