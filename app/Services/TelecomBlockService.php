<?php

namespace App\Services;

use PDO;
use Throwable;

class TelecomBlockService
{
    protected static ?PDO $pdo = null;
    protected static bool $attempted = false;

    /**
     * Conexión PDO de solo lectura a database/telecom_blocks.sqlite.
     */
    protected static function connection(): ?PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        if (self::$attempted) {
            return null;
        }

        self::$attempted = true;
        $path = database_path('telecom_blocks.sqlite');

        if (!is_file($path) || !is_readable($path)) {
            return null;
        }

        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            if (defined('PDO::SQLITE_ATTR_OPEN_FLAGS') && defined('PDO::SQLITE_OPEN_READONLY')) {
                $options[PDO::SQLITE_ATTR_OPEN_FLAGS] = PDO::SQLITE_OPEN_READONLY;
            }

            self::$pdo = new PDO('sqlite:' . $path, null, null, $options);
            return self::$pdo;
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Normaliza un código de prefijo proveniente de la tabla blocks (ej. 233754XXX -> 2).
     */
    protected static function cleanPrefixCode(string $rawPrefix, string $sampleStart): string
    {
        if (ctype_digit($rawPrefix) && strlen($rawPrefix) <= 3) {
            return $rawPrefix;
        }

        return ChilePhoneHelper::getAreaInfo($sampleStart)['code'] ?? '2';
    }

    /**
     * Formatea una fila de la tabla `blocks` lista para las vistas.
     */
    protected static function hydrateBlock(array $row): array
    {
        $startStr = (string) $row['range_start'];
        $endStr = (string) $row['range_end'];
        $startFmt = ChilePhoneHelper::format($startStr);
        $endFmt = ChilePhoneHelper::format($endStr);

        return [
            'range_start' => $startStr,
            'range_end' => $endStr,
            'start_formatted' => $startFmt,
            'end_formatted' => $endFmt,
            'range_formatted' => $startFmt . ' – ' . $endFmt,
            'capacity' => max(1, ((int) $row['range_end']) - ((int) $row['range_start']) + 1),
            'operator_slug' => (string) $row['operator_slug'],
            'operator_name' => (string) $row['operator_name'],
            'legal_name' => (string) $row['legal_name'],
            'service_type' => (string) $row['service_type'],
            'is_voip_or_masivo' => (bool) $row['is_voip_or_masivo'],
            'prefix_code' => self::cleanPrefixCode((string) $row['prefix_code'], $startStr),
            'locality' => (string) ($row['locality'] ?? ''),
            'regulator_meta' => (string) ($row['regulator_meta'] ?? ''),
        ];
    }

    /**
     * Hidrata una fila de la tabla `operators` decodificando sus prefijos principales.
     */
    protected static function hydrateOperator(array $row): array
    {
        $topPrefixes = json_decode((string) ($row['top_prefixes_json'] ?? '[]'), true);
        if (!is_array($topPrefixes)) {
            $topPrefixes = [];
        }

        $prefixCodes = [];
        foreach ($topPrefixes as &$tp) {
            $cleanP = self::cleanPrefixCode((string) ($tp['prefix'] ?? ''), (string) ($tp['sample_start'] ?? ''));
            $tp['prefix_clean'] = $cleanP;
            $tp['sample_start_formatted'] = isset($tp['sample_start']) ? ChilePhoneHelper::format((string) $tp['sample_start']) : '';
            $tp['sample_end_formatted'] = isset($tp['sample_end']) ? ChilePhoneHelper::format((string) $tp['sample_end']) : '';
            $prefixCodes[$cleanP] = true;
        }
        unset($tp);

        return [
            'slug' => (string) $row['slug'],
            'name' => (string) $row['name'],
            'legal_name' => (string) $row['legal_name'],
            'blocks_count' => (int) $row['blocks_count'],
            'numbers_capacity' => (int) $row['numbers_capacity'],
            'primary_service' => (string) $row['primary_service'],
            'is_voip_or_masivo' => (bool) $row['is_voip_or_masivo'],
            'top_prefixes' => $topPrefixes,
            'prefix_codes' => array_map('strval', array_keys($prefixCodes)),
            'has_809' => isset($prefixCodes['809']),
            'has_600' => isset($prefixCodes['600']) || isset($prefixCodes['606']) || isset($prefixCodes['609']),
            'has_44' => isset($prefixCodes['44']),
            'has_800' => isset($prefixCodes['800']),
            'has_702' => isset($prefixCodes['702']),
        ];
    }

