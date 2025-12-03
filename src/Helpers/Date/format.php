<?php

/** Multi-language simple date formatting */
if (!function_exists('format_date')) {
    function format_date($date, string $lang = 'pt'): ?string
    {
        if (!$date)
            return null;
        $ts = strtotime($date);
        if (!$ts)
            return null;

        $map = [
            'pt' => 'd/m/Y',
            'en' => 'm-d-Y',
            'es' => 'd/m/Y',
            'fr' => 'd-m-Y',
            'it' => 'd-m-Y',
            'de' => 'd.m.Y',
            'ru' => 'd.m.Y',
        ];

        $format = $map[$lang] ?? $map['pt'];

        return date($format, $ts);
    }
}

if (!function_exists('format_date_br')) {
    function format_date_br($date): ?string
    {
        return $date ? date('d/m/Y', strtotime($date)) : null;
    }
}

if (!function_exists('format_date_db')) {
    function format_date_db($date): ?string
    {
        if (!$date)
            return null;
        [$d, $m, $y] = explode('/', $date);
        return "$y-$m-$d";
    }
}
