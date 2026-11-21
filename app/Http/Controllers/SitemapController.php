<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Services\AreaCodeService;
use App\Services\TelecomBlockService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = Cache::remember('sitemap_xml_v3', 3600, function () {
            $phones = Phone::select('number', 'spam_score', 'updated_at')
                ->orderByDesc('spam_score')
                ->orderByDesc('updated_at')
                ->get();
            $areaCodes = array_keys(AreaCodeService::getAll());
            $topOperators = array_slice(TelecomBlockService::getOperators(false), 0, 80);

            $now = now()->toAtomString();
            $staticRoutes = [
                ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => $now],
                ['url' => route('area-codes.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $now],
                ['url' => route('operators.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $now],
                ['url' => route('vcf.index'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $now],
                ['url' => route('legal.no-molestar'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $now],
                ['url' => route('legal.borrar-datos'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $now],
                ['url' => route('legal.about'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => $now],
                ['url' => route('contact.index'), 'priority' => '0.5', 'changefreq' => 'monthly', 'lastmod' => $now],
            ];

            $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

            // Static Pages
            foreach ($staticRoutes as $page) {
                $out .= "  <url>\n";
                $out .= "    <loc>{$page['url']}</loc>\n";
                $out .= "    <lastmod>{$page['lastmod']}</lastmod>\n";
                $out .= "    <changefreq>{$page['changefreq']}</changefreq>\n";
                $out .= "    <priority>{$page['priority']}</priority>\n";
                $out .= "  </url>\n";
            }

            // Area Codes (incluye /prefijo/702, /prefijo/809, /prefijo/600, etc.)
            foreach ($areaCodes as $code) {
                $loc = route('area-codes.show', $code);
                $out .= "  <url>\n";
                $out .= "    <loc>{$loc}</loc>\n";
                $out .= "    <lastmod>{$now}</lastmod>\n";
                $out .= "    <changefreq>weekly</changefreq>\n";
                $out .= "    <priority>0.8</priority>\n";
                $out .= "  </url>\n";
            }

            // Top 80 SUBTEL Operators
            foreach ($topOperators as $op) {
                $loc = route('operators.show', $op['slug']);
                $out .= "  <url>\n";
                $out .= "    <loc>{$loc}</loc>\n";
                $out .= "    <lastmod>{$now}</lastmod>\n";
                $out .= "    <changefreq>monthly</changefreq>\n";
                $out .= "    <priority>0.8</priority>\n";
                $out .= "  </url>\n";
            }

            // Phones
            $imgCounter = 0;
            foreach ($phones as $phone) {
                $loc = route('phone.show', $phone->number);
                $mod = $phone->updated_at ? $phone->updated_at->toAtomString() : $now;
                $out .= "  <url>\n";
                $out .= "    <loc>{$loc}</loc>\n";
                $out .= "    <lastmod>{$mod}</lastmod>\n";
                $out .= "    <changefreq>weekly</changefreq>\n";
                $out .= "    <priority>0.7</priority>\n";
                if ($imgCounter < 8000) {
                    $imgUrl = route('phone.image', $phone->number);
                    $imgTitle = htmlspecialchars("¿Quién me llama del {$phone->number}? Denuncias y spam en Chile", ENT_XML1 | ENT_QUOTES, 'UTF-8');
                    $out .= "    <image:image>\n";
                    $out .= "      <image:loc>{$imgUrl}</image:loc>\n";
                    $out .= "      <image:title>{$imgTitle}</image:title>\n";
                    $out .= "    </image:image>\n";
                    $imgCounter++;
                }
                $out .= "  </url>\n";
            }

            $out .= '</urlset>';

            return $out;
        });

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
