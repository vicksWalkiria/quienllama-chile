<?php

namespace App\Services;

class AreaCodeService
{
    /**
     * Catálogo completo de Códigos de Área Oficiales de la República de Chile (SUBTEL).
     */
    protected static array $codes = [
        // Región Metropolitana (Santiago)
        '2' => ['city' => 'Santiago y Gran Santiago', 'region' => 'Región Metropolitana', 'volume' => 45000, 'is_major' => true],

        // Región de Valparaíso
        '32' => ['city' => 'Valparaíso / Viña del Mar', 'region' => 'Valparaíso', 'volume' => 19000, 'is_major' => true],
        '33' => ['city' => 'Quillota / La Calera', 'region' => 'Valparaíso', 'volume' => 4200, 'is_major' => false],
        '34' => ['city' => 'Los Andes / San Felipe', 'region' => 'Valparaíso', 'volume' => 4800, 'is_major' => false],
        '35' => ['city' => 'San Antonio / Litoral Central', 'region' => 'Valparaíso', 'volume' => 3900, 'is_major' => false],

        // Biobío y Ñuble
        '41' => ['city' => 'Concepción / Talcahuano', 'region' => 'Biobío', 'volume' => 17500, 'is_major' => true],
        '42' => ['city' => 'Chillán / San Carlos', 'region' => 'Ñuble', 'volume' => 6100, 'is_major' => true],
        '43' => ['city' => 'Los Ángeles / Mulchén', 'region' => 'Biobío', 'volume' => 5200, 'is_major' => false],

        // Araucanía, Los Ríos, Los Lagos
        '45' => ['city' => 'Temuco / Villarrica / Pucón', 'region' => 'La Araucanía', 'volume' => 11200, 'is_major' => true],
        '63' => ['city' => 'Valdivia / La Unión', 'region' => 'Los Ríos', 'volume' => 5900, 'is_major' => true],
        '64' => ['city' => 'Osorno / Purranque', 'region' => 'Los Lagos', 'volume' => 5400, 'is_major' => false],
        '65' => ['city' => 'Puerto Montt / Puerto Varas / Chiloé', 'region' => 'Los Lagos', 'volume' => 8800, 'is_major' => true],

        // Norte de Chile
        '58' => ['city' => 'Arica / Camarones', 'region' => 'Arica y Parinacota', 'volume' => 4900, 'is_major' => true],
        '57' => ['city' => 'Iquique / Alto Hospicio', 'region' => 'Tarapacá', 'volume' => 7100, 'is_major' => true],
        '55' => ['city' => 'Antofagasta / Calama', 'region' => 'Antofagasta', 'volume' => 12800, 'is_major' => true],
        '52' => ['city' => 'Copiapó / Vallenar', 'region' => 'Atacama', 'volume' => 4500, 'is_major' => true],
        '51' => ['city' => 'La Serena / Coquimbo', 'region' => 'Coquimbo', 'volume' => 9600, 'is_major' => true],
        '53' => ['city' => 'Ovalle / Illapel', 'region' => 'Coquimbo', 'volume' => 3100, 'is_major' => false],

        // Zona Centro-Sur (O'Higgins y Maule)
        '72' => ['city' => 'Rancagua / San Fernando', 'region' => 'O\'Higgins', 'volume' => 8900, 'is_major' => true],
        '75' => ['city' => 'Curicó / Molina', 'region' => 'Maule', 'volume' => 4400, 'is_major' => false],
        '71' => ['city' => 'Talca / Constitución', 'region' => 'Maule', 'volume' => 7700, 'is_major' => true],
        '73' => ['city' => 'Linares / Cauquenes', 'region' => 'Maule', 'volume' => 3800, 'is_major' => false],

        // Zona Austral
        '67' => ['city' => 'Coyhaique / Puerto Aysén', 'region' => 'Aysén', 'volume' => 2100, 'is_major' => true],
        '61' => ['city' => 'Punta Arenas / Puerto Natales', 'region' => 'Magallanes', 'volume' => 3700, 'is_major' => true],

        // Especiales y VoIP
        '44' => ['city' => 'Telefonía IP / Voz sobre IP (VoIP)', 'region' => 'Nacional VoIP', 'volume' => 6500, 'is_major' => false],
        '800' => ['city' => 'Línea Gratuita Nacional (800)', 'region' => 'Nacional', 'volume' => 2200, 'is_major' => false],
        '600' => ['city' => 'Línea de Tarifa Compartida (600)', 'region' => 'Nacional', 'volume' => 3100, 'is_major' => false],
        '809' => ['city' => 'Llamadas Masivas Comerciales / Spam (809)', 'region' => 'Nacional Telemarketing', 'volume' => 4800, 'is_major' => false],
    ];

    /**
     * Retorna todos los códigos disponibles.
     */
    public static function all(): array
    {
        return self::$codes;
    }

    public static function getAll(): array
    {
        return self::all();
    }

    /**
     * Retorna los códigos principales (capitales regionales con mayor volumen).
     */
    public static function major(): array
    {
        return array_filter(self::$codes, fn($item) => $item['is_major']);
    }

    /**
     * Busca información de un código de área específico.
     */
    public static function find(string $code): ?array
    {
        $code = ltrim($code, '0');
        if (!isset(self::$codes[$code])) {
            return null;
        }

        $info = self::$codes[$code];
        $info['code'] = $code;
        return $info;
    }

    /**
     * Retorna los códigos agrupados por Región.
     */
    public static function byRegion(): array
    {
        $grouped = [];
        foreach (self::$codes as $code => $info) {
            $item = $info;
            $item['code'] = $code;
            $grouped[$info['region']][$code] = $item;
        }
        return $grouped;
    }

    public static function getGroupedByRegion(): array
    {
        return self::byRegion();
    }

    /**
     * Genera un listado de prefijos ordenados por volumen de consultas.
     */
    public static function topByVolume(int $limit = 8): array
    {
        $sorted = self::$codes;
        uasort($sorted, fn($a, $b) => $b['volume'] <=> $a['volume']);
        $result = [];
        foreach (array_slice($sorted, 0, $limit, true) as $code => $info) {
            $info['code'] = $code;
            $result[$code] = $info;
        }
        return $result;
    }

    public static function getTopPopular(int $limit = 16): array
    {
        return self::topByVolume($limit);
    }
}
