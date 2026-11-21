<?php

namespace App\Services;

class AreaCodeService
{
    /**
     * Catálogo completo de Códigos de Área y Prefijos Oficiales de la República de Chile (SUBTEL).
     */
    protected static array $codes = [
        // Región Metropolitana (Santiago) y Red Móvil Nacional
        '2' => [
            'city' => 'Santiago y Gran Santiago',
            'region' => 'Región Metropolitana',
            'volume' => 45000,
            'is_major' => true,
            'digits' => 9,
        ],
        '9' => [
            'city' => 'Red Celular Móvil Nacional (9)',
            'region' => 'Telefonía Móvil Nacional',
            'volume' => 52000,
            'is_major' => true,
            'digits' => 9,
            'normativa_title' => 'Plan Fundamental de Numeración Móvil y Portabilidad (Prefijo 9)',
            'normativa' => 'Toda la telefonía móvil digital en Chile utiliza 9 dígitos iniciados por el dígito 9 (+56 9 XXXX XXXX). Debido a la Ley N° 20.471 de Portabilidad Numérica Completa, el bloque SUBTEL indica la concesionaria de origen del rango, pudiendo la línea encontrarse actualmente portada hacia otro operador móvil.',
        ],

        // Región de Valparaíso
        '32' => ['city' => 'Valparaíso / Viña del Mar', 'region' => 'Valparaíso', 'volume' => 19000, 'is_major' => true, 'digits' => 9],
        '33' => ['city' => 'Quillota / La Calera', 'region' => 'Valparaíso', 'volume' => 4200, 'is_major' => false, 'digits' => 9],
        '34' => ['city' => 'Los Andes / San Felipe', 'region' => 'Valparaíso', 'volume' => 4800, 'is_major' => false, 'digits' => 9],
        '35' => ['city' => 'San Antonio / Litoral Central', 'region' => 'Valparaíso', 'volume' => 3900, 'is_major' => false, 'digits' => 9],

        // Biobío y Ñuble
        '41' => ['city' => 'Concepción / Talcahuano', 'region' => 'Biobío', 'volume' => 17500, 'is_major' => true, 'digits' => 9],
        '42' => ['city' => 'Chillán / San Carlos', 'region' => 'Ñuble', 'volume' => 6100, 'is_major' => true, 'digits' => 9],
        '43' => ['city' => 'Los Ángeles / Mulchén', 'region' => 'Biobío', 'volume' => 5200, 'is_major' => false, 'digits' => 9],

        // Araucanía, Los Ríos, Los Lagos
        '45' => ['city' => 'Temuco / Villarrica / Pucón', 'region' => 'La Araucanía', 'volume' => 11200, 'is_major' => true, 'digits' => 9],
        '63' => ['city' => 'Valdivia / La Unión', 'region' => 'Los Ríos', 'volume' => 5900, 'is_major' => true, 'digits' => 9],
        '64' => ['city' => 'Osorno / Purranque', 'region' => 'Los Lagos', 'volume' => 5400, 'is_major' => false, 'digits' => 9],
        '65' => ['city' => 'Puerto Montt / Puerto Varas / Chiloé', 'region' => 'Los Lagos', 'volume' => 8800, 'is_major' => true, 'digits' => 9],

        // Norte de Chile
        '58' => ['city' => 'Arica / Camarones', 'region' => 'Arica y Parinacota', 'volume' => 4900, 'is_major' => true, 'digits' => 9],
        '57' => ['city' => 'Iquique / Alto Hospicio', 'region' => 'Tarapacá', 'volume' => 7100, 'is_major' => true, 'digits' => 9],
        '55' => ['city' => 'Antofagasta / Calama', 'region' => 'Antofagasta', 'volume' => 12800, 'is_major' => true, 'digits' => 9],
        '52' => ['city' => 'Copiapó / Vallenar', 'region' => 'Atacama', 'volume' => 4500, 'is_major' => true, 'digits' => 9],
        '51' => ['city' => 'La Serena / Coquimbo', 'region' => 'Coquimbo', 'volume' => 9600, 'is_major' => true, 'digits' => 9],
        '53' => ['city' => 'Ovalle / Illapel', 'region' => 'Coquimbo', 'volume' => 3100, 'is_major' => false, 'digits' => 9],

        // Zona Centro-Sur (O'Higgins y Maule)
        '72' => ['city' => 'Rancagua / San Fernando', 'region' => 'O\'Higgins', 'volume' => 8900, 'is_major' => true, 'digits' => 9],
        '75' => ['city' => 'Curicó / Molina', 'region' => 'Maule', 'volume' => 4400, 'is_major' => false, 'digits' => 9],
        '71' => ['city' => 'Talca / Constitución', 'region' => 'Maule', 'volume' => 7700, 'is_major' => true, 'digits' => 9],
        '73' => ['city' => 'Linares / Cauquenes', 'region' => 'Maule', 'volume' => 3800, 'is_major' => false, 'digits' => 9],

        // Zona Austral
        '67' => ['city' => 'Coyhaique / Puerto Aysén', 'region' => 'Aysén', 'volume' => 2100, 'is_major' => true, 'digits' => 9],
        '61' => ['city' => 'Punta Arenas / Puerto Natales', 'region' => 'Magallanes', 'volume' => 3700, 'is_major' => true, 'digits' => 9],

        // Prefijos Especiales, Comunicaciones Masivas y VoIP (Normativa SUBTEL)
        '809' => [
            'city' => 'Llamadas Masivas Comerciales / Spam (809)',
            'region' => 'Servicios Especiales, Masivos y VoIP (SUBTEL)',
            'volume' => 14800,
            'is_major' => true,
            'digits' => 9,
            'is_special' => true,
            'tone' => 'danger',
            'normativa_badge' => 'Telemarketing No Solicitado · Bloqueable',
            'normativa_title' => 'Resolución Exenta SUBTEL sobre Numeración 809 (Telemarketing No Solicitado)',
            'normativa' => 'Conforme a la Resolución Exenta de la Subsecretaría de Telecomunicaciones (SUBTEL), el prefijo 809 (9 dígitos: 809 XXX XXX) es de uso obligatorio para todas las llamadas comerciales masivas o automatizadas NO solicitadas (ventas en frío, ofertas de portabilidad, seguros o créditos sin vínculo previo). Puedes bloquear todo el prefijo 809 en tu teléfono o inscribir tu número en «No Molestar» del SERNAC.',
        ],
        '600' => [
            'city' => 'Atención Masiva / Servicios Contratados (600)',
            'region' => 'Servicios Especiales, Masivos y VoIP (SUBTEL)',
            'volume' => 13600,
            'is_major' => true,
            'digits' => 10,
            'is_special' => true,
            'tone' => 'warning',
            'normativa_badge' => 'Solo Servicios Contratados · Prohibida Venta en Frío',
            'normativa_title' => 'Normativa SUBTEL para Numeración 600 (10 dígitos · Servicios Contratados)',
            'normativa' => 'En Chile los números 600 constan de 10 dígitos (600 XXX XXXX) y, bajo la regulación vigente de llamadas masivas de SUBTEL, solo pueden utilizarse para atención al cliente y comunicaciones relativas a servicios previamente contratados (confirmación de citas médicas, avisos bancarios, soporte técnico o cobranza regulada). Está prohibido emplear líneas 600 para ofrecer o vender nuevos productos no solicitados.',
        ],
        '702' => [
            'city' => 'Comunicaciones Masivas del Estado (702)',
            'region' => 'Servicios Especiales, Masivos y VoIP (SUBTEL)',
            'volume' => 6400,
            'is_major' => true,
            'digits' => 9,
            'is_special' => true,
            'tone' => 'info',
            'normativa_badge' => 'Exclusivo Órganos del Estado de Chile',
            'normativa_title' => 'Resolución Exenta SUBTEL: Prefijo 702 para Órganos del Estado',
            'normativa' => 'El nuevo prefijo oficial 702 (9 dígitos: 702 XXX XXX) fue creado por la Subsecretaría de Telecomunicaciones (SUBTEL) exclusivamente para comunicaciones masivas o automatizadas originadas por órganos de la Administración del Estado, ministerios, servicios de salud, hospitales públicos y municipalidades. Ningún banco, casa comercial ni empresa privada está autorizado a llamar desde el 702: verifica siempre que no exista suplantación.',
        ],
        '800' => [
            'city' => 'Línea Gratuita Nacional (800)',
            'region' => 'Servicios Especiales, Masivos y VoIP (SUBTEL)',
            'volume' => 4200,
            'is_major' => false,
            'digits' => 9,
            'is_special' => true,
            'tone' => 'info',
            'normativa_badge' => 'Cobro Revertido Automático · Sin Costo',
            'normativa_title' => 'Servicio Complementario de Cobro Revertido Automático (Prefijo 800)',
            'normativa' => 'La numeración 800 (9 dígitos: 800 XXX XXX) corresponde a líneas de cobro revertido automático fiscalizadas por SUBTEL: llamar a un número 800 no tiene costo para el usuario desde teléfonos fijos ni móviles dentro de Chile, asumiendo la empresa receptora la totalidad de la tarifa.',
        ],
        '44' => [
            'city' => 'Telefonía IP / Voz sobre IP (VoIP)',
            'region' => 'Servicios Especiales, Masivos y VoIP (SUBTEL)',
            'volume' => 7900,
            'is_major' => false,
            'digits' => 9,
            'is_special' => true,
            'tone' => 'warning',
            'normativa_badge' => 'Numeración No Geográfica VoIP Nacional',
            'normativa_title' => 'Numeración de Telefonía sobre Internet / VoIP Nacional (Prefijo 44)',
            'normativa' => 'El código 44 (9 dígitos: 44 XXX XXXX) identifica concesionarias de Telefonía IP (Voz sobre Internet) con cobertura virtual en todo Chile. Muchos operadores VoIP arriendan troncales SIP mayoristas a call centers de cobranza y telemarketing; si recibes ofertas no solicitadas desde un 44 en vez de un 809, puedes denunciar el incumplimiento ante SUBTEL y SERNAC.',
        ],
        '606' => [
            'city' => 'Servicios Complementarios Comerciales (606)',
            'region' => 'Servicios Especiales, Masivos y VoIP (SUBTEL)',
            'volume' => 1400,
            'is_major' => false,
            'digits' => 10,
            'is_special' => true,
            'tone' => 'info',
            'normativa_badge' => 'Serie Especial de 10 Dígitos (606)',
            'normativa_title' => 'Numeración de Servicios Complementarios SUBTEL (Prefijo 606)',
            'normativa' => 'Bloques de 10 dígitos (606 XXX XXXX) asignados por SUBTEL a concesionarias de telecomunicaciones para servicios complementarios de red y atención corporativa.',
        ],
        '609' => [
            'city' => 'Servicios Complementarios Comerciales (609)',
            'region' => 'Servicios Especiales, Masivos y VoIP (SUBTEL)',
            'volume' => 1300,
            'is_major' => false,
            'digits' => 10,
            'is_special' => true,
            'tone' => 'info',
            'normativa_badge' => 'Serie Especial de 10 Dígitos (609)',
            'normativa_title' => 'Numeración de Servicios Complementarios SUBTEL (Prefijo 609)',
            'normativa' => 'Bloques de 10 dígitos (609 XXX XXXX) asignados por SUBTEL a concesionarias de telecomunicaciones para servicios complementarios y enrutamiento corporativo.',
        ],
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
     * Retorna los códigos principales (capitales regionales y prefijos SUBTEL clave con mayor volumen).
     */
    public static function major(): array
    {
        return array_filter(self::$codes, fn($item) => !empty($item['is_major']));
    }

    /**
     * Busca información de un código de área o prefijo específico.
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
     * Devuelve el aviso regulatorio SUBTEL aplicable a un prefijo o bloque VoIP/masivo.
     */
    public static function getRegulatoryNotice(?string $code, bool $isVoipOrMasivo = false): ?array
    {
        if ($code && isset(self::$codes[$code]) && !empty(self::$codes[$code]['normativa']) && in_array($code, ['809', '600', '702', '800', '44', '606', '609'], true)) {
            $item = self::$codes[$code];
            return [
                'code' => $code,
                'tone' => $item['tone'] ?? 'info',
                'badge' => $item['normativa_badge'] ?? 'Normativa SUBTEL',
                'title' => $item['normativa_title'] ?? 'Información Regulatoria SUBTEL',
                'text' => $item['normativa'],
            ];
        }

        if ($isVoipOrMasivo) {
            return [
                'code' => $code ?: 'VoIP',
                'tone' => 'warning',
                'badge' => 'Concesionaria VoIP / Tráfico Masivo',
                'title' => 'Línea asignada a Operador VoIP o de Comunicaciones Masivas (SUBTEL)',
                'text' => 'Según el registro oficial de numeración de SUBTEL, este bloque pertenece a una concesionaria con infraestructura de Voz sobre IP (VoIP) o servicios masivos, frecuentemente subasignada mediante troncales SIP a plataformas de atención al cliente, cobranza o contact centers. Verifica siempre la identidad de quien llama antes de entregar datos personales.',
            ];
        }

        return null;
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
