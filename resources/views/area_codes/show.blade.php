@extends('layouts.app')

@section('title', 'Prefijo ' . $clean . ' Chile: ¿De dónde es el código de área ' . $clean . '?')
@section('meta_description', '¿De qué ciudad o región es el prefijo ' . $clean . ' en Chile? Conoce la localidad y región correspondiente al código ' . $clean . ' (' . $info['city'] . '), cómo marcar según SUBTEL y números denunciados.')

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

    <!-- Guía de Marcación -->
    <div class="dialing-card">
        <h2 style="font-size:1.3rem; font-weight:800; color:var(--text-main); margin:0">
            📞 ¿Cómo marcar a un número con prefijo {{ $clean }}?
        </h2>
        <p style="font-size:0.9rem; color:var(--text-muted); margin-top:0.35rem">
            Formas correctas de llamada según el Plan Fundamental de Numeración Nacional de la SUBTEL:
        </p>

        <table class="dialing-table">
            <tr>
                <td>Marcación Nacional Fija Directa</td>
                <td>{{ $clean }} + N° Local (Total 9 dígitos)</td>
            </tr>
            <tr>
                <td>Llamar a un celular de esta zona desde Chile</td>
                <td>9 + 8 dígitos del celular</td>
            </tr>
            <tr>
                <td>Llamar desde el extranjero a esta zona</td>
                <td>+56 {{ $clean }} + N° Local</td>
            </tr>
            <tr>
                <td>Llamar o agendar en WhatsApp</td>
                <td>+56 {{ $clean }} (fijo) o +56 9 XXXX XXXX (móvil)</td>
            </tr>
        </table>
    </div>

    <!-- Búsqueda rápida de un número con este código -->
    <div class="dialing-card" style="border: 2px solid var(--primary); background:#eff6ff;">
        <h3 style="font-size:1.15rem; font-weight:800; color:var(--text-main); margin-bottom:0.4rem">
            🔎 ¿Recibiste una llamada con el prefijo {{ $clean }}?
        </h3>
        <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:1rem">
            Ingresa el número completo para consultar si otros usuarios lo denunciaron por telemarketing o estafas en Chile:
        </p>

        <form action="{{ route('search') }}" method="GET" style="display:flex; gap:0.5rem; flex-wrap:wrap">
            <input type="tel" name="q" value="{{ $clean }}" placeholder="Ej: {{ $clean }}22345678" required style="flex:1; padding:0.75rem 1rem; border:1px solid var(--border); border-radius:8px; font-size:1rem; min-width:200px">
            <button type="submit" class="btn btn-primary" style="padding:0.75rem 1.5rem">
                Buscar Teléfono
            </button>
        </form>
    </div>

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
            <p>Especialista en Desarrollo Web y SEO. Creador de QuiénLlama, comprometido con la transparencia en telecomunicaciones y la protección comunitaria frente a fraudes y spam telefónico en Chile, España y Argentina.</p>
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
