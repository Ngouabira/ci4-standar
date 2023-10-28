<?php

if (!function_exists('translate')) {
    /**
     * @param string $value
     * @param array $params
     * @return string
     */
    function translate(string $value, array $params = []): string
    {
        return lang($value, $params, session()->get('lang'));
    }
}

if (!function_exists('formatWithDecimalPrecision')) {
    /**
     * @param  $value
     * @param  $precision
     */
    function formatWithDecimalPrecision($value, $decimalPrecision)
    {
        if (!is_numeric($value) || $value === "" || $value == 0) {
            return 0;
        }

        $formattedValue = number_format((float) $value, $decimalPrecision, '.', '');

        return $formattedValue;
    }

}
