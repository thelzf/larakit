<?php

/**
 * Mask helper functions
 *
 * Funções para aplicar e remover máscaras de textos
 */
if (!function_exists('unmask')) {
    function unmask(string $value): string
    {
        return preg_replace('/\D/', '', $value);
    }
}

if (!function_exists('mask')) {
    function mask(string $value, string $mask): string
    {
        $value = unmask($value);
        $masked = '';
        $k = 0;

        for ($i = 0; $i < strlen($mask); $i++) {
            if ($mask[$i] === '#') {
                if (isset($value[$k])) {
                    $masked .= $value[$k++];
                }
            } else {
                $masked .= $mask[$i];
            }
        }

        return $masked;
    }
}

/*
 * ============================================================
 * DOCUMENTOS BR
 * ============================================================
 */

if (!function_exists('maskCpf')) {
    function maskCpf(string $cpf): string
    {
        return mask($cpf, '###.###.###-##');
    }
}

if (!function_exists('maskCnpj')) {
    function maskCnpj(string $cnpj): string
    {
        return mask($cnpj, '##.###.###/####-##');
    }
}

if (!function_exists('maskCpfCnpj')) {
    function maskCpfCnpj(string $value): string
    {
        $value = unmask($value);
        return strlen($value) <= 11 ? maskCpf($value) : maskCnpj($value);
    }
}

if (!function_exists('maskRg')) {
    function maskRg(string $rg): string
    {
        return mask($rg, '##.###.###-#');
    }
}

if (!function_exists('maskCnh')) {
    function maskCnh(string $cnh): string
    {
        return mask($cnh, '###########');
    }
}

if (!function_exists('maskCep')) {
    function maskCep(string $cep): string
    {
        return mask($cep, '#####-###');
    }
}

/*
 * ============================================================
 * TELEFONES
 * ============================================================
 */

if (!function_exists('maskPhoneBr')) {
    function maskPhoneBr(string $phone): string
    {
        $phone = unmask($phone);
        return strlen($phone) == 10
            ? mask($phone, '(##) ####-####')
            : mask($phone, '(##) #####-####');
    }
}

if (!function_exists('maskPhoneIntl')) {
    function maskPhoneIntl(string $phone): string
    {
        $phone = unmask($phone);

        if (strlen($phone) >= 13)
            return mask($phone, '+## (##) #####-####');

        if (strlen($phone) >= 11)
            return mask($phone, '+## ###########');

        return $phone;
    }
}

/*
 * ============================================================
 * PLACAS
 * ============================================================
 */

if (!function_exists('maskPlacaMercosul')) {
    function maskPlacaMercosul(string $value): string
    {
        $value = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value));

        if (strlen($value) !== 7)
            return $value;

        return substr($value, 0, 3) . '-' . substr($value, 3);
    }
}

/*
 * ============================================================
 * CARTÃO DE CRÉDITO
 * ============================================================
 */

if (!function_exists('mask_credit_card')) {
    function mask_credit_card(string $value): string
    {
        return mask($value, '#### #### #### ####');
    }
}

if (!function_exists('mask_credit_card_hidden')) {
    function mask_credit_card_hidden(string $value): string
    {
        $value = unmask($value);
        if (strlen($value) < 4)
            return '****';

        $last = substr($value, -4);
        return "**** **** **** $last";
    }
}

if (!function_exists('mask_credit_card_grouped')) {
    function mask_credit_card_grouped(string $value): string
    {
        return trim(chunk_split(unmask($value), 4, ' '));
    }
}

/*
 * ============================================================
 * DATAS E HORAS
 * ============================================================
 */

if (!function_exists('mask_date')) {
    function mask_date(string $value): string
    {
        return mask($value, '##/##/####');
    }
}

if (!function_exists('mask_time')) {
    function mask_time(string $value): string
    {
        return mask($value, '##:##:##');
    }
}

if (!function_exists('mask_datetime')) {
    function mask_datetime(string $value): string
    {
        return mask($value, '##/##/#### ##:##:##');
    }
}

/*
 * ============================================================
 * INTERNACIONAIS
 * ============================================================
 */

if (!function_exists('mask_iban')) {
    function mask_iban(string $value): string
    {
        $value = strtoupper(preg_replace('/\s/', '', $value));
        return trim(chunk_split($value, 4, ' '));
    }
}

if (!function_exists('mask_swift')) {
    function mask_swift(string $swift): string
    {
        $swift = strtoupper(preg_replace('/[^A-Z0-9]/', '', $swift));
        return $swift;
    }
}

if (!function_exists('mask_passport')) {
    /**
     * Passaportes variados
     * BR = letras + números
     * EUA = 9 dígitos
     */
    function mask_passport(string $value, string $country = 'BR'): string
    {
        $value = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value));

        return match (strtoupper($country)) {
            'US', 'USA' => substr($value, 0, 9),
            'BR', 'BRA' => substr($value, 0, 2) . substr($value, 2, 6),
            default => $value
        };
    }
}

