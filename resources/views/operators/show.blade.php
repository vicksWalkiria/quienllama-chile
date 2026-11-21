@extends('layouts.app')

@section('title', "{$operator['name']}: Bloques SUBTEL, Prefijos y Reportes en Chile")
@section('meta_description', "Ficha técnica SUBTEL de {$operator['name']} ({$operator['legal_name']}). {$operator['blocks_count']} bloques asignados, prefijos 809/600/VoIP y teléfonos reportados en Chile.")

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    .op-detail {
        max-width: var(--content-width);
        margin: 0 auto 3rem;
    }

    .op-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.86rem;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }

    .op-breadcrumb a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
    }

    .op-breadcrumb a:hover {
        text-decoration: underline;
    }

    .op-sheet {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .op-badge-row {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 0.9rem;
    }

    .op-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 0.3rem 0.75rem;
        border-radius: 9999px;
    }

    .op-chip-subtel {
        background: #eff6ff;
        color: var(--primary);
        border: 1px solid #bfdbfe;
    }

    .op-chip-voip {
        background: #fffbeb;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .op-chip-809 {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .op-sheet h1 {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        font-size: 2.15rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: var(--text-main);
        line-height: 1.2;
        margin-bottom: 0.45rem;
    }

    .op-legal-subtitle {
        font-size: 0.95rem;
        color: var(--text-muted);
        margin-bottom: 1.35rem;
        line-height: 1.5;
    }

    .op-metrics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.85rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
    }

    .op-metric-card {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 0.95rem 1rem;
    }

    .op-metric-num {
        font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace;
        font-variant-numeric: tabular-nums;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-main);
        display: block;
        line-height: 1.25;
    }

    .op-metric-text {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-main);
        display: block;
        line-height: 1.35;
    }

    .op-metric-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--text-muted);
        margin-top: 0.25rem;
        display: block;
    }

    .op-prefix-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.45rem;
        margin-top: 1.25rem;
    }

    .op-prefix-link {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        min-height: 44px;
        padding: 0.45rem 0.85rem;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        color: var(--text-main);
        text-decoration: none;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-variant-numeric: tabular-nums;
        font-size: 0.84rem;
        font-weight: 700;
        transition: border-color 0.15s, background 0.15s, color 0.15s;
    }

    .op-prefix-link:hover {
        border-color: var(--primary);
        background: #eff6ff;
        color: var(--primary);
    }

    /* Legal & Wholesale Technical Box (prefijo400-style) */
    .op-regulatory-box {
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: var(--radius-lg);
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.5rem;
    }

    .op-regulatory-box h2 {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 0.65rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .op-regulatory-box p {
        font-size: 0.92rem;
        color: #334155;
        line-height: 1.65;
        margin-bottom: 0.65rem;
    }

    .op-regulatory-box p:last-child {
        margin-bottom: 0;
    }

    /* Blocks Table */
    .op-section-title {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-main);
        margin: 0 0 0.35rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .op-section-sub {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 1.15rem;
    }

    .op-blocks-wrap {
        overflow-x: auto;
        border: 1px solid var(--border);
        border-radius: var(--radius);
    }

    .op-blocks-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.88rem;
    }

    .op-blocks-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 0.8rem 1rem;
        border-bottom: 1px solid var(--border);
    }

    .op-blocks-table td {
        padding: 0.8rem 1rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
        color: var(--text-main);
    }

    .op-blocks-table tbody tr:last-child td {
        border-bottom: none;
    }

    .op-blocks-table tbody tr:hover {
        background: #f8fafc;
    }

    .blk-mono {
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-variant-numeric: tabular-nums;
        font-weight: 700;
        white-space: nowrap;
    }

    .blk-start-link {
        color: var(--primary);
        text-decoration: none;
    }

    .blk-start-link:hover {
        text-decoration: underline;
    }

    .blk-prefix-badge {
        display: inline-flex;
        align-items: center;
        min-height: 32px;
        padding: 0.15rem 0.55rem;
        border-radius: 6px;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-variant-numeric: tabular-nums;
        font-size: 0.8rem;
        font-weight: 700;
        text-decoration: none;
        background: #eff6ff;
        color: var(--primary);
        border: 1px solid #bfdbfe;
    }

    .blk-prefix-badge:hover {
        background: var(--primary);
        color: #ffffff;
    }

    /* Community Reported Phones Grid */
    .op-phones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 0.75rem;
    }

    .op-phone-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        min-height: 48px;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 10px;
        text-decoration: none;
        color: var(--text-main);
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-variant-numeric: tabular-nums;
        font-weight: 700;
        font-size: 0.92rem;
        transition: border-color 0.15s, background 0.15s, transform 0.15s;
    }

    .op-phone-item:hover {
        background: #ffffff;
        border-color: var(--primary);
        transform: translateY(-1px);
    }

    .op-phone-risk {
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.18rem 0.5rem;
        border-radius: 6px;
    }

    .risk-tag-high { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    .risk-tag-neutral { background: #e2e8f0; color: #334155; }

    /* Related Operators */
    .op-related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 0.75rem;
    }

    .op-related-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 0.35rem;
        min-height: 48px;
        padding: 0.9rem 1rem;
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 10px;
        text-decoration: none;
        color: inherit;
        transition: border-color 0.15s, background 0.15s;
    }

    .op-related-card:hover {
        background: #ffffff;
        border-color: var(--primary);
    }

    .op-related-card strong {
        font-size: 0.92rem;
        color: var(--primary);
        font-weight: 700;
    }

    .op-related-card span {
        font-size: 0.78rem;
        color: var(--text-muted);
        font-variant-numeric: tabular-nums;
    }

    @media (max-width: 900px) {
        .op-metrics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .op-sheet {
            padding: 1.35rem 1.1rem;
        }
        .op-sheet h1 {
            font-size: 1.65rem;
        }
        .op-metrics-grid {
            grid-template-columns: 1fr;
        }
        .op-regulatory-box {
            padding: 1.2rem 1.1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="op-detail">
    <nav class="op-breadcrumb" aria-label="Ruta de navegación">
        <a href="{{ route('home') }}">Inicio</a>
        <span aria-hidden="true">/</span>
        <a href="{{ route('operators.index') }}">Operadores SUBTEL</a>
        <span aria-hidden="true">/</span>
        <span>{{ $operator['name'] }}</span>
    </nav>

    <!-- Cabecera del Operador Concesionario -->
    <header class="op-sheet">
        <div class="op-badge-row">
            <span class="op-chip op-chip-subtel">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Concesionaria Oficial SUBTEL Chile
            </span>
            @if($operator['is_voip_or_masivo'])
                <span class="op-chip op-chip-voip">Red VoIP / Comunicaciones Masivas</span>
            @endif
            @if($operator['has_809'])
                <span class="op-chip op-chip-809">Opera Numeración 809 (Telemarketing)</span>
            @endif
            @if($operator['has_600'])
                <span class="op-chip op-chip-voip">Opera Serie 600 (10 dígitos)</span>
            @endif
        </div>

        <h1>{{ $operator['name'] }}</h1>
        <p class="op-legal-subtitle">
            <strong>Razón social registrada ante SUBTEL:</strong> {{ $operator['legal_name'] }}
        </p>

        <div class="op-metrics-grid">
            <div class="op-metric-card">
                <span class="op-metric-num">{{ number_format($operator['blocks_count'], 0, ',', '.') }}</span>
                <span class="op-metric-label">Bloques SUBTEL asignados</span>
            </div>
            <div class="op-metric-card">
                <span class="op-metric-num">{{ number_format($operator['numbers_capacity'], 0, ',', '.') }}</span>
                <span class="op-metric-label">Capacidad total de números</span>
            </div>
            <div class="op-metric-card">
                <span class="op-metric-text">{{ $operator['primary_service'] }}</span>
                <span class="op-metric-label">Servicio técnico principal</span>
            </div>
            <div class="op-metric-card">
                <span class="op-metric-num">{{ count($operator['prefix_codes']) }}</span>
                <span class="op-metric-label">Códigos y prefijos activos</span>
            </div>
        </div>

        @if(!empty($operator['prefix_codes']))
            <div class="op-prefix-pills" aria-label="Prefijos operados por {{ $operator['name'] }}">
                @foreach($operator['prefix_codes'] as $pCode)
                    <a href="{{ route('area-codes.show', $pCode) }}" class="op-prefix-link" title="Ver bloques del prefijo {{ $pCode }} en Chile">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <span>Prefijo +56 {{ $pCode }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </header>

    <!-- Recuadro Técnico-Legal estilo Prefijo400 -->
    <section class="op-regulatory-box" aria-label="Información técnica y legal de la concesionaria">
        <h2>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
            Naturaleza del servicio, portabilidad numérica y subasignación mayorista VoIP / Call Centers
        </h2>
        <p>
            <strong>1. Concesión mayorista vs. emisor final de la llamada:</strong> En la arquitectura regulatoria chilena fiscalizada por la Subsecretaría de Telecomunicaciones (SUBTEL), <strong>{{ $operator['name'] }}</strong> actúa como concesionaria titular de la red y de los bloques de numeración listados abajo. Cuando una empresa comercial, banco, aseguradora, agencia de cobranza o <em>contact center</em> contrata troncales SIP, numeración virtual IP (prefijo 44) o series masivas (<strong>809</strong> y <strong>600</strong>), la concesionaria provee el transporte técnico de telecomunicaciones, mientras que la responsabilidad por el contenido comercial o la insistencia de las llamadas recae en la empresa mandante que origina el contacto.
        </p>
        <p>
            <strong>2. Portabilidad Numérica Completa (Ley N° 20.471):</strong> El registro oficial de SUBTEL identifica al operador de origen del bloque. Cualquier línea móvil (prefijo 9) o fija geográfica individual incluida dentro de estos rangos puede haber sido portada posteriormente por el suscriptor hacia otro operador nacional.
        </p>
        <p>
            <strong>3. Derechos del consumidor ante llamadas masivas:</strong> Según normativa vigente de SUBTEL, toda oferta comercial no solicitada debe emitirse desde el <a href="{{ route('area-codes.show', '809') }}" style="color:var(--primary); font-weight:700;">prefijo 809</a>, mientras que el <a href="{{ route('area-codes.show', '600') }}" style="color:var(--primary); font-weight:700;">prefijo 600</a> queda restringido a servicios previamente contratados. Puedes exigir el cese de contactos publicitarios en el portal oficial <a href="{{ route('legal.no-molestar') }}" style="color:var(--primary); font-weight:700;">«No Molestar» del SERNAC</a>.
        </p>
    </section>

    @include('partials.ad_slot', ['margin' => '1.5rem auto'])

    <!-- Tabla Oficial de Bloques Numéricos SUBTEL -->
    <section class="op-sheet">
        <h2 class="op-section-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
            Bloques Oficiales SUBTEL Asignados a {{ $operator['name'] }}
        </h2>
        <p class="op-section-sub">
            @if($operator['blocks_count'] > count($operator['blocks']))
                Mostrando los {{ count($operator['blocks']) }} bloques principales (priorizando numeración masiva/VoIP y mayor capacidad) de un total de {{ number_format($operator['blocks_count'], 0, ',', '.') }} rangos registrados.
            @else
                Listado íntegro de los {{ count($operator['blocks']) }} bloques de numeración vigentes en el Plan Técnico Fundamental de Numeración de SUBTEL.
            @endif
        </p>

        <div class="op-blocks-wrap">
            <table class="op-blocks-table">
                <thead>
                    <tr>
                        <th scope="col">Inicio de Bloque</th>
                        <th scope="col">Fin de Bloque</th>
                        <th scope="col">Prefijo</th>
                        <th scope="col">Tipo de Servicio SUBTEL</th>
                        <th scope="col" style="text-align:right">Capacidad</th>
                        <th scope="col">Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($operator['blocks'] as $blk)
                        <tr>
                            <td class="blk-mono">
                                <a href="{{ route('phone.show', $blk['range_start']) }}" class="blk-start-link" title="Consultar ficha del número {{ $blk['start_formatted'] }}">
                                    {{ $blk['start_formatted'] }}
                                </a>
                            </td>
                            <td class="blk-mono">{{ $blk['end_formatted'] }}</td>
                            <td>
                                <a href="{{ route('area-codes.show', $blk['prefix_code']) }}" class="blk-prefix-badge">
                                    +56 {{ $blk['prefix_code'] }}
                                </a>
                            </td>
                            <td>{{ $blk['service_type'] }}</td>
                            <td class="blk-mono" style="text-align:right">{{ number_format($blk['capacity'], 0, ',', '.') }}</td>
                            <td style="font-size:0.8rem; color:var(--text-muted); white-space:nowrap;">{{ $blk['regulator_meta'] ?: 'SUBTEL' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Teléfonos Reportados por la Comunidad en Rangos de este Operador -->
    <section class="op-sheet">
        <h2 class="op-section-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            Números Consultados y Reportados en Bloques de {{ $operator['name'] }}
        </h2>

        @if($reportedPhones->isNotEmpty())
            <p class="op-section-sub">
                Teléfonos pertenecientes por rango de origen a <strong>{{ $operator['name'] }}</strong> que han sido verificados o reportados recientemente por usuarios en Chile:
            </p>
            <div class="op-phones-grid">
                @foreach($reportedPhones as $rp)
                    <a href="{{ route('phone.show', $rp->number) }}" class="op-phone-item">
                        <span>{{ $rp->formatted() }}</span>
                        @if($rp->spam_score > 0 || $rp->comments_count > 0)
                            <span class="op-phone-risk risk-tag-high">{{ $rp->comments_count > 0 ? $rp->comments_count . ' rep.' : 'Riesgo ' . $rp->spam_score }}</span>
                        @else
                            <span class="op-phone-risk risk-tag-neutral">{{ $rp->views }} vistas</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <p class="op-section-sub">
                ¿Recibiste una llamada desde un bloque asignado a <strong>{{ $operator['name'] }}</strong>? Ingresa el número completo para verificar su ficha técnica o registrar el primer reporte ciudadano:
            </p>
            <form action="{{ route('search') }}" method="GET" style="display:flex; gap:0.6rem; flex-wrap:wrap; max-width:560px;">
                <input type="tel" name="q" placeholder="Ingresa el número de 9 o 10 dígitos (ej: {{ $operator['blocks'][0]['range_start'] ?? '809000015' }})" aria-label="Buscar teléfono de este operador" required style="flex:1; min-width:220px; min-height:46px; padding:0.7rem 1rem; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem;">
                <button type="submit" class="btn btn-primary" style="min-height:46px;">Consultar Número</button>
            </form>
        @endif
    </section>

    @include('partials.ad_slot', ['margin' => '1.5rem auto'])

    <!-- Otras Concesionarias Relacionadas -->
    @if(!empty($relatedOperators))
        <section class="op-sheet" style="margin-bottom: 0;">
            <h2 class="op-section-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Otras Concesionarias SUBTEL en Chile
            </h2>
            <p class="op-section-sub">
                Explora los rangos oficiales de otros operadores con numeración asignada en el territorio nacional:
            </p>
            <div class="op-related-grid">
                @foreach($relatedOperators as $rel)
                    <a href="{{ route('operators.show', $rel['slug']) }}" class="op-related-card">
                        <strong>{{ $rel['name'] }}</strong>
                        <span>{{ number_format($rel['blocks_count'], 0, ',', '.') }} bloques · {{ number_format($rel['numbers_capacity'], 0, ',', '.') }} números</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>

<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
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
          "name": "Operadores SUBTEL Chile",
          "item": "{{ route('operators.index') }}"
        },
        {
          "@@type": "ListItem",
          "position": 3,
          "name": "{{ $operator['name'] }}",
          "item": "{{ route('operators.show', $operator['slug']) }}"
        }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "¿Qué es {{ $operator['name'] }} en el registro telefónico de Chile?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "{{ $operator['name'] }} ({{ $operator['legal_name'] }}) es una concesionaria de telecomunicaciones registrada ante la SUBTEL en Chile con {{ $operator['blocks_count'] }} bloques asignados y una capacidad de {{ number_format($operator['numbers_capacity'], 0, ',', '.') }} números, cuyo servicio principal es {{ $operator['primary_service'] }}."
          }
        },
        {
          "@@type": "Question",
          "name": "¿Por qué recibo llamadas comerciales desde un bloque de {{ $operator['name'] }}?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "En Chile, las concesionarias VoIP y operadores de telecomunicaciones asignan o arriendan numeración corporativa (incluyendo prefijos 809, 600 o 44) a empresas, bancos y centros de llamadas externos, o bien la línea pudo haber sido portada a otro operador bajo la Ley N° 20.471."
          }
        }
      ]
    }
  ]
}
</script>
@endsection
