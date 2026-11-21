<?php

namespace App\Services;

class ChilePhoneHelper
{
    /**
     * Códigos de área y prefijos especiales en Chile según SUBTEL.
     * Ordenados por longitud decreciente para matchear correctamente.
     */
    protected static array $areaCodes = [
        // Especiales, Masivos y VoIP (3 y 2 dígitos)
        '800' => 'Línea Gratuita Nacional (Cobro Revertido)',
        '600' => 'Atención Masiva / Servicios Contratados (600)',
        '606' => 'Servicios Complementarios / Atención Comercial (606)',
        '609' => 'Servicios Complementarios / Atención Comercial (609)',
        '809' => 'Llamadas Masivas Comerciales / Spam (809)',
        '702' => 'Comunicaciones Masivas del Estado (702)',
        '44'  => 'Telefonía IP / Voz sobre IP (VoIP Nacional)',

        // Región Metropolitana (1 dígito de código de área + 8 locales)
        '2'   => 'Santiago y Región Metropolitana',

        // 2 dígitos - Regiones del Norte
        '58'  => 'Arica y Parinacota (Arica)',
        '57'  => 'Tarapacá (Iquique y Alto Hospicio)',
        '55'  => 'Antofagasta (Antofagasta, Calama y Tocopilla)',
        '52'  => 'Atacama (Copiapó y Vallenar)',
        '51'  => 'Coquimbo (La Serena y Coquimbo)',
        '53'  => 'Coquimbo (Ovalle e Illapel)',

        // 2 dígitos - Regiones Centro
        '32'  => 'Valparaíso (Valparaíso, Viña del Mar y Concón)',
        '33'  => 'Valparaíso (Quillota y La Calera)',
        '34'  => 'Valparaíso (Los Andes y San Felipe)',
        '35'  => 'Valparaíso (San Antonio y Litoral Central)',
        '72'  => 'O\'Higgins (Rancagua y San Fernando)',
        '75'  => 'Maule (Curicó y Molina)',
        '71'  => 'Maule (Talca y Constitución)',
        '73'  => 'Maule (Linares y Cauquenes)',

        // 2 dígitos - Regiones Sur y Austral
        '42'  => 'Ñuble (Chillán y San Carlos)',
        '41'  => 'Biobío (Gran Concepción y Talcahuano)',
        '43'  => 'Biobío (Los Ángeles y cordillera)',
        '45'  => 'La Araucanía (Temuco, Villarrica y Pucón)',
        '63'  => 'Los Ríos (Valdivia y La Unión)',
        '64'  => 'Los Lagos (Osorno y Purranque)',
        '65'  => 'Los Lagos (Puerto Montt, Puerto Varas y Chiloé)',
        '67'  => 'Aysén (Coyhaique y Puerto Aysén)',
        '61'  => 'Magallanes y Antártica Chilena (Punta Arenas)',
    ];

    /**
     * Normaliza cualquier formato chileno ingresado por un usuario:
     * - 9 dígitos canónicos (móviles 9, fijos regionales, VoIP 44, 800, 809, 702 y 600 cortos)
     * - 10 dígitos canónicos para servicios especiales 600 / 606 / 609 (ej: 600 600 4000, 600 006 0123)
     */
    public static function normalize(?string $input): ?string
    {
        if (empty($input)) {
            return null;
        }

        $clean = preg_replace('/[^0-9]/', '', $input);

        if (empty($clean)) {
            return null;
        }

        // Prefijo internacional con doble cero '0056'
        if (str_starts_with($clean, '0056') && strlen($clean) >= 13) {
            $clean = substr($clean, 4);
        }

        // Si empieza con prefijo internacional de Chile '56' (11 dígitos para 9 nac., o 12 dígitos para 600/606/609)
        if (str_starts_with($clean, '56') && strlen($clean) > 9) {
            $candidate = substr($clean, 2);
            if (in_array(strlen($candidate), [9, 10], true) && self::isValidPrefix($candidate)) {
                return $candidate;
            }
            $clean = $candidate;
        }

        // Si empieza por '0' seguido de 10 dígitos de servicios 600/606/609 (11 en total)
        if (str_starts_with($clean, '0') && strlen($clean) === 11 && in_array(substr($clean, 1, 3), ['600', '606', '609'], true)) {
            $clean = substr($clean, 1);
        }

        // Si empieza por '09' o '0' simple seguido de 9 dígitos nacionales
        if (str_starts_with($clean, '0') && strlen($clean) === 10) {
            $clean = substr($clean, 1);
        }

        // Servicios especiales de 10 dígitos en Chile: 600, 606 y 609
        if (strlen($clean) === 10) {
            return self::isValidPrefix($clean) ? $clean : null;
        }

        // Plan unificado nacional de 9 dígitos (incluye 800, 809, 702, 44, móviles y fijos)
        if (strlen($clean) === 9) {
            return self::isValidPrefix($clean) ? $clean : null;
        }

        // Si el usuario ingresó 8 dígitos (celular antiguo sin el 9 o fijo Santiago sin el 2)
        if (strlen($clean) === 8) {
            if (in_array($clean[0], ['4', '5', '6', '7', '8', '9'], true)) {
                return '9' . $clean;
            }
            if (in_array($clean[0], ['2', '3'], true)) {
                return '2' . $clean;
            }
        }

        return null;
    }

