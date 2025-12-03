<?php

/** Number helper functions */

/*
 * -------------------------------------------------
 * Remove tudo que não for número ou vírgula/ponto
 * -------------------------------------------------
 */
if (!function_exists('numberSanitize')) {
    function numberSanitize(string $value): string
    {
        return preg_replace('/[^0-9\.,\-]/', '', $value);
    }
}

/*
 * -------------------------------------------------
 * Converte número brasileiro → float (ex: 1.234,56 → 1234.56)
 * -------------------------------------------------
 */
if (!function_exists('toFloat')) {
    function toFloat(string $value): float
    {
        $v = numberSanitize($value);
        $v = str_replace(['.', ','], ['', '.'], $v);  // remove thousands, convert comma
        return (float) $v;
    }
}

/*
 * -------------------------------------------------
 * Formatar número com casas decimais e separadores
 * -------------------------------------------------
 */
if (!function_exists('formatCustom')) {
    function number_format_custom(
        float $value,
        int $decimals = 2,
        string $decimalSeparator = ',',
        string $thousandSeparator = '.'
    ): string {
        return number_format($value, $decimals, $decimalSeparator, $thousandSeparator);
    }
}

/*
 * -------------------------------------------------
 * Currency (BR / US / EU)
 * -------------------------------------------------
 */
if (!function_exists('toCurrencyReal')) {
    function toCurrencyReal(float $value): string
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }
}

if (!function_exists('toCurrencyDollar')) {
    function toCurrencyDollar(float $value): string
    {
        return '$' . number_format($value, 2, '.', ',');
    }
}

if (!function_exists('toCurrencyEuro')) {
    function toCurrencyEuro(float $value): string
    {
        return '€ ' . number_format($value, 2, ',', '.');
    }
}

/*
 * -------------------------------------------------
 * Porcentagem
 * -------------------------------------------------
 */
if (!function_exists('toPercentage')) {
    function toPercentage(float $value, int $decimals = 2): string
    {
        return number_format($value * 100, $decimals, ',', '.') . '%';
    }
}

/*
 * -------------------------------------------------
 * Abreviar números (1k, 1M, 1B...)
 * -------------------------------------------------
 */
if (!function_exists('toAbbr')) {
    function toAbbr(float $num): string
    {
        if ($num >= 1_000_000_000)
            return round($num / 1_000_000_000, 2) . 'B';
        if ($num >= 1_000_000)
            return round($num / 1_000_000, 2) . 'M';
        if ($num >= 1_000)
            return round($num / 1_000, 2) . 'k';
        return (string) $num;
    }
}

/*
 * -------------------------------------------------
 * Extenso (pt-BR)
 * -------------------------------------------------
 */
if (!function_exists('toExtensoBr')) {
    function toExtensoBr(int $number): string
    {
        $units = [
            '', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis',
            'sete', 'oito', 'nove', 'dez', 'onze', 'doze', 'treze',
            'catorze', 'quinze', 'dezesseis', 'dezessete', 'dezoito', 'dezenove'
        ];

        $tens = [
            '', '', 'vinte', 'trinta', 'quarenta', 'cinquenta',
            'sessenta', 'setenta', 'oitenta', 'noventa'
        ];

        if ($number < 20)
            return $units[$number];
        if ($number < 100) {
            $d = intval($number / 10);
            $r = $number % 10;
            return $tens[$d] . ($r ? ' e ' . $units[$r] : '');
        }
        return (string) $number;  // simplificado — pode expandir depois
    }
}

/*
 * -------------------------------------------------
 * Validar número
 * -------------------------------------------------
 */
if (!function_exists('isNumeric')) {
    function isNumeric(string $value): bool
    {
        return is_numeric(numberSanitize($value));
    }
}

/*
 * -------------------------------------------------
 * Remover zeros à esquerda
 * -------------------------------------------------
 */
if (!function_exists('removeZero')) {
    function removeZero(string $value): string
    {
        return ltrim($value, '0') ?: '0';
    }
}

/*
 * -------------------------------------------------
 * Arredondar com precisão
 * -------------------------------------------------
 */
if (!function_exists('numberRound')) {
    function numberRound(float $value, int $precision = 2): float
    {
        return round($value, $precision);
    }
}