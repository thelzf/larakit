<?php

/**
 * Age helper functions
 *
 * Funções para cálculo de idade e diferenças baseadas em datas
 */
if (!function_exists('age')) {
    /**
     * Retorna a idade em anos completos.
     */
    function age($birthdate): ?int
    {
        if (!$birthdate)
            return null;

        $b = new DateTime($birthdate);
        $today = new DateTime('today');

        return $b->diff($today)->y;
    }
}

if (!function_exists('ageFull')) {
    /**
     * Retorna idade completa com anos, meses e dias
     * Ex: "23 anos, 2 meses e 5 dias"
     */
    function ageFull($birthdate, string $lang = 'pt'): string
    {
        if (!$birthdate)
            return '';

        $b = new DateTime($birthdate);
        $today = new DateTime('today');
        $diff = $b->diff($today);

        $texts = [
            'pt' => ['year' => 'ano', 'month' => 'mês', 'day' => 'dia'],
            'en' => ['year' => 'year', 'month' => 'month', 'day' => 'day'],
            'es' => ['year' => 'año', 'month' => 'mes', 'day' => 'día'],
            'fr' => ['year' => 'an', 'month' => 'mois', 'day' => 'jour'],
            'it' => ['year' => 'anno', 'month' => 'mese', 'day' => 'giorno'],
            'de' => ['year' => 'Jahr', 'month' => 'Monat', 'day' => 'Tag'],
            'ru' => ['year' => 'год', 'month' => 'месяц', 'day' => 'день'],
            'zh' => ['year' => '年', 'month' => '月', 'day' => '天'],
        ];

        $t = $texts[$lang] ?? $texts['pt'];

        return "{$diff->y} {$t['year']}(s), {$diff->m} {$t['month']}(es), {$diff->d} {$t['day']}(s)";
    }
}

if (!function_exists('isAdult')) {
    /**
     * Retorna true se a pessoa tem 18 anos ou mais.
     */
    function isAdult($birthdate): bool
    {
        return age($birthdate) >= 18;
    }
}

if (!function_exists('birthdateFromAge')) {
    /**
     * Converte idade para data aproximada de nascimento
     */
    function birthdateFromAge(int $age): string
    {
        return date('Y-m-d', strtotime("-{$age} years"));
    }
}

if (!function_exists('nextBirthdate')) {
    /**
     * Retorna a próxima data de aniversário
     */
    function nextBirthdate($birthdate): string
    {
        $today = new DateTime();
        $b = new DateTime($birthdate);

        // aniversário no ano atual
        $b->setDate($today->format('Y'), $b->format('m'), $b->format('d'));

        // se já passou, vai para o ano seguinte
        if ($b < $today) {
            $b->modify('+1 year');
        }

        return $b->format('Y-m-d');
    }
}

if (!function_exists('daysUntilBirthdate')) {
    /**
     * Dias restantes até o próximo aniversário
     */
    function daysUntilBirthdate($birthdate): int
    {
        $next = new DateTime(nextBirthdate($birthdate));
        $today = new DateTime('today');

        return $today->diff($next)->days;
    }
}

if (!function_exists('isOlderThan')) {
    function isOlderThan($date, $age)
    {
        try {
            // Tenta criar data de nascimento
            $birthDate = new DateTime($date);
            $now = new DateTime();

            // Calcula a data limite (data de nascimento + X anos)
            $limitDate = clone $birthDate;
            $limitDate->modify("+{$age} years");

            // Verifica se já atingiu ou passou a idade
            return $now >= $limitDate;
        } catch (Exception $e) {
            return false;
        }
    }
}