    /**
     * Busca el bloque oficial SUBTEL al que pertenece un número telefónico chileno (9 o 10 dígitos).
     */
    public static function lookupPhone(string $cleanDigits): ?array
    {
        $digits = preg_replace('/[^0-9]/', '', $cleanDigits);
        if ($digits === '' || strlen($digits) < 9 || strlen($digits) > 10) {
            return null;
        }

        $pdo = self::connection();
        if (!$pdo) {
            return null;
        }

        try {
            $num = (int) $digits;
            $stmt = $pdo->prepare('SELECT * FROM blocks WHERE range_start <= :n ORDER BY range_start DESC LIMIT 1');
            $stmt->bindValue(':n', $num, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!$row || ((int) $row['range_end']) < $num) {
                return null;
            }

            return self::hydrateBlock($row);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Devuelve el listado completo de operadores concesionarios en Chile según SUBTEL.
     */
    public static function getOperators(bool $onlyVoipOrMasivo = false): array
    {
        $pdo = self::connection();
        if (!$pdo) {
            return [];
        }

        try {
            $sql = 'SELECT * FROM operators';
            if ($onlyVoipOrMasivo) {
                $sql .= ' WHERE is_voip_or_masivo = 1';
            }
            $sql .= ' ORDER BY numbers_capacity DESC, blocks_count DESC, name ASC';

            $rows = $pdo->query($sql)->fetchAll();
            return array_map([self::class, 'hydrateOperator'], $rows ?: []);
        } catch (Throwable $e) {
            return [];
        }
    }

    /**
     * Obtiene la ficha completa de un operador por slug junto con hasta 40 bloques asignados.
     */
    public static function findOperator(string $slug): ?array
    {
        $pdo = self::connection();
        if (!$pdo || $slug === '') {
            return null;
        }

        try {
            $stmt = $pdo->prepare('SELECT * FROM operators WHERE slug = :slug LIMIT 1');
            $stmt->execute([':slug' => $slug]);
            $opRow = $stmt->fetch();

            if (!$opRow) {
                return null;
            }

            $operator = self::hydrateOperator($opRow);

            $bStmt = $pdo->prepare(
                'SELECT * FROM blocks WHERE operator_slug = :slug ORDER BY is_voip_or_masivo DESC, (range_end - range_start) DESC, range_start ASC LIMIT 40'
            );
            $bStmt->execute([':slug' => $slug]);
            $blockRows = $bStmt->fetchAll() ?: [];

            $operator['blocks'] = array_map([self::class, 'hydrateBlock'], $blockRows);
            return $operator;
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Obtiene los bloques oficiales SUBTEL asignados a un código de área o prefijo especial.
     */
    public static function getBlocksByPrefix(string $prefixCode, int $limit = 50): array
    {
        $cleanPrefix = ltrim(preg_replace('/[^0-9]/', '', $prefixCode), '0');
        $pdo = self::connection();
        if (!$pdo || $cleanPrefix === '') {
            return [];
        }

        try {
            $stmt = $pdo->prepare(
                'SELECT * FROM blocks WHERE prefix_code = :prefix ORDER BY (range_end - range_start) DESC, range_start ASC LIMIT :lim'
            );
            $stmt->bindValue(':prefix', $cleanPrefix, PDO::PARAM_STR);
            $stmt->bindValue(':lim', max(1, $limit), PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll() ?: [];

            return array_map([self::class, 'hydrateBlock'], $rows);
        } catch (Throwable $e) {
            return [];
        }
    }

    /**
     * Estadísticas globales del registro oficial SUBTEL compilado.
     */
    public static function getStats(): array
    {
        $defaults = [
            'total_operators' => 0,
            'voip_masivo_operators' => 0,
            'total_blocks' => 0,
            'total_capacity' => 0,
            'blocks_809' => 0,
            'blocks_600' => 0,
            'blocks_44' => 0,
            'blocks_800' => 0,
        ];

        $pdo = self::connection();
        if (!$pdo) {
            return $defaults;
        }

        try {
            $opStats = $pdo->query(
                'SELECT COUNT(*) AS total_operators,
                        SUM(CASE WHEN is_voip_or_masivo = 1 THEN 1 ELSE 0 END) AS voip_masivo_operators,
                        SUM(blocks_count) AS total_blocks,
                        SUM(numbers_capacity) AS total_capacity
                 FROM operators'
            )->fetch();

            $blkStats = $pdo->query(
                "SELECT SUM(CASE WHEN prefix_code = '809' THEN 1 ELSE 0 END) AS blocks_809,
                        SUM(CASE WHEN prefix_code IN ('600', '606', '609') THEN 1 ELSE 0 END) AS blocks_600,
                        SUM(CASE WHEN prefix_code = '44' THEN 1 ELSE 0 END) AS blocks_44,
                        SUM(CASE WHEN prefix_code = '800' THEN 1 ELSE 0 END) AS blocks_800
                 FROM blocks"
            )->fetch();

            return [
                'total_operators' => (int) ($opStats['total_operators'] ?? 0),
                'voip_masivo_operators' => (int) ($opStats['voip_masivo_operators'] ?? 0),
                'total_blocks' => (int) ($opStats['total_blocks'] ?? 0),
                'total_capacity' => (int) ($opStats['total_capacity'] ?? 0),
                'blocks_809' => (int) ($blkStats['blocks_809'] ?? 0),
                'blocks_600' => (int) ($blkStats['blocks_600'] ?? 0),
                'blocks_44' => (int) ($blkStats['blocks_44'] ?? 0),
                'blocks_800' => (int) ($blkStats['blocks_800'] ?? 0),
            ];
        } catch (Throwable $e) {
            return $defaults;
        }
    }
}