/*
 * -----------------------
 * Helper to strip non-digits
 * -----------------------
 */
if (!function_exists('only_digits')) {
    function only_digits(string $v): string
    {
        return preg_replace('/\D+/', '', $v);
    }
}

/*
 * -----------------------
 * PIX keys
 * -----------------------
 */

if (!function_exists('mask_pix_cpf')) {
    function mask_pix_cpf(string $cpf): string
    {
        $n = only_digits($cpf);
        return strlen($n) <= 11 ? (function_exists('mask_cpf') ? mask_cpf($n) : preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $n)) : $cpf;
    }
}

if (!function_exists('mask_pix_cnpj')) {
    function mask_pix_cnpj(string $cnpj): string
    {
        $n = only_digits($cnpj);
        return strlen($n) === 14 ? (function_exists('mask_cnpj') ? mask_cnpj($n) : preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $n)) : $cnpj;
    }
}

if (!function_exists('mask_pix_phone')) {
    function mask_pix_phone(string $phone): string
    {
        // show in +CC (AA) NNNNN-NNNN if possible
        $p = only_digits($phone);
        if (strlen($p) >= 11) {
            // try country code + number: last 10/11 digits as BR style
            $last = substr($p, -11);
            $cc = substr($p, 0, strlen($p) - 11);
            $cc = $cc ? '+' . $cc . ' ' : '';
            return $cc . (function_exists('mask_phone_br') ? mask_phone_br($last) : preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $last));
        }
        return $phone;
    }
}

