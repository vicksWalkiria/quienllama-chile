@extends('layouts.app')

@php
    $shortCity = trim(explode(',', explode(' y ', preg_replace('/\s*\(.*$/', '', $info['city']))[0])[0]);
    $shortCity = \Illuminate\Support\Str::words($shortCity, 4, '');
@endphp
@section('title', "Prefijo {$clean} ({$shortCity}): Código de Área Chile")
@section('meta_description', "¿De dónde es el prefijo {$clean} en Chile? Corresponde a {$info['city']} ({$info['region']}). Cómo marcar según SUBTEL y números reportados.")

@section('styles')
<style>
    .area-detail-wrapper {
        max-width: var(--content-width);
        margin: 0 auto 3.5rem;
    }

    .back-nav {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 1.25rem;
    }

    .back-nav:hover {
        text-decoration: underline;
    }

    /* Main Area Header */
    .area-main-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2.25rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .area-badge-top {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(0, 51, 160, 0.08);
        color: var(--primary);
        font-weight: 700;
        font-size: 0.84rem;
        padding: 4px 12px;
        border-radius: 9999px;
        margin-bottom: 1rem;
    }

    .area-main-card h1 {
        font-size: 2.1rem;
        font-weight: 900;
        letter-spacing: -0.5px;
        color: var(--text-main);
        line-height: 1.25;
        margin-bottom: 0.75rem;
    }

    .area-main-card h1 span {
        color: var(--primary);
    }

    .area-description {
        font-size: 1.05rem;
        color: var(--text-muted);
        line-height: 1.65;
        margin-bottom: 1.5rem;
    }

    .area-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
        font-size: 0.95rem;
        color: var(--text-main);
    }

    .area-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Dialing Instructions Card */
    .dialing-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .dialing-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
        font-size: 0.92rem;
    }

    .dialing-table td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid var(--border);
    }

    .dialing-table tr:last-child td {
        border-bottom: none;
    }

    .dialing-table td:first-child {
        font-weight: 600;
        color: var(--text-muted);
        width: 45%;
    }

    .dialing-table td:last-child {
        font-weight: 800;
        color: var(--text-main);
        font-variant-numeric: tabular-nums;
    }

    /* Reported Phones Grid */
    .phones-in-area {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.75rem;
        margin-top: 1.25rem;
    }

    .area-phone-pill {
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 700;
        font-size: 0.95rem;
        font-variant-numeric: tabular-nums;
        transition: all 0.15s;
    }

    .area-phone-pill:hover {
        background: white;
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    /* Sister codes */
    .sister-codes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .sister-card {
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0.75rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        transition: all 0.15s;
    }

    .sister-card:hover {
        background: white;
        border-color: var(--primary);
        transform: translateY(-1px);
    }

    .sister-card strong {
        color: var(--primary);
        font-size: 1rem;
        font-weight: 800;
    }

    .sister-card span {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    /* Normativa SUBTEL & Bloques Oficiales */
    .area-reg-box {
        border-radius: var(--radius-lg);
        padding: 1.5rem 1.75rem;
        margin-bottom: 2rem;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }
    .area-reg-box.tone-danger {
        background: #fef2f2;
        border-color: #fecaca;
    }
    .area-reg-box.tone-warning {
        background: #fffbeb;
        border-color: #fde68a;
    }
    .area-reg-box.tone-info {
        background: #eff6ff;
        border-color: #bfdbfe;
    }
    .area-reg-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid rgba(15, 23, 42, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--primary);
    }
    .area-reg-box.tone-danger .area-reg-icon { color: #991b1b; }
    .area-reg-box.tone-warning .area-reg-icon { color: #92400e; }
    .area-reg-badge {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.18rem 0.6rem;
        border-radius: 9999px;
        background: #ffffff;
        color: #1e293b;
        border: 1px solid rgba(15, 23, 42, 0.12);
        margin-bottom: 0.4rem;
    }
    .area-reg-box h2 {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-main);
        margin: 0 0 0.4rem 0;
    }
    .area-reg-box p {
        font-size: 0.92rem;
        color: #334155;
        line-height: 1.62;
        margin: 0;
    }
    .subtel-blocks-wrap {
        overflow-x: auto;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        margin-top: 1rem;
    }
    .subtel-blocks-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
        text-align: left;
    }
    .subtel-blocks-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 0.8rem 1rem;
        border-bottom: 1px solid var(--border);
    }
    .subtel-blocks-table td {
        padding: 0.8rem 1rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
        color: var(--text-main);
    }
    .subtel-blocks-table tbody tr:last-child td {
        border-bottom: none;
    }
    .subtel-blocks-table tbody tr:hover {
        background: #f8fafc;
    }
    .subtel-num-mono {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        font-variant-numeric: tabular-nums;
        font-weight: 700;
        white-space: nowrap;
    }
    .subtel-op-link {
        color: var(--primary);
        font-weight: 800;
        text-decoration: none;
        display: inline-block;
    }
    .subtel-op-link:hover {
        text-decoration: underline;
    }
    @media (max-width: 640px) {
        .area-reg-box {
            flex-direction: column;
            padding: 1.25rem 1.1rem;
            gap: 0.75rem;
        }
    }
