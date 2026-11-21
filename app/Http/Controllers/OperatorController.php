<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsEvent;
use App\Models\Phone;
use App\Services\TelecomBlockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OperatorController extends Controller
{
    public function index(Request $request): View
    {
        $operators = TelecomBlockService::getOperators(false);
        $stats = TelecomBlockService::getStats();

        $featuredVoip = array_values(array_filter(
            $operators,
            fn(array $op) => $op['is_voip_or_masivo'] || $op['has_809'] || $op['has_600'] || $op['has_44']
        ));
        $featuredVoip = array_slice($featuredVoip, 0, 12);

        AnalyticsEvent::create([
            'event_type' => 'view_operators_index',
            'ip_hash' => hash('sha256', $request->ip() . 'salt2026'),
        ]);

        return view('operators.index', compact('operators', 'stats', 'featuredVoip'));
    }

    public function show(string $slug): View|RedirectResponse
    {
        $cleanSlug = strtolower(trim($slug));

        if ($slug !== $cleanSlug && $cleanSlug !== '') {
            return redirect()->route('operators.show', ['slug' => $cleanSlug], 301);
        }

        $operator = TelecomBlockService::findOperator($cleanSlug);

        if (!$operator) {
            return redirect()->route('operators.index')
                ->with('error', "No se encontró el operador concesionario «{$slug}» en el registro SUBTEL.");
        }

        $reportedPhones = collect();
        if (!empty($operator['blocks'])) {
            $blocksForMatch = array_slice($operator['blocks'], 0, 30);
            $reportedPhones = Phone::withCount('comments')
                ->where(function ($q) use ($blocksForMatch) {
                    foreach ($blocksForMatch as $blk) {
                        $q->orWhereRaw(
                            'CAST(number AS INTEGER) BETWEEN ? AND ?',
                            [(int) $blk['range_start'], (int) $blk['range_end']]
                        );
                    }
                })
                ->orderByDesc('spam_score')
                ->orderByDesc('views')
                ->limit(16)
                ->get();
        }

        $allOperators = TelecomBlockService::getOperators($operator['is_voip_or_masivo']);
        $relatedOperators = array_values(array_filter(
            $allOperators,
            fn(array $op) => $op['slug'] !== $operator['slug']
        ));
        $relatedOperators = array_slice($relatedOperators, 0, 8);

        AnalyticsEvent::create([
            'event_type' => 'view_operator_detail',
            'event_label' => $cleanSlug,
            'ip_hash' => hash('sha256', request()->ip() . 'salt2026'),
        ]);

        return view('operators.show', compact('operator', 'reportedPhones', 'relatedOperators'));
    }
}
