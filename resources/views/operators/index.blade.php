@extends('layouts.app')

@section('title', 'Operadores Telefónicos y Concesionarias VoIP en Chile (SUBTEL)')
@section('meta_description', 'Directorio oficial de los 275 operadores telefónicos, móviles y concesionarias VoIP / telemarketing (prefijos 809, 600, 44) asignados por SUBTEL en Chile.')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    .ops-page {
        max-width: var(--content-width);
        margin: 0 auto 3rem;
    }

    .ops-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.86rem;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }

    .ops-breadcrumb a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
    }

    .ops-breadcrumb a:hover {
        text-decoration: underline;
    }

    .ops-hero {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .ops-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #eff6ff;
        color: var(--primary);
        border: 1px solid #bfdbfe;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 0.35rem 0.85rem;
        border-radius: 9999px;
        margin-bottom: 0.9rem;
    }

    .ops-hero h1 {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        font-size: 2.1rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: var(--text-main);
        line-height: 1.22;
        margin-bottom: 0.75rem;
    }

    .ops-hero-lead {
        font-size: 1rem;
        color: var(--text-muted);
        line-height: 1.65;
        max-width: 820px;
        margin-bottom: 1.5rem;
    }

    .ops-kpi-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.85rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
    }

    .ops-kpi-item {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 0.9rem 1rem;
    }

    .ops-kpi-value {
        font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace;
        font-variant-numeric: tabular-nums;
        font-size: 1.45rem;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1.2;
        display: block;
    }

    .ops-kpi-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 600;
        margin-top: 0.2rem;
        display: block;
    }

    /* Normativa SUBTEL Quick Strip */
    .subtel-rules-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.9rem;
        margin-bottom: 1.75rem;
    }

    .subtel-rule-box {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.15rem 1.25rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
        transition: border-color 0.15s, box-shadow 0.15s, transform 0.15s;
        min-height: 44px;
    }

    .subtel-rule-box:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-sm);
        transform: translateY(-1px);
    }

    .subtel-rule-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
    }

    .subtel-prefix-tag {
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-variant-numeric: tabular-nums;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0.2rem 0.6rem;
        border-radius: 6px;
    }

    .tag-809 { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    .tag-600 { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .tag-702 { background: #eff6ff; color: #0033a0; border: 1px solid #bfdbfe; }
    .tag-voip { background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; }

    .subtel-rule-box strong {
        font-size: 0.95rem;
        color: var(--text-main);
        font-weight: 700;
    }

    .subtel-rule-box p {
        font-size: 0.84rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin: 0;
    }

    /* Filter Controls */
    .ops-controls {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .ops-search-wrap {
        position: relative;
        margin-bottom: 0.9rem;
    }

    .ops-search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        pointer-events: none;
        display: flex;
    }

    .ops-search-input {
        width: 100%;
        min-height: 46px;
        padding: 0.7rem 1rem 0.7rem 2.75rem;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 0.95rem;
        color: var(--text-main);
        background: #f8fafc;
        outline: none;
        transition: border-color 0.15s, background 0.15s;
    }

    .ops-search-input:focus {
        background: #ffffff;
        border-color: var(--primary);
    }

    .ops-filter-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .ops-filter-btn {
        min-height: 44px;
        padding: 0.5rem 0.95rem;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: #f8fafc;
        color: #334155;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.15s;
        font-variant-numeric: tabular-nums;
    }

    .ops-filter-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: #ffffff;
    }

    .ops-filter-btn.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #ffffff;
    }

    /* Operators Table / Responsive List */
    .ops-table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .ops-table-meta {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
        background: #f8fafc;
    }

    .ops-table-meta h2 {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        font-size: 1.12rem;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .ops-count-status {
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--text-muted);
        font-variant-numeric: tabular-nums;
    }

    .ops-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .ops-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .ops-table th {
        padding: 0.85rem 1.15rem;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #475569;
        background: #ffffff;
        border-bottom: 1px solid var(--border);
    }

    .ops-table td {
        padding: 0.95rem 1.15rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
        font-size: 0.9rem;
    }

    .ops-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ops-table tbody tr:hover {
        background: #f8fafc;
    }

    .op-name-link {
        font-weight: 800;
        font-size: 0.98rem;
        color: var(--primary);
        text-decoration: none;
        display: inline-block;
        margin-bottom: 0.15rem;
    }

    .op-name-link:hover {
        text-decoration: underline;
    }

    .op-legal {
        display: block;
        font-size: 0.78rem;
        color: var(--text-muted);
        line-height: 1.35;
        max-width: 340px;
    }

    .op-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.76rem;
        font-weight: 700;
        padding: 0.22rem 0.58rem;
        border-radius: 6px;
        white-space: nowrap;
    }

    .role-voip {
        background: #fffbeb;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .role-carrier {
        background: #eff6ff;
        color: #0033a0;
        border: 1px solid #bfdbfe;
    }

    .op-service-sub {
        display: block;
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
    }

    .op-prefixes-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
    }

    .op-prefix-chip {
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-variant-numeric: tabular-nums;
        font-size: 0.76rem;
        font-weight: 700;
        padding: 0.18rem 0.48rem;
        border-radius: 5px;
        text-decoration: none;
        background: #f1f5f9;
        color: #1e293b;
        border: 1px solid #cbd5e1;
    }

    .op-prefix-chip.p-809 { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
    .op-prefix-chip.p-600 { background: #fffbeb; color: #92400e; border-color: #fde68a; }
    .op-prefix-chip.p-44  { background: #eff6ff; color: #0033a0; border-color: #bfdbfe; }

    .op-num-col {
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-variant-numeric: tabular-nums;
        text-align: right;
        white-space: nowrap;
        font-weight: 700;
        color: var(--text-main);
    }

    .op-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
        min-height: 44px;
        padding: 0.45rem 0.85rem;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: #ffffff;
        color: var(--primary);
        font-size: 0.84rem;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        transition: border-color 0.15s, background 0.15s;
    }

    .op-view-btn:hover {
        border-color: var(--primary);
        background: #eff6ff;
    }

    .ops-empty-state {
        display: none;
        padding: 2.5rem 1.5rem;
        text-align: center;
        color: var(--text-muted);
    }

    @media (max-width: 900px) {
        .ops-kpi-strip {
            grid-template-columns: repeat(2, 1fr);
        }
        .subtel-rules-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        .ops-hero {
            padding: 1.35rem 1.1rem;
        }
        .ops-hero h1 {
            font-size: 1.6rem;
        }
        .ops-table thead {
            display: none;
        }
        .ops-table, .ops-table tbody, .ops-table tr, .ops-table td {
            display: block;
            width: 100%;
        }
        .ops-table tr {
            padding: 1rem 1.1rem;
            border-bottom: 1px solid var(--border);
        }
        .ops-table td {
            padding: 0.3rem 0;
            border: none;
            text-align: left !important;
        }
        .op-view-btn {
            width: 100%;
            margin-top: 0.45rem;
        }
    }
</style>
@endsection

@section('content')
<div class="ops-page">
    <nav class="ops-breadcrumb" aria-label="Ruta de navegación">
        <a href="{{ route('home') }}">Inicio</a>
        <span aria-hidden="true">/</span>
        <span>Operadores y Concesionarias SUBTEL</span>
    </nav>

    <header class="ops-hero">
        <div class="ops-eyebrow">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>Registro Público de Numeración SUBTEL · Chile</span>
        </div>

        <h1>Operadores Telefónicos, Móviles y Concesionarias VoIP en Chile</h1>
        <p class="ops-hero-lead">
            Consulta el padrón técnico de las <strong>{{ number_format($stats['total_operators'], 0, ',', '.') }} concesionarias de telecomunicaciones</strong> con bloques numéricos asignados por la Subsecretaría de Telecomunicaciones (SUBTEL): operadores móviles y fijos, redes de Voz sobre IP (prefijo 44) y plataformas mayoristas de llamadas masivas comerciales (prefijos 809 y 600).
        </p>

        <div class="ops-kpi-strip">
            <div class="ops-kpi-item">
                <span class="ops-kpi-value">{{ number_format($stats['total_operators'], 0, ',', '.') }}</span>
                <span class="ops-kpi-label">Concesionarias registradas</span>
            </div>
            <div class="ops-kpi-item">
                <span class="ops-kpi-value">{{ number_format($stats['total_blocks'], 0, ',', '.') }}</span>
                <span class="ops-kpi-label">Bloques numéricos SUBTEL</span>
            </div>
            <div class="ops-kpi-item">
                <span class="ops-kpi-value">{{ number_format($stats['voip_masivo_operators'], 0, ',', '.') }}</span>
                <span class="ops-kpi-label">Operadores VoIP / Masivos</span>
            </div>
            <div class="ops-kpi-item">
                <span class="ops-kpi-value">{{ number_format($stats['blocks_809'] + $stats['blocks_600'], 0, ',', '.') }}</span>
                <span class="ops-kpi-label">Rangos 809 y serie 600</span>
            </div>
        </div>
    </header>

    <!-- Marco Normativo Rápido SUBTEL -->
    <section class="subtel-rules-grid" aria-label="Prefijos de llamadas masivas regulados por SUBTEL">
        <a href="{{ route('area-codes.show', '809') }}" class="subtel-rule-box">
            <div class="subtel-rule-head">
                <span class="subtel-prefix-tag tag-809">Prefijo 809</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </div>
            <strong>Spam y Telemarketing No Solicitado</strong>
            <p>Obligatorio para ofertas comerciales sin vínculo contractual previo. Identificable y bloqueable masivamente ({{ $stats['blocks_809'] }} bloques).</p>
        </a>

        <a href="{{ route('area-codes.show', '600') }}" class="subtel-rule-box">
            <div class="subtel-rule-head">
                <span class="subtel-prefix-tag tag-600">Prefijo 600 (10 dígitos)</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </div>
            <strong>Atención y Servicios Contratados</strong>
            <p>Exclusivo para empresas con relación vigente (bancos, clínicas, soporte). Prohibido ofrecer productos nuevos no solicitados.</p>
        </a>

        <a href="{{ route('area-codes.show', '702') }}" class="subtel-rule-box">
            <div class="subtel-rule-head">
                <span class="subtel-prefix-tag tag-702">Prefijo 702</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </div>
            <strong>Comunicaciones Masivas del Estado</strong>
            <p>Reservado por SUBTEL para avisos oficiales de ministerios, hospitales públicos, servicios estatales y municipalidades.</p>
        </a>
    </section>

    @include('partials.ad_slot', ['margin' => '1.5rem auto'])

    <!-- Buscador y Filtros Instantáneos -->
    <section class="ops-controls" aria-label="Filtrar operadores">
        <div class="ops-search-wrap">
            <span class="ops-search-icon" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </span>
            <input type="search" id="opSearchInput" class="ops-search-input" placeholder="Buscar por nombre comercial, razón social o prefijo (ej: WOM, Redvoiss, Netline, 809, 600, 44)..." aria-label="Filtrar concesionarias por nombre o prefijo" autocomplete="off">
        </div>

        <div class="ops-filter-tabs" role="tablist" aria-label="Categorías de concesionarias">
            <button type="button" class="ops-filter-btn active" data-filter="all">
                Todas ({{ count($operators) }})
            </button>
            <button type="button" class="ops-filter-btn" data-filter="voip">
                VoIP y Masivos ({{ $stats['voip_masivo_operators'] }})
            </button>
            <button type="button" class="ops-filter-btn" data-filter="809">
                Con Prefijo 809
            </button>
            <button type="button" class="ops-filter-btn" data-filter="600">
                Con Serie 600
            </button>
            <button type="button" class="ops-filter-btn" data-filter="44">
                Telefonía IP (44)
            </button>
            <button type="button" class="ops-filter-btn" data-filter="carrier">
                Red Móvil / Fija Tradicional
            </button>
        </div>
    </section>

    <!-- Tabla Completa de Concesionarias -->
    <section class="ops-table-card">
        <div class="ops-table-meta">
            <h2>
                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg>
                Padrón Oficial de Concesionarias de Telecomunicaciones
            </h2>
            <span class="ops-count-status" id="opsVisibleCount">Mostrando {{ count($operators) }} de {{ count($operators) }} operadores</span>
        </div>

        <div class="ops-table-wrap">
            <svg width="0" height="0" style="position:absolute" aria-hidden="true">
                <symbol id="ico-chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></symbol>
            </svg>
            <table class="ops-table" id="opsDirectoryTable">
                <thead>
                    <tr>
                        <th scope="col">Concesionaria / Razón Social</th>
                        <th scope="col">Perfil de Red</th>
                        <th scope="col">Prefijos Asignados</th>
                        <th scope="col" style="text-align:right">Bloques</th>
                        <th scope="col" style="text-align:right">Numeración</th>
                        <th scope="col" style="text-align:right">Ficha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($operators as $op)
                        @php
                            $searchHaystack = mb_strtolower($op['name'] . ' ' . $op['legal_name'] . ' ' . $op['primary_service'] . ' ' . implode(' ', $op['prefix_codes']), 'UTF-8');
                        @endphp
                        <tr class="op-row" data-search="{{ $searchHaystack }}" data-voip="{{ $op['is_voip_or_masivo'] ? '1' : '0' }}" data-p809="{{ $op['has_809'] ? '1' : '0' }}" data-p600="{{ $op['has_600'] ? '1' : '0' }}" data-p44="{{ $op['has_44'] ? '1' : '0' }}">
                            <td><a href="{{ route('operators.show', $op['slug']) }}" class="op-name-link">{{ $op['name'] }}</a><span class="op-legal">{{ \Illuminate\Support\Str::limit($op['legal_name'], 85) }}</span></td>
                            <td><span class="op-role-badge {{ $op['is_voip_or_masivo'] ? 'role-voip' : 'role-carrier' }}">{{ $op['is_voip_or_masivo'] ? 'VoIP / Tráfico Masivo' : 'Operador Móvil / Fijo' }}</span><span class="op-service-sub">{{ $op['primary_service'] }}</span></td>
                            <td><div class="op-prefixes-list">@foreach(array_slice($op['prefix_codes'], 0, 6) as $pCode)<span class="op-prefix-chip {{ $pCode === '809' ? 'p-809' : (in_array($pCode, ['600','606','609'], true) ? 'p-600' : ($pCode === '44' ? 'p-44' : '')) }}">+56 {{ $pCode }}</span>@endforeach @if(count($op['prefix_codes']) > 6)<span class="op-prefix-chip">+{{ count($op['prefix_codes']) - 6 }}</span>@endif</div></td>
                            <td class="op-num-col">{{ number_format($op['blocks_count'], 0, ',', '.') }}</td>
                            <td class="op-num-col">{{ number_format($op['numbers_capacity'], 0, ',', '.') }}</td>
                            <td style="text-align:right"><a href="{{ route('operators.show', $op['slug']) }}" class="op-view-btn"><span>Ver bloques</span><svg width="15" height="15" aria-hidden="true"><use href="#ico-chev"/></svg></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="ops-empty-state" id="opsEmptyState">
            <p style="font-weight:700; color:var(--text-main); margin-bottom:0.35rem;">No se encontraron concesionarias con ese filtro.</p>
            <p style="font-size:0.88rem;">Prueba buscando por otra razón social o restablece la pestaña «Todas».</p>
        </div>
    </section>

    @include('partials.ad_slot', ['margin' => '2rem auto'])

    <!-- Nota Metodológica y Portabilidad -->
    <section class="ops-hero" style="margin-top: 1.5rem; margin-bottom: 0;">
        <h2 style="font-family:'Plus Jakarta Sans','Inter',sans-serif; font-size:1.25rem; font-weight:800; color:var(--text-main); margin-bottom:0.65rem; display:flex; align-items:center; gap:0.5rem;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
            Sobre la asignación de bloques SUBTEL, operadores VoIP y portabilidad numérica
        </h2>
        <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.65; margin-bottom:0.75rem;">
            La tabla de numeración refleja los bloques originalmente adjudicados mediante decreto o resolución técnica de la <strong>Subsecretaría de Telecomunicaciones (SUBTEL)</strong>. En Chile, numerosas concesionarias de <strong>Telefonía IP (VoIP) y servicios complementarios</strong> proveen troncales SIP mayoristas a centros de contacto (call centers), entidades financieras, clínicas y empresas de cobranza extrajudicial.
        </p>
        <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.65; margin:0;">
            Asimismo, por aplicación de la <strong>Ley N° 20.471 de Portabilidad Numérica Completa</strong>, un número móvil o geográfico individual puede haber sido portado por su titular hacia una compañía distinta de la concesionaria original del bloque.
        </p>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('opSearchInput');
    const filterBtns = document.querySelectorAll('.ops-filter-btn');
    const rows = document.querySelectorAll('.op-row');
    const countLabel = document.getElementById('opsVisibleCount');
    const emptyState = document.getElementById('opsEmptyState');
    const totalRows = rows.length;
    let activeFilter = 'all';

    function applyFilters() {
        const q = (searchInput.value || '').toLowerCase().trim();
        let visible = 0;

        rows.forEach(function (row) {
            let passTab = true;
            if (activeFilter === 'voip') passTab = row.dataset.voip === '1';
            else if (activeFilter === '809') passTab = row.dataset.p809 === '1';
            else if (activeFilter === '600') passTab = row.dataset.p600 === '1';
            else if (activeFilter === '44') passTab = row.dataset.p44 === '1';
            else if (activeFilter === 'carrier') passTab = row.dataset.voip === '0';

            const passQuery = !q || row.dataset.search.indexOf(q) !== -1;

            if (passTab && passQuery) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        countLabel.textContent = 'Mostrando ' + visible + ' de ' + totalRows + ' operadores';
        emptyState.style.display = visible === 0 ? 'block' : 'none';
    }

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filterBtns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            activeFilter = btn.dataset.filter;
            applyFilters();
        });
    });

    searchInput.addEventListener('input', applyFilters);
});
</script>

<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@@type": "ListItem",
      "position": 1,
      "name": "Inicio",
      "item": "{{ url('/') }}"
    },
    {
      "@@type": "ListItem",
      "position": 2,
      "name": "Operadores y Concesionarias SUBTEL Chile",
      "item": "{{ route('operators.index') }}"
    }
  ]
}
</script>
@endsection