if (!function_exists('mask_pix_email')) {
    function mask_pix_email(string $email, int $showBefore = 2, int $showAfterDomain = 2): string
    {
        $email = trim($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return $email;
        [$local, $domain] = explode('@', $email, 2);
        $maskedLocal = (strlen($local) <= $showBefore + 1) ? str_repeat('*', max(1, strlen($local) - $showBefore)) . substr($local, -$showBefore) : substr($local, 0, $showBefore) . str_repeat('*', strlen($local) - ($showBefore + $showAfterDomain)) . substr($local, -$showAfterDomain);
        return $maskedLocal . '@' . $domain;
    }
}

if (!function_exists('mask_pix_random')) {
    function mask_pix_random(string $key): string
    {
        // random key (UUID-like or base64). Show first 6 and last 4 for display.
        $k = trim($key);
        if (strlen($k) <= 12)
            return $k;
        return substr($k, 0, 6) . '...' . substr($k, -4);
    }
}

/*
 * -----------------------
 * PIS / PASEP (11 digits)
 * -----------------------
 */
if (!function_exists('mask_pis')) {
    function mask_pis(string $pis): string
    {
        $n = only_digits($pis);
        if (strlen($n) !== 11)
            return $pis;
        return preg_replace('/(\d{3})(\d{5})(\d{2})(\d{1})/', '$1.$2.$3-$4', $n);
    }
}

/*
 * -----------------------
 * Título de Eleitor (12 digits)
 * -----------------------
 */
if (!function_exists('mask_titulo_eleitor')) {
    function mask_titulo_eleitor(string $t): string
    {
        $n = only_digits($t);
        if (strlen($n) !== 12)
            return $t;
        return preg_replace('/(\d{4})(\d{4})(\d{4})/', '$1 $2 $3', $n);
    }
}

/*
 * -----------------------
 * RENAVAM (11 digits, display with leading zeros sometimes)
 * -----------------------
 */
if (!function_exists('mask_renavam')) {
    function mask_renavam(string $r): string
    {
        $n = only_digits($r);
        // Standard visual: 11 digits, sometimes shown as X.X.XXXXXXX-X (but simpler:)
        if (strlen($n) === 11) {
            return preg_replace('/(\d{1})(\d{3})(\d{6})(\d{1})/', '$1.$2.$3-$4', $n);
        }
        return $r;
    }
}

/*
 * -----------------------
 * NIS / NIT (11 digits) - NIS (PIS) often 11 digits
 * -----------------------
 */
if (!function_exists('mask_nis')) {
    function mask_nis(string $nis): string
    {
        $n = only_digits($nis);
        if (strlen($n) !== 11)
            return $nis;
        return preg_replace('/(\d{3})(\d{5})(\d{2})(\d{1})/', '$1.$2.$3-$4', $n);
    }
}
if (!function_exists('mask_nit')) {
    function mask_nit(string $nit): string
    {
        return mask_nis($nit);
    }
}

/*
 * -----------------------
 * CNES (7 digits)
 * -----------------------
 */
if (!function_exists('mask_cnes')) {
    function mask_cnes(string $cnes): string
    {
        $n = only_digits($cnes);
        if (strlen($n) !== 7)
            return $cnes;
        return preg_replace('/(\d{2})(\d{2})(\d{3})/', '$1.$2.$3', $n);
    }
}

/*
 * -----------------------
 * ISSN (####-####) / ISBN-10 / ISBN-13
 * -----------------------
 */
if (!function_exists('mask_issn')) {
    function mask_issn(string $issn): string
    {
        $n = preg_replace('/[^0-9Xx]/', '', $issn);
        if (strlen($n) !== 8)
            return $issn;
        return substr($n, 0, 4) . '-' . substr($n, 4, 4);
    }
}

if (!function_exists('mask_isbn')) {
    function mask_isbn(string $isbn): string
    {
        // remove non digits or X
        $n = preg_replace('/[^0-9Xx]/', '', $isbn);
        if (strlen($n) === 10) {
            // ISBN-10: common grouping is variable; simplest: 1-234-56789-X (we'll output 1-234-56789-X)
            return substr($n, 0, 1) . '-' . substr($n, 1, 3) . '-' . substr($n, 4, 5) . '-' . substr($n, 9, 1);
        }
        if (strlen($n) === 13) {
            // ISBN-13: 978-1-2345-6789-7 (simple grouping)
            return substr($n, 0, 3) . '-' . substr($n, 3, 1) . '-' . substr($n, 4, 4) . '-' . substr($n, 8, 4) . '-' . substr($n, 12, 1);
        }
        return $isbn;
    }
}

/*
 * -----------------------
 * MAC Address (HH:HH:HH:HH:HH:HH)
 * -----------------------
 */
if (!function_exists('mask_mac')) {
    function mask_mac(string $mac, string $sep = ':'): string
    {
        $h = strtoupper(preg_replace('/[^A-Fa-f0-9]/', '', $mac));
        if (strlen($h) !== 12)
            return $mac;
        $parts = str_split($h, 2);
        return implode($sep, $parts);
    }
}

/*
 * -----------------------
 * IP formatting / validation
 * -----------------------
 */
if (!function_exists('is_valid_ipv4')) {
    function is_valid_ipv4(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }
}
if (!function_exists('is_valid_ipv6')) {
    function is_valid_ipv6(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}
if (!function_exists('mask_ipv4')) {
    function mask_ipv4(string $ip): ?string
    {
        // returns normalized IPv4 or null
        return is_valid_ipv4($ip) ? $ip : null;
    }
}
if (!function_exists('mask_ipv6')) {
    function mask_ipv6(string $ip): ?string
    {
        return is_valid_ipv6($ip) ? $ip : null;
    }
}

/*
 * -----------------------
 * Cartão SUS / CNS (Cartão Nacional de Saúde) - 15 digits
 * -----------------------
 */
if (!function_exists('mask_cns')) {
    function mask_cns(string $cns): string
    {
        $n = only_digits($cns);
        if (strlen($n) !== 15)
            return $cns;
        // Common display: 000 0000 0000 000
        return preg_replace('/(\d{3})(\d{4})(\d{4})(\d{4})/', '$1 $2 $3 $4', $n);
    }
}

/*
 * -----------------------
 * EAN / GTIN
 * - EAN-8: 8 digits
 * - EAN-13 / GTIN-13: 13 digits
 * - GTIN-14: 14 digits
 * -----------------------
 */
if (!function_exists('mask_ean8')) {
    function mask_ean8(string $v): string
    {
        $n = only_digits($v);
        if (strlen($n) !== 8)
            return $v;
        return preg_replace('/(\d{4})(\d{4})/', '$1 $2', $n);
    }
}
if (!function_exists('mask_ean13')) {
    function mask_ean13(string $v): string
    {
        $n = only_digits($v);
        if (strlen($n) !== 13)
            return $v;
        return preg_replace('/(\d{3})(\d{4})(\d{4})(\d{2})/', '$1 $2 $3 $4', $n);
    }
}
if (!function_exists('mask_gtin14')) {
    function mask_gtin14(string $v): string
    {
        $n = only_digits($v);
        if (strlen($n) !== 14)
            return $v;
        return preg_replace('/(\d{1})(\d{6})(\d{6})(\d{1})/', '$1 $2 $3 $4', $n);
    }
}

/*
 * -----------------------
 * PIX composite helper: mask key for display (generic)
 * -----------------------
 */
if (!function_exists('mask_pix_key_for_display')) {
    /**
     * Given any PIX key (cpf/cnpj/phone/email/random), return a masked display version.
     * It detects type and masks accordingly.
     */
    function mask_pix_key_for_display(string $key): string
    {
        $k = trim($key);

        // email?
        if (filter_var($k, FILTER_VALIDATE_EMAIL)) {
            return mask_pix_email($k);
        }

        // digits only?
        $digits = only_digits($k);

        // CPF/CNPJ/NIS/PIS possibility
        $len = strlen($digits);
        if ($len === 11) {
            // CPF or PIS/NIS/NIT — prefer CPF mask
            return maskCpf($digits);
        }
        if ($len === 14) {
            // CNPJ
            return maskCnpj($digits);
        }
        // phone (>=10)
        if ($len >= 10 && $len <= 15) {
            return mask_pix_phone($k);
        }

        // otherwise show truncated random key
        return mask_pix_random($k);
    }
}