    /**
     * Verifica si los dígitos inician con un prefijo válido en Chile (9 o 10 dígitos según serie SUBTEL).
     */
    public static function isValidPrefix(string $clean): bool
    {
        $len = strlen($clean);

        if ($len === 10) {
            return in_array(substr($clean, 0, 3), ['600', '606', '609'], true);
        }

        if ($len !== 9) {
            return false;
        }

        // Móvil (9) o Fijo Santiago (2)
        if (str_starts_with($clean, '9') || str_starts_with($clean, '2')) {
            return true;
        }

        // Especiales y masivos de 9 dígitos (800, 600, 809, 702)
        $p3 = substr($clean, 0, 3);
        if (in_array($p3, ['800', '600', '809', '702'], true)) {
            return true;
        }

        // VoIP (44) o Fijos regionales
        $p2 = substr($clean, 0, 2);
        return isset(self::$areaCodes[$p2]);
    }

    /**
     * Formatea el número canónico de 9 o 10 dígitos para presentación visual clara.
     */
    public static function format(string $number, bool $withCountryCode = false): string
    {
        $clean = self::normalize($number) ?? preg_replace('/[^0-9]/', '', $number);
        $len = strlen($clean);
        $prefix = $withCountryCode ? '+56 ' : '';

        // Servicios de 10 dígitos (600 / 606 / 609): 600 600 4000 o 600 006 0123
        if ($len === 10 && in_array(substr($clean, 0, 3), ['600', '606', '609'], true)) {
            return $prefix . substr($clean, 0, 3) . ' ' . substr($clean, 3, 3) . ' ' . substr($clean, 6, 4);
        }

        if ($len !== 9) {
            return $clean !== '' ? $clean : $number;
        }

        // Celular: 9 XXXX XXXX
        if (str_starts_with($clean, '9')) {
            return $prefix . '9 ' . substr($clean, 1, 4) . ' ' . substr($clean, 5, 4);
        }

        // Fijo Santiago: 2 2XXX XXXX
        if (str_starts_with($clean, '2')) {
            return $prefix . '2 ' . substr($clean, 1, 4) . ' ' . substr($clean, 5, 4);
        }

        // Especiales de 9 dígitos (800 / 600 / 809 / 702): 809 XXX XXX / 702 XXX XXX
        if (in_array(substr($clean, 0, 3), ['800', '600', '809', '702'], true)) {
            return $prefix . substr($clean, 0, 3) . ' ' . substr($clean, 3, 3) . ' ' . substr($clean, 6, 3);
        }

        // Códigos de 2 dígitos regionales y VoIP 44: 32 2XX XXXX / 44 2XX XXXX
        $area2 = substr($clean, 0, 2);
        if (isset(self::$areaCodes[$area2])) {
            return $prefix . $area2 . ' ' . substr($clean, 2, 3) . ' ' . substr($clean, 5, 4);
        }

        return $prefix . substr($clean, 0, 1) . ' ' . substr($clean, 1, 4) . ' ' . substr($clean, 5, 4);
    }

