<?php

/**
 * Array helper functions
 *
 * Funções utilitárias avançadas para manipulação de arrays
 */
if (!function_exists('array_first')) {
    /**
     * Retorna o primeiro item do array
     */
    function array_first(array $array)
    {
        return reset($array);
    }
}

if (!function_exists('array_last')) {
    /**
     * Retorna o último item do array
     */
    function array_last(array $array)
    {
        return end($array);
    }
}

if (!function_exists('array_flatten')) {
    /**
     * Flatten multi-dimensional array into single level
     */
    function array_flatten(array $array): array
    {
        $result = [];

        array_walk_recursive($array, function ($value) use (&$result) {
            $result[] = $value;
        });

        return $result;
    }
}

if (!function_exists('array_only')) {
    /**
     * Retorna somente as chaves especificadas
     */
    function array_only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }
}

if (!function_exists('array_except')) {
    /**
     * Remove chaves especificadas
     */
    function array_except(array $array, array $keys): array
    {
        return array_diff_key($array, array_flip($keys));
    }
}

if (!function_exists('array_clean')) {
    /**
     * Remove valores vazios: null, '', [], false
     */
    function array_clean(array $array): array
    {
        return array_filter($array, fn($v) => !empty($v) || $v === 0);
    }
}

if (!function_exists('array_is_assoc')) {
    /**
     * Verifica se um array é associativo
     */
    function array_is_assoc(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }
}

if (!function_exists('array_group_by')) {
    /**
     * Agrupa itens por chave
     */
    function array_group_by(array $array, string $key): array
    {
        $result = [];

        foreach ($array as $item) {
            if (is_array($item) && isset($item[$key])) {
                $result[$item[$key]][] = $item;
            } elseif (is_object($item) && isset($item->$key)) {
                $result[$item->$key][] = $item;
            }
        }

        return $result;
    }
}

if (!function_exists('array_pluck')) {
    /**
     * Extrai uma coluna de um array multidimensional
     */
    function array_pluck(array $array, string $key): array
    {
        return array_map(function ($item) use ($key) {
            return is_array($item) ? ($item[$key] ?? null) : ($item->$key ?? null);
        }, $array);
    }
}

if (!function_exists('array_random')) {
    /**
     * Retorna um valor aleatório do array
     */
    function array_random(array $array)
    {
        return $array[array_rand($array)];
    }
}

if (!function_exists('array_shuffle_assoc')) {
    /**
     * Shuffle preservando chaves
     */
    function array_shuffle_assoc(array $array): array
    {
        $keys = array_keys($array);
        shuffle($keys);

        $result = [];
        foreach ($keys as $k) {
            $result[$k] = $array[$k];
        }

        return $result;
    }
}

if (!function_exists('array_to_object')) {
    /**
     * Converte array em objeto stdClass
     */
    function array_to_object(array $array): object
    {
        return json_decode(json_encode($array));
    }
}

if (!function_exists('object_to_array')) {
    /**
     * Converte objeto para array
     */
    function object_to_array(object $obj): array
    {
        return json_decode(json_encode($obj), true);
    }
}

if (!function_exists('array_has')) {
    /**
     * Verifica se o array contém uma chave (suporta notação dot)
     */
    function array_has(array $array, string $key): bool
    {
        if (array_key_exists($key, $array))
            return true;

        $segments = explode('.', $key);

        foreach ($segments as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return false;
            }
            $array = $array[$segment];
        }
        return true;
    }
}

if (!function_exists('array_get')) {
    /**
     * Retorna um valor usando notação dot
     */
    function array_get(array $array, string $key, $default = null)
    {
        if (array_key_exists($key, $array))
            return $array[$key];

        foreach (explode('.', $key) as $segment) {
            if (!isset($array[$segment]))
                return $default;
            $array = $array[$segment];
        }

        return $array;
    }
}

if (!function_exists('array_set')) {
    /**
     * Define um valor usando notação dot
     */
    function array_set(array &$array, string $key, $value): void
    {
        $keys = explode('.', $key);

        foreach ($keys as $i => $k) {
            if ($i === count($keys) - 1) {
                $array[$k] = $value;
                return;
            }

            if (!isset($array[$k]) || !is_array($array[$k])) {
                $array[$k] = [];
            }

            $array = &$array[$k];
        }
    }
}
