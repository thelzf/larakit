<?php

/** Human-readable date formats in multiple languages */
if (!function_exists('human_date')) {
    function human_date($date, string $lang = 'pt'): string
    {
        $week = weekday_name($date, $lang);
        $day = date('d', strtotime($date));
        $month = month_name($date, $lang);
        $year = date('Y', strtotime($date));

        $formats = [
            'pt' => "$week, $day de $month de $year",
            'es' => "$week, $day de $month de $year",
            'fr' => "$week $day $month $year",
            'it' => "$week $day $month $year",
            'de' => "$week, $day. $month $year",
            'en' => "$week, $month $day, $year",
            'ru' => "$week, $day $month $year г.",
        ];

        return $formats[$lang] ?? $formats['pt'];
    }
}

if (!function_exists('human_datetime')) {
    function human_datetime($datetime, string $lang = 'pt'): string
    {
        $date = human_date($datetime, $lang);
        $time = date('H:i', strtotime($datetime));

        $suffix = [
            'pt' => "às $time",
            'es' => "a las $time",
            'fr' => "à $time",
            'it' => "alle $time",
            'de' => "um $time",
            'en' => "at $time",
            'ru' => "в $time",
        ];

        return "$date " . ($suffix[$lang] ?? $suffix['pt']);
    }
}
