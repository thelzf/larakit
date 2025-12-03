<?php

/** Utility date helpers */
if (!function_exists('add_days')) {
    function add_days($date, int $days): string
    {
        return date('Y-m-d H:i:s', strtotime("+{$days} days", strtotime($date)));
    }
}

if (!function_exists('diff_days')) {
    function diff_days($d1, $d2): int
    {
        return (new DateTime($d1))->diff(new DateTime($d2))->days;
    }
}

if (!function_exists('is_weekend')) {
    function is_weekend($date): bool
    {
        return date('N', strtotime($date)) >= 6;
    }
}

if (!function_exists('is_valid_date')) {
    function is_valid_date($date): bool
    {
        return strtotime($date) !== false;
    }
}

if (!function_exists('now_br')) {
    function now_br(): string
    {
        return date('d/m/Y H:i:s');
    }
}

if (!function_exists('now_mysql')) {
    function now_mysql(): string
    {
        return date('Y-m-d H:i:s');
    }
}
