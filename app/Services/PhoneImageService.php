<?php

namespace App\Services;

use App\Models\Phone;
use Illuminate\Http\Response;

class PhoneImageService
{
    private static function fontPath(string $name): string
    {
        foreach (['/usr/share/fonts/truetype/dejavu/', '/usr/share/fonts/dejavu/'] as $dir) {
            if (is_file($dir . $name)) {
                return $dir . $name;
            }
        }
        return $name;
    }

    private static function rrect($im, int $x1, int $y1, int $x2, int $y2, int $r, int $color): void
    {
        imagefilledrectangle($im, $x1 + $r, $y1, $x2 - $r, $y2, $color);
        imagefilledrectangle($im, $x1, $y1 + $r, $x2, $y2 - $r, $color);
        $d = $r * 2;
        imagefilledellipse($im, $x1 + $r, $y1 + $r, $d, $d, $color);
        imagefilledellipse($im, $x2 - $r, $y1 + $r, $d, $d, $color);
        imagefilledellipse($im, $x1 + $r, $y2 - $r, $d, $d, $color);
        imagefilledellipse($im, $x2 - $r, $y2 - $r, $d, $d, $color);
    }

    private static function fitText(string $txt, float $sz, string $font, int $maxW): string
    {
        $box = imagettfbbox($sz, 0, $font, $txt);
        if (abs($box[2] - $box[0]) <= $maxW) {
            return $txt;
        }
        while (mb_strlen($txt, 'UTF-8') > 5) {
            $txt = rtrim(mb_substr($txt, 0, -1, 'UTF-8'), ' ,.-');
            $cand = $txt . '…';
            $b = imagettfbbox($sz, 0, $font, $cand);
            if (abs($b[2] - $b[0]) <= $maxW) {
                return $cand;
            }
        }
        return $txt;
    }