</style>
@endsection

@section('content')
<div class="area-detail-wrapper">
    <a href="{{ route('area-codes.index') }}" class="back-nav">
        ← Volver al Directorio de Prefijos de Chile
    </a>

    <!-- Main Card -->
    <div class="area-main-card">
        <div class="area-badge-top">
            🇨🇱 Código de Área Oficial SUBTEL
        </div>

        <h1>
            Prefijo <span>{{ $clean }}</span> Chile: ¿De dónde es el código <span>{{ $clean }}</span>?
        </h1>

        <p class="area-description">
            El código de área <strong>{{ $clean }}</strong> en la República de Chile corresponde a la zona geográfica de <strong>{{ $info['city'] }}</strong>, ubicada en la <strong>{{ $info['region'] }}</strong>. Forma parte del Plan de Numeración Nacional unificado fiscalizado por la <strong>Subsecretaría de Telecomunicaciones (SUBTEL)</strong>.
        </p>

        <div class="area-meta-row">
            <div class="area-meta-item">
                <span>📍</span> <strong>Ciudad / Cobertura:</strong> {{ $info['city'] }}
            </div>
            <div class="area-meta-item">
                <span>🏛️</span> <strong>Región:</strong> {{ $info['region'] }}
            </div>
            <div class="area-meta-item">
                <span>📞</span> <strong>Prefijo Nacional:</strong> +56 {{ $clean }}
            </div>
        </div>
    </div>

    @if(!empty($regulatoryNotice))
    <!-- Recuadro Regulatorio SUBTEL (809 / 600 / 702 / 800 / 44) -->
    <section class="area-reg-box tone-{{ $regulatoryNotice['tone'] ?? 'info' }}" aria-label="Marco normativo SUBTEL del prefijo {{ $clean }}">
        <div class="area-reg-icon" aria-hidden="true">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
        </div>
        <div>
            <span class="area-reg-badge">{{ $regulatoryNotice['badge'] }}</span>
            <h2>{{ $regulatoryNotice['title'] }}</h2>
            <p>{{ $regulatoryNotice['text'] }}</p>
        </div>
    </section>
    @endif

    <!-- Guía de Marcación -->
    <div class="dialing-card">
        <h2 style="font-size:1.3rem; font-weight:800; color:var(--text-main); margin:0">
            📞 ¿Cómo marcar a un número con prefijo {{ $clean }}?
        </h2>
        <p style="font-size:0.9rem; color:var(--text-muted); margin-top:0.35rem">
            Formas correctas de llamada según el Plan Fundamental de Numeración Nacional de la SUBTEL:
        </p>

        @php
            $expectedDigits = $info['digits'] ?? 9;
            $sampleQuery = match($clean) {
                '600' => '6000060123',
                '606' => '6060016500',
                '609' => '6090016500',
                '809' => '809000015',
                '702' => '702100100',
                '800' => '800000100',
                '44'  => '442000100',
                '9'   => '987654321',
                '2'   => '222345678',
                default => $clean . str_repeat('2', max(1, 9 - strlen($clean))),
            };
        @endphp

        <table class="dialing-table">
            <tr>
                <td>Marcación Nacional Directa</td>
                <td>{{ $clean }} + N° de Serie (Total {{ $expectedDigits }} dígitos)</td>
            </tr>
            <tr>
                <td>Llamar a un celular desde Chile</td>
                <td>9 + 8 dígitos del celular (Total 9 dígitos)</td>
            </tr>
            <tr>
                <td>Llamar desde el extranjero</td>
                <td>+56 {{ $clean }} + N° Local / Serie</td>
            </tr>
            <tr>
                <td>Formato completo de ejemplo</td>
                <td>{{ \App\Services\ChilePhoneHelper::format($sampleQuery) }}</td>
            </tr>
        </table>
    </div>

    <!-- Búsqueda rápida de un número con este código -->
    <div class="dialing-card" style="border: 2px solid var(--primary); background:#eff6ff;">
        <h3 style="font-size:1.15rem; font-weight:800; color:var(--text-main); margin-bottom:0.4rem">
            🔎 ¿Recibiste una llamada con el prefijo {{ $clean }}?
        </h3>
        <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:1rem">
            Ingresa el número completo ({{ $expectedDigits }} dígitos) para consultar su concesionaria SUBTEL y si otros usuarios lo denunciaron en Chile:
        </p>

        <form action="{{ route('search') }}" method="GET" style="display:flex; gap:0.5rem; flex-wrap:wrap">
            <input type="tel" name="q" value="{{ $clean }}" placeholder="Ej: {{ $sampleQuery }}" required style="flex:1; padding:0.75rem 1rem; border:1px solid var(--border); border-radius:8px; font-size:1rem; min-width:200px; min-height:44px">
            <button type="submit" class="btn btn-primary" style="padding:0.75rem 1.5rem; min-height:44px">
                Buscar Teléfono
            </button>
        </form>
    </div>

    <!-- Bloques y Concesionarias Asignadas por SUBTEL -->
    <section class="dialing-card" id="bloques-subtel">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:0.75rem; flex-wrap:wrap;">
            <h2 style="font-size:1.25rem; font-weight:800; color:var(--text-main); margin:0; display:flex; align-items:center; gap:0.5rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                Bloques y Concesionarias Asignadas por SUBTEL (Prefijo {{ $clean }})
            </h2>
            <a href="{{ route('operators.index') }}" style="display:inline-flex; align-items:center; gap:0.35rem; min-height:44px; padding:0.4rem 0.85rem; border-radius:8px; border:1px solid #bfdbfe; background:#eff6ff; color:var(--primary); font-size:0.84rem; font-weight:700; text-decoration:none;">
                <span>Ver las 275 concesionarias</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>

        @if(!empty($prefixBlocks))
            <p style="font-size:0.9rem; color:var(--text-muted); margin-top:0.4rem; margin-bottom:0;">
                Principales rangos numéricos adjudicados por la Subsecretaría de Telecomunicaciones para el código <strong>+56 {{ $clean }}</strong> (ordenados por capacidad asignada):
            </p>

            <div class="subtel-blocks-wrap">
                <table class="subtel-blocks-table">
                    <thead>
                        <tr>
                            <th scope="col">Rango Oficial SUBTEL</th>
                            <th scope="col">Concesionaria Titular</th>
                            <th scope="col">Servicio</th>
                            <th scope="col" style="text-align:right">Números</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prefixBlocks as $blk)
                            <tr>
                                <td class="subtel-num-mono">
                                    <a href="{{ route('phone.show', $blk['range_start']) }}" style="color:var(--text-main); text-decoration:none;" title="Consultar inicio de bloque {{ $blk['start_formatted'] }}">
                                        {{ $blk['range_formatted'] }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('operators.show', $blk['operator_slug']) }}" class="subtel-op-link">{{ $blk['operator_name'] }}</a>
                                    <span style="display:block; font-size:0.76rem; color:var(--text-muted);">{{ \Illuminate\Support\Str::limit($blk['legal_name'], 65) }}</span>
                                </td>
                                <td style="font-size:0.84rem; color:#334155;">{{ $blk['service_type'] }}</td>
                                <td class="subtel-num-mono" style="text-align:right">{{ number_format($blk['capacity'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p style="font-size:0.9rem; color:#334155; line-height:1.6; margin-top:0.65rem; margin-bottom:0;">
                La serie <strong>{{ $clean }}</strong> se encuentra habilitada dentro del marco regulatorio de SUBTEL para <strong>{{ $info['city'] }}</strong>. A medida que las concesionarias activan nuevas subasignaciones técnicas sobre este prefijo, puedes verificar cualquier número de {{ $expectedDigits }} dígitos directamente en el buscador superior o consultar el <a href="{{ route('operators.index') }}" style="color:var(--primary); font-weight:700;">padrón completo de operadores</a>.
            </p>
        @endif
    </section>

    <!-- Anuncio AdSense Chile - Prefijo Detalle Superior -->
    @include('partials.ad_slot', ['margin' => '1.5rem auto'])

    <!-- Teléfonos investigados con este prefijo -->
    @if($phones->isNotEmpty())
        <div class="dialing-card">
            <h3 style="font-size:1.25rem; font-weight:800; color:var(--text-main); margin-bottom:0.5rem">
                🚨 Teléfonos investigados con prefijo {{ $clean }}
            </h3>
            <p style="font-size:0.88rem; color:var(--text-muted)">
                Números reportados o con mayor volumen de consultas en esta zona:
            </p>

            <div class="phones-in-area">
                @foreach($phones as $p)
                    <a href="{{ route('phone.show', $p->number) }}" class="area-phone-pill">
                        <span>📞 {{ $p->formatted() }}</span>
                        @if($p->spam_score > 0)
                            <span style="color:#b91c1c; font-size:0.75rem">⚠️ {{ $p->spam_score }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Otros prefijos de la misma región -->
    @if(!empty($regionCodes) && count($regionCodes) > 1)
        <div class="dialing-card">
            <h3 style="font-size:1.2rem; font-weight:800; color:var(--text-main); margin-bottom:0.35rem">
                📍 Otros prefijos de la {{ $info['region'] }}
            </h3>
            <p style="font-size:0.88rem; color:var(--text-muted)">
                Explora los códigos de área de localidades cercanas en la misma región:
            </p>

            <div class="sister-codes-grid">
                @foreach($regionCodes as $sc => $sd)
                    @if($sc !== $clean)
                        <a href="{{ route('area-codes.show', $sc) }}" class="sister-card">
                            <strong>+56 {{ $sc }}</strong>
                            <span>{{ $sd['city'] }}</span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <!-- Anuncio AdSense Chile - Prefijo Detalle Inferior -->
    @include('partials.ad_slot', ['margin' => '1.5rem auto'])

    <!-- FAQs Schema.org FAQPage -->
    <div class="dialing-card" itemscope itemtype="https://schema.org/FAQPage">
        <h3 style="font-size:1.25rem; font-weight:800; color:var(--text-main); margin-bottom:1rem">
            ❓ Preguntas Frecuentes sobre el código {{ $clean }}
        </h3>

        <div style="border-bottom:1px solid var(--border); padding-bottom:1rem; margin-bottom:1rem" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h4 style="font-size:0.98rem; font-weight:700; color:var(--text-main); margin-bottom:0.35rem" itemprop="name">
                ¿De qué lugar es el prefijo {{ $clean }} en Chile?
            </h4>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6; margin:0" itemprop="text">
                    El código telefónico {{ $clean }} corresponde a la zona de {{ $info['city'] }}, perteneciente a la {{ $info['region'] }}.
                </p>
            </div>
        </div>

        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h4 style="font-size:0.98rem; font-weight:700; color:var(--text-main); margin-bottom:0.35rem" itemprop="name">
                ¿Cómo agregar a WhatsApp un número con prefijo {{ $clean }}?
            </h4>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6; margin:0" itemprop="text">
                    Para agendar en WhatsApp un número de Chile, se guarda en formato internacional: si es celular se añade <strong>+56 9</strong> seguido de los 8 dígitos, y si es fijo de esta localidad se añade <strong>+56 {{ $clean }}</strong> seguido del número local de 7 dígitos.
                </p>
            </div>
        </div>
    </div>

    <!-- EEAT Author Card (Víctor Alonso) -->
    <div class="eeat-author-card">
        <img src="{{ asset('images/victor-alonso.webp') }}" alt="Víctor Alonso" class="eeat-avatar">
        <div class="eeat-info">
            <h4>Compilado y estructurado por Víctor Alonso</h4>
            <p>Especialista en Desarrollo Web y SEO. Creador de QuiénLlama, comprometido con la transparencia en telecomunicaciones y la protección comunitaria frente a fraudes y spam telefónico en Chile, España, México y Argentina.</p>
            <div class="eeat-links">
                <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer">🌍 victor-alonso.es</a> ·
                <a href="https://www.linkedin.com/in/vialonso/" target="_blank" rel="noopener noreferrer">💼 LinkedIn</a> ·
                <a href="{{ route('legal.about') }}">ℹ️ Sobre el autor</a>
            </div>
        </div>
    </div>
</div>

<!-- Schema.org BreadcrumbList -->
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
      "name": "Prefijos Telefónicos de Chile",
      "item": "{{ url('/prefijos') }}"
    },
    {
      "@@type": "ListItem",
      "position": 3,
      "name": "Prefijo {{ $clean }} ({{ $info['city'] }})",
      "item": "{{ url('/prefijo/' . $clean) }}"
    }
  ]
}
</script>
@endsection