    /**
     * Detecta el código de área o prefijo especial y la localidad/servicio correspondiente.
     */
    public static function getAreaInfo(string $number): array
    {
        $digits = self::normalize($number) ?? preg_replace('/[^0-9]/', '', $number);

        // Especiales de 3 dígitos (800, 600, 606, 609, 809, 702) — evaluar antes de fijos 2 dígitos (ej. 60X vs 61/63)
        $p3 = substr($digits, 0, 3);
        if (isset(self::$areaCodes[$p3])) {
            return [
                'code' => $p3,
                'location' => self::$areaCodes[$p3],
                'city' => self::$areaCodes[$p3],
                'is_mobile' => false,
                'is_special' => true,
            ];
        }

        // Celular
        if (str_starts_with($digits, '9')) {
            return [
                'code' => '9',
                'location' => 'Chile (Red Celular Móvil)',
                'city' => 'Chile (Red Celular Móvil)',
                'is_mobile' => true,
                'is_special' => false,
            ];
        }

        // VoIP (44)
        if (str_starts_with($digits, '44')) {
            return [
                'code' => '44',
                'location' => self::$areaCodes['44'],
                'city' => 'Telefonía IP Nacional',
                'is_mobile' => false,
                'is_special' => true,
            ];
        }

        // Santiago (2)
        if (str_starts_with($digits, '2')) {
            return [
                'code' => '2',
                'location' => self::$areaCodes['2'],
                'city' => self::$areaCodes['2'],
                'is_mobile' => false,
                'is_special' => false,
            ];
        }

        // Fijos 2 dígitos
        $p2 = substr($digits, 0, 2);
        if (isset(self::$areaCodes[$p2])) {
            return [
                'code' => $p2,
                'location' => self::$areaCodes[$p2],
                'city' => self::$areaCodes[$p2],
                'is_mobile' => false,
                'is_special' => false,
            ];
        }

        return [
            'code' => null,
            'location' => 'Chile',
            'city' => 'Chile',
            'is_mobile' => false,
            'is_special' => false,
        ];
    }

    /**
     * Información detallada de marcado para la ficha.
     */
    public static function getDialingInfo(string $number): array
    {
        $clean = self::normalize($number) ?? preg_replace('/[^0-9]/', '', $number);
        $area = self::getAreaInfo($clean);

        return [
            'national' => $clean,
            'international' => '+56 ' . self::format($clean),
            'whatsapp' => 'https://wa.me/56' . $clean,
            'formatted' => self::format($clean),
            'location' => $area['location'],
            'is_mobile' => $area['is_mobile'],
            'is_special' => $area['is_special'],
            'digits_count' => strlen($clean),
        ];
    }

    /**
     * Retorna detalles enriquecidos del número (tipo de línea, región, ciudad).
     */
    public static function getDetails(string $number): array
    {
        $clean = self::normalize($number) ?? preg_replace('/[^0-9]/', '', $number);
        $area = self::getAreaInfo($clean);
        $code = $area['code'];

        $type = match ($code) {
            '9' => 'Celular / Telefonía Móvil Digital',
            '809' => 'Llamadas Masivas Comerciales / Spam (Prefijo 809 SUBTEL)',
            '600' => 'Atención Masiva / Servicios Contratados (Prefijo 600 SUBTEL)',
            '606', '609' => 'Servicios Complementarios Comerciales (' . $code . ' SUBTEL)',
            '702' => 'Comunicaciones Masivas del Estado (Prefijo 702 SUBTEL)',
            '800' => 'Línea Gratuita Nacional / Cobro Revertido (800)',
            '44' => 'Telefonía IP / Voz sobre Internet (VoIP Nacional 44)',
            default => $area['is_special'] ? 'Servicio Especial / VoIP SUBTEL' : 'Telefonía Fija Local SUBTEL',
        };

        return [
            'type'         => $type,
            'location'     => $area['location'],
            'region'       => $area['location'],
            'city'         => $area['location'],
            'area_code'    => $code,
            'is_mobile'    => $area['is_mobile'],
            'is_special'   => $area['is_special'],
            'digits_count' => strlen($clean),
        ];
    }

    /**
     * Valida si un número cumple el estándar telefónico chileno (9 dígitos nacionales o 10 en serie 600/606/609).
     */
    public static function isValid(string $number): bool
    {
        $clean = self::normalize($number);
        return $clean !== null && in_array(strlen($clean), [9, 10], true) && ctype_digit($clean);
    }

    /**
     * Devuelve el catálogo completo de prefijos ordenado por región.
     */
    public static function getAllAreaCodes(): array
    {
        return self::$areaCodes;
    }
}