    public static function render(
        string $cleanNumber,
        string $formatted,
        string $international,
        string $location,
        string $areaLabel,
        ?Phone $phone,
        string $brandDomain,
        string $countryTitle,
        string $subHeader
    ): Response {
        $spamScore = min(100, max(0, (int) ($phone?->spam_score ?? 0)));
        $views = max(1, (int) ($phone?->views ?? 1));
        $totalReports = $phone ? (int) $phone->comments()->count() : 0;
        $topReason = '';
        if ($phone && $totalReports > 0) {
            $topReason = (string) ($phone->comments()
                ->selectRaw('reason, count(*) as c')
                ->groupBy('reason')
                ->orderByDesc('c')
                ->value('reason') ?? '');
        }

        $etagSeed = implode('|', ['ql-latam-v1', $brandDomain, $cleanNumber, $spamScore, $totalReports, $topReason, (int) floor($views / 10)]);
        $etag = '"' . substr(sha1($etagSeed), 0, 18) . '"';

        if (trim((string) request()->header('If-None-Match')) === $etag) {
            return response('', 304, [
                'ETag' => $etag,
                'Cache-Control' => 'public, max-age=604800, stale-while-revalidate=2592000',
            ]);
        }

        $fRegular = self::fontPath('DejaVuSans.ttf');
        $fBold    = self::fontPath('DejaVuSans-Bold.ttf');
        $fMono    = self::fontPath('DejaVuSansMono-Bold.ttf');
        if (!is_file($fMono)) {
            $fMono = $fBold;
        }

        $im = imagecreatetruecolor(1200, 630);
        if (function_exists('imageantialias')) {
            imageantialias($im, true);
        }

        $cBg      = imagecolorallocate($im, 241, 245, 249);
        $cSheet   = imagecolorallocate($im, 255, 255, 255);
        $cSubtle  = imagecolorallocate($im, 248, 250, 252);
        $cBorder  = imagecolorallocate($im, 203, 213, 225);
        $cNavy    = imagecolorallocate($im, 15, 23, 42);
        $cSlate   = imagecolorallocate($im, 51, 65, 85);
        $cMuted   = imagecolorallocate($im, 100, 116, 139);
        $cWhite   = imagecolorallocate($im, 248, 250, 252);
        $cSky     = imagecolorallocate($im, 147, 197, 253);
        $cBlue    = imagecolorallocate($im, 2, 132, 199);

        $isHighRisk = ($spamScore >= 60);
        $isMedRisk  = (!$isHighRisk && ($spamScore >= 25 || $totalReports >= 1));

        if ($isHighRisk) {
            $cAccent   = imagecolorallocate($im, 185, 28, 28);
            $cAccentBg = imagecolorallocate($im, 254, 242, 242);
            $pillLabel = 'ALERTA COMUNITARIA · RIESGO ' . $spamScore . '%';
            $riskShort = 'Peligroso (' . $spamScore . '%)';
            $riskSub   = $topReason !== '' ? $topReason : 'Spam / Fraude reportado';
        } elseif ($isMedRisk) {
            $cAccent   = imagecolorallocate($im, 180, 83, 9);
            $cAccentBg = imagecolorallocate($im, 255, 251, 235);
            $pillLabel = 'NÚMERO SOSPECHOSO · EN OBSERVACIÓN (' . max($spamScore, 30) . '%)';
            $riskShort = 'Sospechoso (' . max($spamScore, 30) . '%)';
            $riskSub   = $topReason !== '' ? $topReason : 'Reportado por usuarios';
        } else {
            $cAccent   = imagecolorallocate($im, 3, 105, 161);
            $cAccentBg = imagecolorallocate($im, 240, 249, 255);
            $pillLabel = 'DIRECTORIO ANTISPAM · ' . mb_strtoupper($countryTitle, 'UTF-8');
            $riskShort = 'Sin alertas graves';
            $riskSub   = 'Verificación ciudadana';
        }

        imagefilledrectangle($im, 0, 0, 1200, 630, $cBg);
        self::rrect($im, 34, 30, 1166, 600, 16, $cBorder);
        self::rrect($im, 35, 31, 1165, 599, 15, $cSheet);

        self::rrect($im, 35, 31, 1165, 126, 15, $cNavy);
        imagefilledrectangle($im, 35, 104, 1165, 126, $cNavy);
        imagefilledrectangle($im, 35, 126, 1165, 131, $cAccent);

        self::rrect($im, 72, 54, 120, 102, 10, $cAccent);
        imagesetthickness($im, 3);
        $shieldPts = [96, 63, 110, 69, 108, 84, 96, 93, 84, 84, 82, 69];
        imagepolygon($im, $shieldPts, 6, $cWhite);
        imagesetthickness($im, 1);

        imagettftext($im, 20, 0, 138, 77, $cWhite, $fBold, 'QUIÉNLLAMA ' . mb_strtoupper($countryTitle, 'UTF-8') . ' · Detector de Spam');
        imagettftext($im, 13, 0, 138, 101, $cSky, $fRegular, $subHeader);

        $pillBox = imagettfbbox(12.5, 0, $fBold, $pillLabel);
        $pillW = min(980, abs($pillBox[2] - $pillBox[0]) + 38);
        self::rrect($im, 72, 156, 72 + $pillW, 196, 8, $cAccentBg);
        imagettftext($im, 12.5, 0, 91, 182, $cAccent, $fBold, $pillLabel);

        imagettftext($im, 18, 0, 72, 244, $cMuted, $fBold, '¿Quién me llama desde este número?');
        $heroNum = self::fitText($formatted, 54, $fMono, 1040);
        imagettftext($im, 54, 0, 70, 322, $cNavy, $fMono, $heroNum);

        $subLine = 'Directo: ' . $cleanNumber . '  (' . $international . ')   ·   ' . $location . '   ·   ' . $areaLabel;
        imagettftext($im, 14.5, 0, 72, 366, $cSlate, $fRegular, self::fitText($subLine, 14.5, $fRegular, 1040));

        self::rrect($im, 72, 398, 1128, 558, 12, $cBorder);
        self::rrect($im, 73, 399, 1127, 557, 11, $cSubtle);
        imageline($im, 424, 399, 424, 557, $cBorder);
        imageline($im, 776, 399, 776, 557, $cBorder);

        imagettftext($im, 12, 0, 94, 436, $cMuted, $fBold, 'Nivel de riesgo detectado');
        imagettftext($im, 21, 0, 94, 478, $cAccent, $fBold, self::fitText($riskShort, 21, $fBold, 310));
        imagettftext($im, 12.5, 0, 94, 514, $cSlate, $fRegular, self::fitText($riskSub, 12.5, $fRegular, 310));

        imagettftext($im, 12, 0, 446, 436, $cMuted, $fBold, 'Actividad comunitaria');
        $repTxt = $totalReports . ($totalReports === 1 ? ' denuncia' : ' denuncias');
        imagettftext($im, 21, 0, 446, 478, $cBlue, $fBold, self::fitText($repTxt, 21, $fBold, 310));
        $viewTxt = number_format($views, 0, ',', '.') . ($views === 1 ? ' consulta registrada' : ' consultas registradas');
        imagettftext($im, 12.5, 0, 446, 514, $cSlate, $fRegular, self::fitText($viewTxt, 12.5, $fRegular, 310));

        imagettftext($im, 12, 0, 798, 436, $cMuted, $fBold, 'Protección gratuita');
        imagettftext($im, 14.5, 0, 798, 474, $cNavy, $fBold, 'Bloqueo gratis .VCF / App');
        imagettftext($im, 13.5, 0, 798, 503, $cSlate, $fRegular, 'Opiniones y reportes reales');
        imagettftext($im, 11, 0, 794, 533, $cMuted, $fBold, self::fitText($brandDomain . '/' . $cleanNumber, 11, $fBold, 322));

        imagetruecolortopalette($im, false, 255);
        ob_start();
        imagepng($im, null, 7);
        $pngBytes = (string) ob_get_clean();
        imagedestroy($im);

        return response($pngBytes, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=604800, stale-while-revalidate=2592000',
            'ETag' => $etag,
            'X-Robots-Tag' => 'index, max-image-preview:large',
        ]);
    }
}
